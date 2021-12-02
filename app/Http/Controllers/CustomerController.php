<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use Illuminate\Support\Facades\Auth;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use App\Model\Payment;
use App\Model\PaymentDetails;

class CustomerController extends Controller
{
  public function view()
  {

    $allData = Customer::all();

    return view('backend.customer.view-customer', compact('allData'));
  }

  public function add()
  {

    return view('backend.customer.add-customer');
  }


  public function store(Request $request)
  {

    $customer = new Customer();
    $customer->name = $request->name;
    $customer->email = $request->email;
    $customer->mobile_no = $request->mobile_no;
    $customer->address = $request->address;
    $customer->created_by = Auth::user()->id;
    $customer->save();
    if ($customer->save()) {
      Alert::success('Success', 'Customer Added Successfully');
      return redirect()->route('customers.view');
    } else {
      Alert::error('Failed', 'Oppps..something went wrong!');
    }
  }



  public function edit($id)
  {

    $editData =  Customer::find($id);
    return view('backend.customer.edit-customer', compact('editData'));
  }



  public function update(Request $request, $id)
  {

    $data = Customer::find($id);
    $data->name = $request->name;
    $data->email = $request->email;
    $data->mobile_no = $request->mobile_no;
    $data->address = $request->address;
    $data->updated_by = Auth::user()->id;
    $data->save();
    if ($data->save()) {
      Alert::success('Success', 'Customer Updated Successfully');
      return redirect()->route('customers.view');
    } else {
      Alert::error('Failed', 'Oppps..something went wrong!');
    }
  }

  public function delete($id)
  {

    $customer = Customer::find($id);
    $customer->delete();

    return redirect()->route('customers.view');
  }

  public function Creditcustomer()
  {
    $allData = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
    return view('backend.customer.credit-customer', compact('allData'));
  }

  public function CreditcustomerPdf()
  {
    $data['allData'] = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
    $pdf = PDF::loadView('backend.pdf.customer-credit-pdf', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('document.pdf');
  }

  public function editInvoice($invoice_id)
  {
    $payment = Payment::where('invoice_id', $invoice_id)->first();
    return view('backend.customer.edit-invoice', compact('payment'));
  }

  public function updateInvoice(Request $request, $invoice_id)
  {
    if ($request->new_paid_amount < $request->paid_amount) {

      Alert::Error('Failed', 'Paid Amount Cannot be greater than Required Amount');
      return redirect()->back();
    } else {
      $payment = Payment::where('invoice_id', $invoice_id)->first();
      $payment_details = new PaymentDetails();
      $payment->paid_status = $request->paid_status;
      if ($request->paid_status == 'full_paid') {

        $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->new_paid_amount;
        $payment->due_amount = '0';
        $payment_details->current_paid_amount = $request->new_paid_amount;
      } elseif ($request->paid_status == 'partial_paid') {

        $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->paid_amount;
        $payment->due_amount =  Payment::where('invoice_id', $invoice_id)->first()['due_amount'] - $request->paid_amount;
        $payment_details->current_paid_amount = $request->paid_amount;
      }

      $payment->save();
      $payment_details->invoice_id = $request->invoice_id;
      $payment_details->date = date('Y-m-d', strtotime($request->date));
      $payment_details->updated_by = Auth::user()->id;
      $payment_details->save();
      if ($payment_details->save()) {
        Alert::success('Success', 'Invoice Updated Successfully');
        return redirect()->route('customers.credit');
      } else {
        Alert::error('Failed', 'Oppps..something went wrong!');
      }
    }
  }

  public function invoiceDetailsPdf(Request $request, $invoice_id)
  {
    $data['payment'] = Payment::where('invoice_id', $invoice_id)->first();
    $pdf = PDF::loadView('backend.pdf.invoice-details-pdf', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('document.pdf');
  }

  public function paidCustomer()
  {
    $allData = Payment::orderBy('id', 'desc')->where('paid_amount' ,'!=', '0')->get();
    return view('backend.customer.customer-paid', compact('allData'));
  }

  public function paidCustomerPdf()
  {
    $data['allData'] = Payment::where('paid_status', '!=', 'full_due')->get();
    $pdf = PDF::loadView('backend.pdf.customer-paid-pdf', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('document.pdf');
  }


}
