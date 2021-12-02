<head>
    <style>
        .ftd {
            text-align: center;
            font-family: Verdana;
            font-size: 13px;
            padding: 10px;
            border: 1px solid #ddd;
        }
    
        .utd {
            text-align: center;
            font-family: Verdana;
            font-size: 14px;
    
    
        }
    
        td {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 13px;
        }
    
        .fth {
            text-align: center;
            font-size: 13px;
            font-family: Verdana;
            border: 1px solid #ddd;
            padding: 13px;
    
        }
    
        table {
            border-collapse: collapse;
            margin-top: 10px;
    
        }
    
        .row h2 {
            text-align: center;
        }
    
        .row p {
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
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
    
        @page { margin-top: 15px; }
    
    </style>
    <title>{{ $payment['customer']['name'] }} Payment Summary</title>
</head>

<div class="container" >
    <div class="row">
        <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif" style="margin-bottom:0">Supreme Health Care &
            Medical Solution.</h1>
        <p style="margin:0; padding:0;">Janai(Near Subedar More),Chanditala,Hooghly-712304.</p>
        <p><span>Mobile:+917688017623</span></p>
    </div>

    <table width="100%">
        <thead>
            <tr>
                <th width="50%" style="text-align: left">Invoice No. - #000{{ $payment['invoice']['invoice_no'] }}
                </th>
                <th width="50%" style="text-align: right;font-size:12px;">
                    Date-{{ date('d-m-Y'), strtotime($payment->date) }}</th>
            </tr>
        </thead>
    </table>
    <hr>
    <table width="100%">
        <thead>
            <tr>
                <th width="60%" style="text-align: left">To</th>

                <th width="40%" style="text-align:left">From</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1">{{ $payment['customer']['name'] }} {{ $payment['customer']['age'] }}/{{ $payment['customer']['gender'] }}</td>
                <td>Supreme Health Care & Medical Solution.</td>
            </tr>
            <tr>
                <td colspan="1">+91{{ $payment['customer']['mobile_no'] }}</td>
                
            </tr>
            <tr>
                <td colspan="1">{{ $payment['customer']['address'] }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="text-center" style="background-color: #D8FDBA">
                <th class="fth">SL No.</th>
                <th class="fth">Test Name</th>
                <th class="fth">Quantity</th>
                <th class="fth">Unit Price</th>
                <th class="fth">Total Price</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_sum = '0';
                $invoice_details = App\Model\InvoiceDetails::where('invoice_id', $payment->invoice_id)->get();
            @endphp
            @foreach ($invoice_details as $key => $details)
                <tr class="text-center">
                    <input type="hidden" name="test_id[]" value="{{ $details->test_id }}" id="">
                    <input type="hidden" name="selling_qty[{{ $details->id }}]" value="{{ $details->selling_qty }}"
                        id="">
                    <td class="ftd">{{ $key + 1 }}</td>
                    <td class="ftd">{{ $details['test']['name'] }}</td>
                    <td class="ftd">{{ $details->selling_qty }}</td>
                    <td class="ftd">Rs. {{ $details->unit_price }}.00</td>
                    <td class="ftd">Rs. {{ $details->selling_price }}.00</td>
                </tr>
                
                @php
                $total_sum += $details->selling_price;
            @endphp
            @endforeach
            @if ($payment->doc_fees>'0')
                <tr>
                    <td class="ftd" colspan="4">Doctor Fee</td>
                    <td class="ftd" style="text-align:center">Rs. {{$payment->doc_fees}}.00</td>
                </tr>
                @endif
            <tr>
                <td class="utd" colspan="4" style="font-weight:bold;text-align:right; padding-top:20px;">Sub Total :
                </td>
                <td class="utd" style="padding-top:10px; text-align:center;padding-top:20px;font-weight:bold">
                    Rs.
                    {{ $total_sum + $payment->doc_fees }}.00/-</td>
            </tr>
           
            @if ($payment->discount_amount>'0')
                
            <tr>
                <td class="utd" colspan="4" style="text-align:right;padding-top:10px">
                    Discount :
                </td>
                <td class="utd" style="padding-top:10px; text-align:center;">
                    {{ $payment->discount_amount }}%
                </td>
            </tr>
            @endif

            <tr>
                <td class="utd" colspan="4" style="text-align:right;padding-top:10px">Paid
                    Amount :</td>
                <td class="utd" style="padding-top:10px; text-align:center;">Rs.
                    {{ $payment->paid_amount }}.00/-
                </td>
            </tr>

            <tr>
                <td class="utd" colspan="4" style="text-align:right;padding-top:10px">Due
                    Amount
                    :</td>
                <input type="hidden" name="new_paid_amount" value="{{ $payment->due_amount }}">
                <td class="utd" style="padding-top:10px; text-align:center;">Rs.
                    {{ $payment->due_amount }}.00/-</td>
            </tr>

            <tr>
                <td class="utd" colspan="4" style="font-weight:bold;text-align:right;padding-top:10px;">Grand Total :
                </td>
                <td class="utd" style="padding-top:10px; text-align:center;font-weight:bold;">
                    Rs.
                    {{ $payment->total_amount+$payment->doc_fees }}.00/-
                </td>
            </tr>
<tr>
    <td><hr style="color: white"></td>
</tr>
            <tr>
                <td class="ftd mt-2" colspan="6" style="font-weight:bold;text-align:center;">Payment Summary
                </td>
            </tr>
            <tr>
                @php
                    $payment_details = App\Model\PaymentDetails::where('invoice_id', $payment->invoice_id)->get();
                @endphp
                <td class="ftd" colspan="3" style="font-weight:bold;text-align:center;padding-top:10px">Date
                </td>
                <td class="ftd" colspan="3" style="font-weight:bold;text-align:center;padding-top:10px">Amount
                </td>
            </tr>

            @foreach ($payment_details as $details)
                @if ($details->current_paid_amount>0)
                <tr>
                    <td class="ftd" colspan="3" style="font-weight:normal;text-align:center;padding-top:10px">{{date('d-m-Y',strtotime($details->date))}} </td>
                    <td class="ftd" colspan="3" style="font-weight:normal;text-align:center;padding-top:10px">₹ {{$details->current_paid_amount}}.00</td>
                </tr>
                @endif
            @endforeach
        </tbody>

    </table>
    @php
        $datetime = new DateTime('now', new DateTimezone('Asia/Kolkata'));
    @endphp
    <table width="100%" style="margin-top:30px;">
        <tr>
            <th style="font-weight:normal;font-size:11px;font-style:italic;letter-spacing:1px; text-align:left;color:white"
                width="50%">______________________________</th>
            <th style="font-weight:normal;font-size:11px;font-style:italic;letter-spacing:1px; text-align:right;"
                width="50%">__________________________</th>
        </tr>
        <tr>
            <th style="font-weight:normal;font-size:11px;font-style:italic;letter-spacing:1px; text-align:left;color:white"
                width="50%">(Customers Signature)</th>
            <th style="font-weight:normal;font-size:11px;font-style:italic;letter-spacing:1px; text-align:right;"
                width="50%">Authorized Signatory</th>
        </tr>
    </table>
    <hr>
    <h6 style="text-align: center; width:100%; font-weight:normal; font-style:italic">Printing Time -
        {{ $datetime->format('F,j,Y, g:i a') }}</h6>
</div>
