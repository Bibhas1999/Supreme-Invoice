<style>
    .ftd {
        font-family: Verdana;
        font-size: 13px;
        padding-top: 7px;
        padding-bottom: 5px;
    }

    .utd {
        text-align: center;
        font-family: 'Courier New', Courier, monospace;
        font-size: 13px;
        margin: 0px;
        padding: 0px;


    }

    .subt {
        border-top: 1px solid black;
    }

    td {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 13px;
    }

    .fth {
        text-align: left;
        font-size: 13px;
        font-family: Verdana;
        border-bottom: 1px solid black;
        padding: 2px
    }

    table {}

    .row h2 {
        text-align: center;
    }

    .row p {
        text-align: center;
        font-family: 'Courier New', Courier, monospace;
        font-size: 14px;
        line-height: 0;
        margin: 0;
        padding: 0;
    }

    .container {
        margin: 0;
        padding: 0;
    }

    th {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    h1 {
        text-align: center
    }

    .cspan {
        font-weight: bold
    }

    @page {
        margin-top: 15px;
    }

</style>
@php
$app = App\Model\Appointment::where('id', $invoice->app_id)->first();
$schedule = App\Model\Schedule::where('id',$app->schedule_id)->first();
$doctor =  App\Model\Doctor::where('id',$schedule->doctor_id)->first(); 
$payment =  App\Model\Opdpayment::where('invoice_id',$invoice->id)->first(); 
@endphp

<div class="container">
    <div class="row">
        <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif" style="margin-bottom:0">Supreme Health Care &
            Medical Solution</h1>
        <p style="margin:0; padding:0;">Janai(Near Subedar More),Chanditala,Hooghly-712304</p>
        <p><span>Mobile:+917688017623</span></p>
    </div>
    <table width="100%" style="margin:0px">
        <thead>
            <tr>
                <th width="30%" style="text-align: left; margin:0">Invoice No. - #000{{ $invoice->invoice_no }}</th>
                <th width="40%" style="text-align:center; margin:0;font-size:18px;">OPD Bill / Receipt</th>
                <th width="30%" style="text-align: right;font-size:12px;">
                    Date-{{ date('d-m-Y'), strtotime($invoice->date) }}</th>
            </tr>
        </thead>
    </table>
    <hr style="margin:0px;padding:0px;">

    <table width="100%" class="cre-tbl">
        <tbody>
            <tr>
                <td style="font-weight: bold; font-size:14px"> </td>
                <td rowspan="5" style="text-align:right;z-index:9999;font-size:1px;color:white">
                    {{-- {{ QrCode::size(70)->generate("Invoice ID : #000".$invoice->invoice_no."\n"."Date : ".$details->date."\n"."Patient ID : PT00".$payment['customer']['id']."\n"."Patient Name :".$payment['customer']['name']."\n"."Mobile No : ".$payment['customer']['mobile_no']."\n"."Age : ".$payment['customer']['age']."\n"."Gender : ".$payment['customer']['gender']."\n"."Sub Total : Rs ".$total_sum."\n"."Discount : ".$payment->discount_amount."%"."\n"."Paid Amount : Rs ".$payment->paid_amount."\n"."Due Amount : Rs ".$payment->due_amount."\n"."Grand Total : Rs ".$payment->total_amount)}}</td> --}}
                    {{ QrCode::size(70)->generate(route('download-opd-invoice-pdf', $invoice->id)) }}
                </td>
            </tr>
            <tr style="text-transform: capitalize">

                <td colspan="1"><span class="cspan">Patient Name :</span>
                    @if ($app->gender == 'Male' || $app->gender == 'male')
                        <span
                            style="text-transform: uppercase;font-weigth:700"><strong>Mr.{{ $app->patient_name }}</strong></span>
                    @else
                        <strong>Mrs.{{ $app->patient_name }}</strong>
                    @endif
                    <span style="color:white"> ----</span><span style="margin-left:10px; text-transform:uppercase">
                        {{ $app->age }} yrs./{{ $app->gender }}</span>
                </td>
                <td></td>
                <td><span class="cspan"></td>
            </tr>
            <tr>
                <td><span class="cspan">Appointment No./ID</span><span style="color: white">-</span>:
                    {{ $app->app_no}}/{{$app->id}}</td>
                    
            </tr>

            <tr>
                <td colspan="1"><span class="cspan">Mobile</span><span style="color: white">-----------</span> :
                    {{ ' +91' . $app->patient_mobile }}<span
                        style="color:white">---------------------------------</span><span
                        class="cspan">Consultant : </span>{{ $invoice->doctor }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="1"><span class="cspan">Address <span style="color: white">-------</span> </span>:
                    {{ $app->patient_address }}

                </td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div style="border-top: 1px solid black;margin-top:6px">
        <table class="table" width="100%">

            <tbody>
               
                 <tr>
                     <td></td>
                     <td></td>
                 </tr>
                 <tr>
                    
                    <td style="text-align:left;font-size:17px;font-weight:bold">Doctor Fees : Rs -
                        {{ $doctor->fees }}.00<span style="color: white">------------</span></td>
                    @if ($payment->discount_amount > 0)
                        <td class="utd" colspan="2" style="text-align:right;">Disc(%) :</td>
                        <td class="utd" style="text-align:left;">
                            {{ $payment->discount_amount }}.00%
                        </td>
                    @else
                        <td></td>
                        <td></td>
                    @endif
                </tr>

                <tr>
                    <td></td>
                    <td class="utd" colspan="3" style="text-align:right;">Paid Amt :</td>
                    <td class="utd" style="text-align:left;">
                        {{ $payment->paid_amount }}.00
                    </td>
                </tr>

               

                <tr>
                    <td class="utd " colspan="4"
                        style="border-bottom:1px solid black;font-weight:bold;text-align:right;">
                    </td>
                    <td class="utd " style="border-bottom:1px solid black;text-align:left;font-weight:bold;">

                    </td>
                </tr>
                
                 <tr>
                   
                    <td>Recieved by - {{ $invoice->created_by }}
                    </td>
                    <td></td>
                    <td></td>
                    <td class="utd" style="text-align:right;font-weight:bold;">Total Amt :</td>
                    @if ($doctor->fees > 0)
                        <td class="utd" style="text-align:left;font-weight:bold;">
                            {{ $payment->total_amount + $payment->doc_fees }}.00</td>
                    @else <td class="utd" style="text-align:left;font-weight:bold;">
                            {{ $payment->total_amount }}.00</td>

                    @endif
                </tr>
            </tbody>

        </table>
    </div>
    @php
        $datetime = new DateTime('now', new DateTimezone('Asia/Kolkata'));
    @endphp
    <div style="margin:0px;padding:0px;">
        <h6 style="margin:1px;padding:0;">Note :</h6>
        <ol style="font-size:12px;font-weight:bold;margin:0;">
            <li>Bill once done, cash cannot be refunded.</li>
            <li>For all diagnostic tests, report delivery time: 04:00 pm - 06:00 pm(Mon - Sat) except holidays.</li>
            <li>Centre will not be responsible for custody of any investigation report if not collected within 30 days
                from the date of reporting.</li>
        </ol>
        <h6 style="margin-top:30px"> <span
                style="color: white">------------------------------------------------------</span><span
                style="font-size:13px">Thank you for visiting us.</span><span
                style="color: white">-----------------------------------</span><span style="border-top:1px solid black">
                Authorized Signatory</span></h6>
    </div>


    {{-- <h6 style="text-align: center; width:100%; font-weight:normal; font-style:italic">
        {{ $datetime->format('F,j,Y, g:i a') }}. Bill generated by - {{Auth::user()->name}}</h6> --}}
</div>
