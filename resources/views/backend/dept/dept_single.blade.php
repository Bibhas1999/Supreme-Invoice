@extends('backend.layouts.master')
@section('content')

<style>
 #r_file::-webkit-file-upload-button {
  display: none;
  padding: 0;
}
#r_file::before{
   font-family: "Font Awesome 5 Free";
   content: "\f382";
   font-weight: 900;
   padding: 2px
}
</style>
@php
     
$count_invoice = App\Model\Invoice::where('status', '!=', '0')->count();
$count_doc = App\Model\Doctor::count();
$pending_invoice = App\Model\Invoice::where('status', '0')->get();
$count_customer = App\Model\Customer::all();
$all_dept = App\Model\Dept::all();
$count_user = App\User::all();
$invoice_today = App\Model\Invoice::whereDate('created_at', '=', Carbon\Carbon::today())
    ->orderBy('id', 'desc')
    ->get();
$all_reports = App\Model\InvoiceDetails::all();
$invoice_details = App\Model\InvoiceDetails::whereDate('created_at', '=', Carbon\Carbon::today())
    ->orderBy('invoice_id', 'desc')
    ->get();
$appointments = App\Model\Appointment::whereDate('created_at', '=', Carbon\Carbon::today())
    ->orderBy('id', 'desc')
    ->get();
$count_appointment = App\Model\Appointment::all()->count();
@endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-prim mt-0 py-5">

        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 ">
                        
                        <!-- Custom tabs (Charts with tabs)-->
                        
                        <div class="card text-dark">
                            <div class="card-header">
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">{{ $dept_id->name }} DEPARTMENT
                                    <a href="{{ route('home') }}" class="text-md mt-1 float-left text-white">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>
                                </h5>
                            </div>
                            <div class="card-body">

                              @if ($dept_id->name != "ACCOUNTS")
                              <table id="example1" class="table table-responsive w-100 d-md-table d-block">
                                <thead class="bg-prim">
                                    <tr>
                                        <th>#</th>
                                        <th width="12%">Report ID</th>
                                        <th width="20%">Patient Details</th>
                                        <th>Test Name</th>
                                        <th width="10%">Date/Time</th>
                                        <th width="5%">Status</th>
                                        @php
                                            $all_tests = App\Model\Test::where('dept_id', $dept_id->id)->first();
                                            
                                            if ($all_tests != null) {
                                                $invoice_details = App\Model\InvoiceDetails::where('test_id', $all_tests->id)
                                                    ->orderBy('invoice_id','desc')
                                                    ->get();
                                            }
                                            
                                        @endphp
                                        <th>Generate/Upload Report</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($all_tests != null)
                                        @foreach ($invoice_details as $key => $details)
                                            @php
                                                $payment = App\Model\Payment::where('invoice_id', $details->invoice_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td> 
                                                <td>{{ $details->id }}</td>
                                                <td><span class="font-weight-bold">Patient ID - {{ $payment['customer']['id'] }}</span> <br>
                                                    Patient Name - {{ $payment['customer']['name'] }} <br>
                                                    Contact No - <span class="font-weight-bold">{{ $payment['customer']['mobile_no'] }}</span>
                                                </td>
                                                <td>{{ $details['test']['name'] }}</td>
                                                <td>{{ $details->created_at }}</td>
                                                @if ($details->report_file == null && $details->report_study == null )
                                                   
                                                        <td><span class="badge badge-danger">Not
                                                                Ready</span></td>
                                                    @else
                                                        <td><span class="badge badge-success">Uploaded</span></td>
                                                   
                                                @endif
                                                <td class=" upload">
                                                    @if ($details->report_file == null)
                                                        @if ($details->report_study == null)
                                                            <a href="{{ route('view-report', $details->id) }}"
                                                                class="btn btn-sm btn-primary mb-2"><i
                                                                    class="far fa-edit"></i> Create</a>
                                                        @endif
                                                        @if ($details->report_study != null)
                                                        <a href="{{ route('report-pdf', $details->id) }}" target="_blank"
                                                            class="btn btn-sm btn-primary mb-2"> <i
                                                                class="fas fa-print"></i> Print/View</a>

                                                            <a href="{{ route('edit-report', $details->id) }}"
                                                                class="btn btn-sm btn-default mb-2"> <i
                                                                    class="fas fa-edit"></i> Edit</a>
                                                                    
                                                            <a href="{{ route('delete-generated-report', $details->id) }}"
                                                                class="btn btn-sm  mb-2 btn-danger" id="delete">Delete</a>
                                                        @endif

                                                    @endif

                                                    @if ($details->report_file == null)
                                                        @if ($details->report_study == null)

                                                            <form
                                                                action="{{ route('report_file.upload', $details->id) }}"
                                                                method="post" enctype="multipart/form-data"
                                                                class="d-inline">
                                                                @csrf
                                                                <input type="file" name="report_file" id="r_file"
                                                                    class=" mb-2 btn btn-sm " style="border: 1px solid #ddd;width:122px;">
                                                                <input type="submit" name="" value="Upload" id=""
                                                                    class="btn btn-sm bg-sec mb-2">
                                                            </form>
                                                        @endif

                                                    @else
                                                        <a target="_blank"
                                                            href="{{ route('report-view', $details->id) }}"
                                                            class="btn btn-sm bg-sec mb-2"> <i
                                                                class="fas fa-print"></i> Print/View</a>
                                                        <a href="{{ route('delete-report', $details->id) }}"
                                                            class="btn btn-sm btn-danger mb-2" id="delete">Delete</a>
                                                </td>



                                        @endif

                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <td colspan="7">
                                        <span class="badge badge-success mx-2">Uploaded</span> <span class="text-xs font-weight-bold mr-2 ">Report Created & Uploaded</span> |
                                         <span class="badge badge-danger mx-2">Not Ready</span> <span class="text-xs font-weight-bold mr-2">Report Not Created or Uploaded</span> |
                                         <span class="badge badge-default bg-primary mx-2"> <i class="fas fa-edit"></i> Create </span><span class="text-xs font-weight-bold mr-2">Write a Report</span> |
                                         <span class="badge bg-default border ml-2"> <i class="fas fa-upload"></i> No file Chosen</span> <span class="badge bg-sec border ">Upload</span><span class="text-xs font-weight-bold mr-2"> Choose a Report File & Upload</span>
                                    </td>
                                </tfoot>
                            </table>
                            @else
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box shadow-md rounded-lg">
                                        <span class="info-box-icon elevation-1 bg-sec"><i class="fas fa-file-invoice-dollar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"> Invoices</span>
                                            <span class="info-box-number">
                                                {{ $count_invoice }}
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3 shadow-md rounded-lg">
                                        <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-paste"></i></span>
           
                                        <div class="info-box-content">
                                            <span class="info-box-text">Due Records</span>
                                            <span class="info-box-number">{{ count($all_reports) }}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
           
                                <!-- fix for small devices only -->
                                <div class="clearfix hidden-md-up"></div>
           
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3 shadow-md rounded-lg">
                                        <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-users"></i></span>
           
                                        <div class="info-box-content">
                                            <span class="info-box-text">Paid Records</span>
                                            <span class="info-box-number">{{ $count_doc }}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
           
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3 shadow-md rounded-lg">
                                        <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-calendar-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">OPD Payments</span>
                                            <span class="info-box-number">{{ $count_appointment }}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                            </div>
                              @endif
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                    <!-- /.Left col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
