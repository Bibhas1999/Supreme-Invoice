<style>
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

    table,
    th,
    td {

        border-collapse: collapse;
    }

    .uth,
    .utd {
        padding: 10px;
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
    <hr>
    <h2 style="text-align: center;text-decoration:underline">Invoice List</h2>
    <table id="example1" border="1" width="100%">
        <thead class="bg-olive">
            <tr>
                <th class="uth">#</th>
                <th class="uth">Patient Details</th>
                <th class="uth">Invoice No.</th>
                <th class="uth">Date</th>
                {{-- <th class="uth">Description</th> --}}
                <th class="uth">Doc Fee</th>
                <th class="uth">Amount</th>
                <th class="uth">Total</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($allData as $key => $invoice)

                <tr>
                    <td class="utd">{{ $key + 1 }}</td>
                    <td class="utd">PT00{{ $invoice['payment']['customer']['id'] }}
                        {{ $invoice['payment']['customer']['name'] }}({{ $invoice['payment']['customer']['age'] }}/{{ $invoice['payment']['customer']['gender'] }})
                        <br>
                        ({{ $invoice['payment']['customer']['mobile_no'] }})
                        {{ $invoice['payment']['customer']['address'] }}
                    </td>

                    <td class="utd">#000{{ $invoice->invoice_no }}</td>
                    <td class="utd">{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                    {{-- <td class="utd">{{ $invoice->description }}</td> --}}
                    @if ($invoice['payment']['doc_fees'] > 0)
                        <td class="utd"> {{ $invoice['payment']['doc_fees'] }}</td>

                    @endif
                    <td class="utd"> {{ $invoice['payment']['total_amount'] }}.00</td>
                    @if ($invoice['payment']['doc_fees'] > 0)
                        <td class="utd"> {{ $invoice['payment']['total_amount']+$invoice['payment']['doc_fees'] }}.00</td>
                    @else
                        <td class="utd"> {{ $invoice['payment']['total_amount'] }}.00</td>
                    @endif
                </tr>

            @endforeach

        </tbody>

    </table>
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
    @php
        $datetime = new DateTime('now', new DateTimezone('Asia/Kolkata'));
    @endphp
    <h6 style="text-align: center; width:100%; font-weight:normal; font-style:italic">
        {{ $datetime->format('F,j,Y, g:i a') }}.</h6>
</div>
