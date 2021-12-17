<?php

namespace App\Http\Controllers;

use App\Model\Appointment;
use App\Model\Customer;
use App\Model\Dept;
use App\Model\Doctor;
use App\Model\Invoice;
use App\Model\InvoiceDetails;
use App\Model\OPDInvoice;
use App\Model\OPDPayment;
use App\Model\Payment;
use App\Model\PaymentDetails;
use App\Model\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{
    public function view()
    {

        $data['allData'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        $data['customers'] = Customer::all();
        return view('backend.invoice.view-invoice', $data);
    }

    public function add()
    {
        $data['tests'] = Test::all();

        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if ($invoice_data == null) {
            $firstReg = '0';
            $data['invoice_no'] = $firstReg + 1;
        } else {

            $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data + 1;
        }
        $data['customers'] = Customer::all();
        $data['date'] = date('Y-m-d');
        return view('backend.invoice.add-invoice', $data);
    }

    public function store(Request $request)
    {

        if ($request->test_id == null) {

            Alert::Error('Failed', 'You didnt select any test');
            return redirect()->back();
        } else {

            if ($request->paid_amount > $request->estimated_amount) {

                Alert::Error('Failed', 'paid amount is greter than total price');
                return redirect()->back();
            } else {
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->doctor = $request->doctor;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '1';
                $invoice->created_by = Auth::user()->name;
            }

            DB::transaction(function () use ($request, $invoice) {
                if ($invoice->save()) {
                    $count_test = count($request->test_id);

                    for ($i = 0; $i < $count_test; $i++) {
                        $invoice_details = new InvoiceDetails();
                        $invoice_details->date = date('Y-m-d', strtotime($request->date));
                        $invoice_details->invoice_id = $invoice->id;
                        $invoice_details->doctor = $invoice->doctor;
                        $invoice_details->test_id = $request->test_id[$i];
                        $invoice_details->selling_qty = $request->selling_qty[$i];
                        $invoice_details->unit_price = $request->unit_price[$i];
                        $invoice_details->selling_price = $request->selling_price[$i];
                        $invoice_details->save();
                    }

                    $customer = new Customer();
                    $customer->name = $request->name;
                    $customer->mobile_no = $request->mobile_no;
                    $customer->address = $request->address;
                    $customer->age = $request->age;
                    $customer->gender = $request->gender;
                    $customer->co = $request->co;
                    $customer->save();
                    $customer_id = $customer->id;

                    $payment = new Payment();
                    $payment_details = new PaymentDetails();
                    $payment->invoice_id = $invoice->id;
                    $payment->customer_id = $customer_id;
                    $payment->payment_mode = $request->payment_mode;
                    $payment->doc_fees = $request->doc_fees;
                    $payment->paid_status = $request->paid_status;
                    $payment->paid_amount = $request->paid_amount;
                    $payment->discount_amount = $request->discount_amount;
                    $payment->total_amount = $request->estimated_amount;

                    if ($request->paid_status == 'full_paid') {
                        if ($request->doc_fees > '0') {
                            $payment->paid_amount = $request->estimated_amount + $request->doc_fees;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount + $request->doc_fees;
                        } else {
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        }

                    } elseif ($request->paid_status == 'full_due') {

                        if ($request->doc_fees > '0') {
                            $payment->paid_amount = '0'+$request->doc_fees;
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0'+$request->doc_fees;
                        } else {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        }
                    } elseif ($request->paid_status == 'partial_paid') {

                        if ($request->doc_fees > '0') {
                            $payment->paid_amount = $request->paid_amount + $request->doc_fees;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount + $request->doc_fees;
                        } else {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                    }
                    $payment->save();
                    $payment_details->invoice_id = $invoice->id;
                    $payment_details->date = date('Y-m-d', strtotime($request->date));
                    $payment_details->save();
                }
            });
        }
        Alert::Success('Success', 'Invoice Created Successfully.');
        return redirect()->route('invoice.view');
    }

    public function editInvoice($id)
    {
        $data['editData'] = Invoice::find($id);
        $data['payment'] = Payment::where('invoice_id', $id)->first();
        $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
        $data['tests'] = Test::all();

        return view('backend.invoice.edit-invoice-details', $data);
    }

    public function updateInvoice(Request $request, $id)
    {

        $invoice = Invoice::find($id);
        $invoice->invoice_no = $invoice->invoice_no;
        $invoice->doctor = $request->doctor;
        $invoice->description = $request->description;
        $invoice->status = '0';
        $invoice->created_by = Auth::user()->name;
        $invoice->save();
        $payment = Payment::where('invoice_id', $invoice->id)->first();
        $payment_details = PaymentDetails::where('invoice_id', $invoice->id)->first();
        $customer = Customer::where('id', $payment->customer_id)->first();
        $customer->name = $request->name;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->age = $request->age;
        $customer->gender = $request->gender;
        $customer->co = $request->co;
        $customer->address = $request->address;
        $customer->save();
        $payment->paid_status = $request->paid_status;
        if ($payment->paid_status == 'full_paid') {
            if ($payment->doc_fees > '0') {
                $payment->paid_amount = $payment->total_amount + $payment->doc_fees;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $payment->paid_amount;
            } else {
                $payment->paid_amount = $payment->total_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $payment->paid_amount;
            }

        } elseif ($payment->paid_status == 'full_due') {

            if ($payment->doc_fees > '0') {
                $payment->paid_amount = '0'+$payment->doc_fees;
                $payment->due_amount = $payment->total_amount;
                $payment_details->current_paid_amount = '0'+$payment->doc_fees;
            } else {
                $payment->paid_amount = '0';
                $payment->due_amount = $payment->total_amount;
                $payment_details->current_paid_amount = '0';
            }
        } elseif ($payment->paid_status == 'partial_paid') {
            if ($request->paid_amount > $payment->total_amount) {

                Alert::Error('Failed', 'Paid amount cannot be greater than Total Amount');
                return redirect()->back();
            } else {

                if ($payment->doc_fees > '0') {
                    $payment->paid_amount = $request->paid_amount + $payment->doc_fees;
                    $payment->due_amount = $payment->total_amount - $request->paid_amount;
                    $payment_details->current_paid_amount = $payment->paid_amount;
                } else {
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $payment->total_amount - $request->paid_amount;
                    $payment_details->current_paid_amount = $payment->paid_amount;
                }
            }

        }
        $payment->save();
        $payment_details->date = Carbon::now();
        $payment_details->save();

        return redirect()->route('invoice.view');
    }

    public function addmoreInvoice(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $payment = Payment::where('invoice_id', $invoice->id)->first();
        $payment_details = PaymentDetails::where('invoice_id', $invoice->id)->first();

        $count_test = count($request->test_id);

        for ($i = 0; $i < $count_test; $i++) {
            $invoice_details = new InvoiceDetails();
            $invoice_details->date = date('Y-m-d', strtotime($request->date));
            $invoice_details->invoice_id = $invoice->id;
            $invoice_details->doctor = $invoice->doctor;
            $invoice_details->test_id = $request->test_id[$i];
            $invoice_details->selling_qty = $request->selling_qty[$i];
            $invoice_details->unit_price = $request->unit_price[$i];
            $invoice_details->selling_price = $request->selling_price[$i];
            $invoice_details->save();
        }
        $payment->paid_status = "full_due";
        $payment->total_amount = $payment->total_amount + $invoice_details->selling_price;
        $payment->due_amount = $payment->total_amount;
        if ($payment->doc_fees > "0") {
            $payment->paid_amount = "0";
            $payment->paid_amount = $payment->paid_amount + $payment->doc_fees;
            $payment_details->current_paid_amount = "0";
            $payment_details->current_paid_amount = $payment_details->current_paid_amount + $payment->doc_fees;
        } else {
            $payment->paid_amount = "0";
            $payment_details->current_paid_amount = "0";
        }

        $payment->save();
        $payment_details->save();
        return redirect()->back();
    }
    public function deleteInvoiceDetails($id)
    {
        $invoice_details = InvoiceDetails::find($id);
        $payment = Payment::where('invoice_id', $invoice_details->invoice_id)->first();
        $payment_details = PaymentDetails::where('invoice_id', $invoice_details->invoice_id)->first();
        $payment->total_amount = $payment->total_amount - $invoice_details->selling_price;
        $payment->due_amount = $payment->due_amount - $invoice_details->selling_price;
        if ($payment->doc_fees > "0") {
            $payment_details->current_paid_amount = "0";
            $payment_details->current_paid_amount += $payment->doc_fees;
        } else {
            $payment_details->current_paid_amount = "0";
        }
        $payment->save();
        $payment_details->save();
        $invoice_details->delete();
        return redirect()->back();
    }
    public function approval(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->status = "1";
        $invoice->save();
        Alert::Success('Success', 'Invoice Approved Successfully.');
        return redirect()->route('invoice.view');

    }
    public function updateReportStatus(Request $request, $id)
    {

        $invoice = Invoice::find($id);
        $invoice->report_status = "1";
        $invoice->save();
        return redirect()->route('invoice.view');
    }

    public function sendToPending(Request $request, $id)
    {

        $invoice = Invoice::find($id);
        $invoice->status = "0";
        $payment = Payment::where('invoice_id', $invoice->id)->first();
        $payment_details = PaymentDetails::where('invoice_id', $invoice->id)->first();
        $payment->paid_status = "full_due";
        if ($payment->doc_fees > 0) {
            $payment->paid_amount = 0;
            $payment->paid_amount = $payment->paid_amount + $payment->doc_fees;
            $payment_details->current_paid_amount = 0;
            $payment_details->current_paid_amount = $payment_details->current_paid_amount + $payment->doc_fees;
        } else {
            $payment->paid_amount = 0;
            $payment_details->current_paid_amount = 0;
        }

        $payment->due_amount = $payment->total_amount;
        $payment->save();
        $payment_details->save();
        $invoice->save();
        return redirect()->route('invoice.view');
    }
    public function printInvoiceListPdf()
    {

        $data['allData'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        $pdf = PDF::loadView('backend.pdf.all-invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('all-invoice.pdf');
    }

    public function delete($id)
    {

        $invoice = Invoice::find($id);
        $invoice->delete();
        InvoiceDetails::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetails::where('invoice_id', $invoice->id)->delete();
        return redirect()->route('invoice.view');
    }

    public function printInvoice($id)
    {
        $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
        $pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream($data['invoice']['payment']['customer']['name'] . '-' . 'invoice.pdf');
    }

    //report section
    public function dailyReportPdf(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $data['allData'] = Invoice::whereBetween('date', [$sdate, $edate])->where('status', '1')->get();
        $data['start_date'] = date('d-m-Y', strtotime($request->start_date));
        $data['end_date'] = date('d-m-Y', strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.daily-invoice-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('daily-invoice.pdf');
    }

    public function monthlyReportPdf(Request $request)
    {
        $month = $request->month;
        $data['month'] = $request->month;
        $data['allData'] = Invoice::whereMonth('created_at', '=', $month)->get();
        $pdf = PDF::loadView('backend.pdf.monthly-invoice-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('monthly-invoice.pdf');

    }

    public function reportgView($id)
    {
        $data = InvoiceDetails::find($id);

        return view('backend.report-view', compact('data'));
    }

    public function reportView($id)
    {
        $data = InvoiceDetails::find($id);

        return view('backend.report.view-report', compact('data'));
    }

    public function reportEdit($id)
    {
        $editData = InvoiceDetails::find($id);
        return view('backend.report.edit-report', compact('editData'));
    }

    public function reportUpdate($id, Request $request)
    {
        $data = InvoiceDetails::find($id);
        $test_id = Test::where('id', $data->test_id)->first();
        $dept_id = Dept::where('id', $test_id->dept_id)->first();
        $data->report_mod = $request->report_mod;
        $data->report_imp = $request->report_imp;
        $data->report_name = $request->report_name;
        $data->report_tech = $request->report_tech;
        $data->report_study = $request->report_study;
        $data->updated_at = $request->report_date;
        $data->save();
        Alert::Success('Success', 'Report Updated Successfully');
        return redirect()->route('dept_single.view', $dept_id);
    }
    public function reportStore($id, Request $request)
    {
        $data = InvoiceDetails::find($id);
        $test_id = Test::where('id', $data->test_id)->first();
        $dept_id = Dept::where('id', $test_id->dept_id)->first();
        $data->report_mod = $request->report_mod;
        $data->report_imp = $request->report_imp;
        $data->report_name = $request->report_name;
        $data->report_tech = $request->report_tech;
        $data->report_study = $request->report_study;
        $data->updated_at = $request->report_date;
        $data->save();
        Alert::Success('Success', 'Report Generated Successfully');
        return redirect()->route('dept_single.view', $dept_id);
    }
    public function reportGdelete($id)
    {
        $data = InvoiceDetails::find($id);
        $test_id = Test::where('id', $data->test_id)->first();
        $dept_id = Dept::where('id', $test_id->dept_id)->first();
        $data->report_mod = "";
        $data->report_imp = "";
        $data->report_name = "";
        $data->report_tech = "";
        $data->report_study = "";
        $data->save();
        Alert::Success('Success', 'Report Deleted Successfully');
        return redirect()->route('dept_single.view', $dept_id);
    }

    public function reportPdf($id)
    {
        $data['invoice_details'] = InvoiceDetails::find($id);
        $payment = Payment::where('invoice_id', $id)->first();
        $pdf = PDF::loadView('backend.pdf.report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream($payment['customer']['name'] . '-' . 'report.pdf');
    }

    public function reportDelete($id)
    {
        $data = InvoiceDetails::find($id);
        $file = $data->report_file;
        $file_path = public_path('uploads/' . $file);
        unlink($file_path);
        $data->report_file = null;
        $data->save();
        return redirect()->back();
    }

    // opd invoice section

    public function opdInvoiceView()
    {
        return view('backend.invoice.view-opd-invoice');
    }

    public function opdInvoiceAdd($id)
    {
        $data['app'] = Appointment::find($id);
        return view('backend.invoice.add-opd-invoice', $data);
    }
    public function storeOpdInvoice(Request $request, $id)
    {
        $app = Appointment::find($id);
        $invoice = new Opdinvoice();
        $invoice->invoice_no = "INVSHC".time();
        $invoice->app_id = $id;
        $invoice->doctor = $request->doctor;
        $invoice->description = $request->description;
        $invoice->created_by = Auth::user()->name;
        $invoice->save();

        $payment = new Opdpayment();
        $payment->invoice_id = $invoice->id;
        $payment->total_amount = $request->doc_fees;
        $payment->paid_amount = $request->doc_fees;
        $payment->due_amount = $request->due_amount;
        if ($payment->due_amount > 0) {
            $payment->payment_status = "0";
        } else {
            $payment->payment_status = "1";
        }
        $payment->payment_mode = $request->payment_mode;
        $payment->created_by = Auth::user()->name;
        $payment->save();
        if ($payment->save() && $invoice->save()) {

            Alert::Success('Success', 'Invoice Generated Successfully');
            return redirect()->back();
        } else {
            return redirect()->back();
            Alert::Error('Failed', 'Something Went Wrong and Invoice not saved');
        }
    }

    public function OpdInvoicePDF($id)
    {
        $data['invoice'] = Opdinvoice::find($id);
        $inv = OpdInvoice::find($id);
        $app = Appointment::where('id', $inv->app_id)->first();
        $pdf = PDF::loadView('backend.pdf.opd-invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream($app->patient_name . "-" . 'invoice.pdf');
    }

}
