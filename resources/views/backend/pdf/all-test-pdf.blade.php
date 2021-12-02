<style>
    /* .ftd {
       text-align: center;
       font-family: Verdana;
       font-size: 13px;
       padding: 10px;
       border: 1px solid #ddd;
   }

   .utd {
       text-align: center;
       font-family: Verdana;
       font-size: 14px; */


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

@php
    $allData = App\Model\Test::orderBy('dept_id', 'desc')->orderBy('type_id', 'desc')->get();
@endphp
<div class="container">
    <div class="row">
        <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif" style="margin-bottom:0">Supreme Health Care &
            Medical Solution.</h1>
        <p style="margin:0; padding:0;">Janai(Near Subedar More),Chanditala,Hooghly-712304.</p>
        <p><span>Mobile:+917688017623</span></p>
    </div>


    <hr>
    <h5 class="sh">All Test List</h5>

    <table class="table" width="100%" style="" border="1">
        <thead>
            <tr class="text-center">
                <th width="7%">#</th>
                <th>Test ID</th>
                <th>Test Name</th>
                <th>Test Type</th>
                <th>Department</th>
                <th>Rate</th>
            </tr>
        </thead>
        <tbody>
     
            @foreach ($allData as $key => $test)

                <tr>
                    <td class="ftd">
                        {{ $key + 1 }}
                    </td>
                    <td class="ftd">
                        {{ $test->id }}
                    </td>
                    <td class="ftd">
                        {{ $test->name }}
                    </td>
                    <td class="ftd">
                        {{ $test['type']['typename'] }}
                    </td>
                    <td class="ftd">
                        {{ $test['dept']['name'] }}
                    </td>
                    <td class="ftd">
                        {{ $test->price }}
                    </td>
                </tr>

            @endforeach


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
