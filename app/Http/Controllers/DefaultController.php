<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invoice;
use App\Model\OpdInvoice;
use App\Model\InvoiceDetails;
use App\Model\Payment;
use App\Model\Test;
use RealRashid\SweetAlert\Facades\Alert;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Auth;
class DefaultController extends Controller
{
   public function getPrice(Request $request){
       $test_id = $request->test_id;
       $price = Test::where('id',$test_id)->first()->price;
       return response()->json($price);
   }

   public function downloadInvoice($id)
  {
    $data['invoice'] = Invoice::with(['invoice_details'])->find($id); 
    $pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream($data['invoice']['payment']['customer']['name'] . '-' . 'invoice.pdf');
  }

  public function downloadReport($id){
    $data['invoice_details'] = InvoiceDetails::find($id);
    $payment = Payment::where('invoice_id',$id)->first();
    $pdf = PDF::loadView('backend.pdf.report-download', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream($payment['customer']['name'] . '-' .'report.pdf');
  }
  public function downloadOPDInvoice($id)
  {
    $data['invoice'] = OpdInvoice::find($id); 
    $inv = OpdInvoice::find($id); 
    $app = Appointment::where('id',$inv->app_id)->first();
    $pdf = PDF::loadView('backend.pdf.opd-invoice-pdf', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream($app->patient_name."-".'invoice.pdf');
  }
  
}
