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
        padding: 12px;

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

    table,
    th,
    td {

        border-collapse: collapse;
    }

    @page {
        margin-top: 15px;
    }

</style>


<div class="container">
    <div class="row">
        <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif" style="margin-bottom:0">Supreme Health Care &
            Medical Solution.</h1>
        <p style="margin:0; padding:0;">Janai(Near Subedar More),Chanditala,Hooghly-712304.</p>
        <p><span>Mobile:+917688017623</span></p>
    </div>
    <table width="100%">
        <thead>
            <tr>
                <th width="100%" style="text-align:center;font-size:16px;"> Monthly Invoice Report PDF
                    @if ($month == '1')
                        <span>(January)</span>
                    @elseif($month=='2')
                        <span>(February)</span>
                    @elseif($month=='3')
                        <span>(March)</span>
                    @elseif($month=='4')
                        <span>(April)</span>
                    @elseif($month=='5')
                        <span>(May)</span>
                    @elseif($month=='6')
                        <span>(June)</span>
                    @elseif($month=='7')
                        <span>(July)</span>
                    @elseif($month=='8')
                        <span>(August)</span>
                    @elseif($month=='9')
                        <span>(September)</span>
                    @elseif($month=='10')
                        <span>(October)</span>
                    @elseif($month=='11')
                        <span>(November)</span>
                    @elseif($month=='12')
                        <span>(December)</span>
                    @endif
                </th>
            </tr>
        </thead>
    </table>



    <table class="table" width="100%" style="">
        <thead>
            <tr class="" style=" background-color: #D8FDBA">
                <th class="fth">SL No.</th>
                <th class="fth">Invoice No</th>
                <th class="fth">Patient Name</th>
                <th class="fth">Date</th>
                <th class="fth">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_sum = '0';
            @endphp

            @if (count($allData) != null)
                @foreach ($allData as $key => $invoice)

                    <tr>
                        <td class="ftd">
                            {{ $key + 1 }}
                        </td>
                        <td class="ftd">#0000{{ $invoice->invoice_no }}</td>
                        <td class="ftd">
                            {{ $invoice['payment']['customer']['id'] }},{{ $invoice['payment']['customer']['name'] }}
                        </td>
                        <td class="ftd">{{ date('d-m-Y', strtotime($invoice->date)) }}</td>

                        <td class="ftd">₹ {{ $invoice['payment']['total_amount'] }}</td>
                    </tr>
                    @php
                    $total_sum += $invoice['payment']['total_amount'];
                @endphp
                @endforeach
                
            @endif

            <tr>
                <td class="utd" colspan="4" style="font-weight:bold;text-align:right;padding-top:10px">Grand
                    Total :
                </td>
                <td class="utd" style="padding-top:10px; text-align:center;font-weight:bold;">₹
                    {{ $total_sum }}.00/-
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
