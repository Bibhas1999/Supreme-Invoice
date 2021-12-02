<head>
    <title>Paid Records</title>
    <style>
        .ftd {
          text-align: center;
          font-family: Verdana;
          font-size: 16px;
    
      }
   
      /* .utd {
          text-align: center;
          font-family: Verdana;
          font-size: 14px; 
   
   
       } */
   
       td {
           font-family: Verdana, Geneva, Tahoma, sans-serif;
           font-size: 13px;
       }
   
       .fth {
          text-align: center;
          font-size: 13px;
          font-family: Verdana;
         
   
      }
   
       table {
          border-collapse: collapse;
   
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
   
       .sh {
          font-family: Verdana, Geneva, Tahoma, sans-serif;
          font-weight:bold;
          text-align: center;
          text-decoration: underline;
          font-size:16px
       }
   
       h1 {
           text-align: center
       }
       @page { margin-top: 15px; }
   </style>
</head>


<div class="container">
    <div class="row">
        <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif" style="margin-bottom:0">Supreme Health Care &
            Medical Solution.</h1>
        <p style="margin:0; padding:0;">Janai(Near Subedar More),Chanditala,Hooghly-712304.</p>
        <p><span>Mobile:+917688017623</span></p>
    </div>


    <hr>
    <h5 class="sh">Patient Paid Report</h5>

    <table class="table" width="100%" border="1">
        <thead>
            <tr class="text-center">
                <th width="7%">#</th>
                <th>Invoice No</th>
                <th>Patient ID</th>
                <th>Patient Details</th>
                <th>Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_paid = '0';
            @endphp

            @foreach ($allData as $key => $payment)

                <tr>
                    <td class="ftd">
                        {{ $key + 1 }}
                    </td>
                    <td class="ftd">#000{{ $payment['invoice']['invoice_no'] }}</td>
                    <td class="ftd">PT00{{ $payment['customer']['id'] }}</td>
                    <td class="ftd">{{ $payment['customer']['name'] }}
                        {{ $payment['customer']['mobile_no'] }}
                        ({{ $payment['customer']['address'] }})
                    </td>
                    <td class="ftd">{{ date('d-m-Y', strtotime($payment['invoice']['date'])) }}</td>
                    <td class="ftd">₹{{ $payment->paid_amount }}.00</td>
                    @php
                        $total_paid += $payment->paid_amount;
                    @endphp

                </tr>

            @endforeach


            <tr>
                <td class="utd" colspan="5" style="font-weight:bold;text-align:right; padding:5px">Grand Total :
                </td>
                <td class="utd" style=" text-align:left;font-weight:bold;">₹{{ $total_paid }}.00/-
                </td>
            </tr>

        </tbody>

    </table>
    @php
        $datetime = new DateTime('now', new DateTimezone('Asia/Kolkata'));
    @endphp
      <table width="100%" style="margin-top:30px;">
        <tr>
            <th style="font-weight:normal;font-size:11px;font-style:italic;letter-spacing:1px; text-align:left;"
                width="50%"></th>
            <th style="font-weight:normal;font-size:11px;font-style:italic;letter-spacing:1px; text-align:right;"
                width="50%">__________________________</th>
        </tr>
        <tr>
            <th style="font-weight:normal;font-size:11px;font-style:italic;letter-spacing:1px; text-align:left;"
                width="50%"></th>
            <th style="font-weight:normal;font-size:11px;font-style:italic;letter-spacing:1px; text-align:right;"
                width="50%">(Authorized Signatory)</th>
        </tr>
    </table>
    <hr>
    <h6 style="text-align: center; width:100%; font-weight:normal; font-style:italic">Printing Time -
        {{ $datetime->format('F,j,Y, g:i a') }}</h6>
</div>
