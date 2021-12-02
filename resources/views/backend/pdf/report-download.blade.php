<style>
    @page {
        margin-top: 0px;
        padding: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        font-family:Arial, Helvetica, sans-serif;
    }

    ul li {
        font-size: 20px;
    }
 td {
    font-family:Arial, Helvetica, sans-serif;
    padding: 3px;
    word-spacing: 1px;
 }
 .container {
    font-family:Arial, Helvetica, sans-serif;  
    background-image: url('{{public_path('/backend/images/wam.png')}}');
    background-repeat: no-repeat;
    background-position:center center;
    background-attachment:fixed;
    background-clip: padding-box;
    background-origin: content-box;
    background-size:  contain;
    filter: opacity(0.7);
 }
 body {
    background-color:#e0fff8;
 }
</style>
@php
$test = App\Model\Test::where('id', $invoice_details->test_id)->first();
$payment = App\Model\Payment::where('invoice_id', $invoice_details->invoice_id)->first();
@endphp

<body>
    <header>

        <img src="{{ public_path('backend/images/header.png') }}" alt="" srcset="">
    </header>
    <div class="container" style="width:100%;height:100%;padding:10px 40px 10px 40px; ">
    
        <div class="details-container" style="width:100%; padding: 10px 25px 10px 25px;font-family:Arial, Helvetica, sans-serif;border:1px solid gray">

            <table width="100%" >
                <tbody>
                    <tr>
                        <td><label for="">Patient ID</label></td>
                        <td>:</td>
                        <td><label for="">{{"SPI-".$payment['customer']['id']}}</label></td>
                        <td><label for="">Report ID</label></td>
                        <td>:</td>
                        <td><label for="">{{"SRI-".$invoice_details->id}}</label></td>
                       
                    </tr>
                    <tr>
                        <td><label for="">Patient Name</label></td>
                        <td>:</td>
                        <td><label for=""><strong>{{strtoupper($payment['customer']['name'])}}</strong></label></td>
                        <td><label for="">Date/Time</label></td>
                        <td>:</td>
                        <td ><label for="">{{$invoice_details->updated_at->format('d/m/Y H:i:s A')}}</label></td>
                    </tr>
                    <tr>
                        <td><label for="">Age/Sex</label></td>
                        <td>:</td>
                        <td><label for="">{{$payment['customer']['age']}}/{{strtoupper($payment['customer']['gender'])}}</label></td>
                        <td><label for="">Modality</label></td>
                        <td>:</td>
                        <td ><label for="">{{$invoice_details->report_mod}}</label></td>
                    </tr>
                    <tr>
                        <td><label for="">Ref Physician</label></td>
                        <td>:</td>
                        <td><label for="">{{$invoice_details->doctor}}</label></td>
                        <td><label for="">Report</label></td>
                        <td>:</td>
                        <td><label for=""><b>{{$invoice_details->report_name}}</b></label></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3 style="text-align:center;text-decoration:underline;">
            {{ $invoice_details->report_name }}
        </h3>
         <div class="report-study-container" style="width:100%; padding: 0px 20px 10px 20px;">
            
            {!! $invoice_details->report_study !!}
            <br>
            {!! $invoice_details->report_imp !!}
    
    
         </div>
    </div>
    <footer style="position: fixed;bottom:1px;">
        <table width="100%" style="padding: 0px 35px 10px 35px; " >
            <tbody>
                <tr>
                    @php
                        $doc = $invoice_details->report_tech;
                        $doctor = explode(',', $doc);
                    @endphp
                    <td style="padding-top:30px">
                        <p>---------------------------------</p>
                         <h5> {{ $doctor[0] }}</h5>
                        <p style="font-size: 11px;margin-top:20px;">({{"Consultant"."".$doctor[1] }})</p>
                        
                    </td>
                    <td width="11%" style="text-align:center;margin:0px; border: 1px solid #8f8f92;border-style: dashed;">
                        <img style="border: 1px solid #000;border-style: dashed;padding: 10px,10px,10px,10px;"
                            src="data:image/svg;base64, {!! base64_encode(QrCode::size(60)->generate(route('download-report-pdf', $invoice_details->id))) !!} ">
                    </td>
    
                </tr>
            </tbody>
        </table>
        <p style="font-size:11px; margin:10px; border-bottom: 1px solid #ced4da;border-top: 1px solid #ced4da;font-family:Arial, Helvetica, sans-serif;padding: 6px 30px 6px 30px; ">
            <strong>Disclaimer :</strong> This report is prepared by the image and patient information provided by the
            origin. In no event, <b>Supreme Health Care & Medical Solution</b> shall be liable for any special, direct, indirect,
            consequential or any damages, arising out of any connection with the use of the service. </p>
         
         <img src="{{ public_path('backend/images/footer.png') }}" alt="" srcset="">
    </footer>
</body>
