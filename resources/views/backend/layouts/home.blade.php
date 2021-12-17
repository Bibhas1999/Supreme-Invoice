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

 @extends('backend.layouts.master')

 @section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper  mt-0 py-5 bg-prim">

         <!-- Main content -->
         <section class="content pt-2 ">
             <div class="container-fluid">
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
                                 <span class="info-box-text">Reports</span>
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
                                 <span class="info-box-text">Doctors</span>
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
                                 <span class="info-box-text">Appointments</span>
                                 <span class="info-box-number">{{ $count_appointment }}</span>
                             </div>
                             <!-- /.info-box-content -->
                         </div>
                         <!-- /.info-box -->
                     </div>
                     <!-- /.col -->
                 </div>
                 @if (Auth::user()->usertype == 'Admin' or Auth::user()->usertype == 'Manager')
                     <div class="row">
                         <div class="col-12 col-sm-6 col-md-2">
                             <div class="info-box shadow-md rounded-lg">
                                 <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-vials"></i></span>
                                 <div class="info-box-content">
                                     <span class="info-box-text">Tests</span>
                                     <a href="{{ route('tests.view') }}" class="small-box-footer mt-2 text-sm">
                                         View <i class="fas fa-arrow-circle-right"></i>
                                     </a>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                         <!-- /.col -->
                         <div class="col-12 col-sm-6 col-md-2">
                             <div class="info-box mb-3 shadow-md rounded-lg">
                                 <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-building"></i></span>

                                 <div class="info-box-content">
                                     <span class="info-box-text">Departments</span>
                                     <a href="{{ route('depts.view') }}" class="small-box-footer mt-2 text-sm">
                                         View <i class="fas fa-arrow-circle-right"></i>
                                     </a>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                         <!-- /.col -->

                         <!-- fix for small devices only -->
                         <div class="clearfix hidden-md-up"></div>
                         <!-- /.col -->
                         <div class="col-12 col-sm-6 col-md-2">
                             <div class="info-box mb-3 shadow-md rounded-lg">
                                 <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-users"></i></span>
                                 <div class="info-box-content">
                                     <span class="info-box-text">Doctors</span>
                                     <a href="{{ route('doctors.view') }}" class="small-box-footer mt-2 text-sm">
                                         View <i class="fas fa-arrow-circle-right"></i>
                                     </a>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                         <!-- /.col -->

                         <!-- /.col -->
                         <div class="col-12 col-sm-6 col-md-2">
                             <div class="info-box mb-3 shadow-md rounded-lg">
                                 <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-calendar-alt"></i></span>
                                 <div class="info-box-content">
                                     <span class="info-box-text">Appointments</span>
                                     <a href="{{ route('apps.view') }}" class="small-box-footer mt-2 text-sm">
                                         View <i class="fas fa-arrow-circle-right"></i>
                                     </a>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                         <!-- /.col -->
                         <div class="col-12 col-sm-6 col-md-2">
                             <div class="info-box mb-3 shadow-md rounded-lg">
                                 <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-clock"></i></span>
                                 <div class="info-box-content">
                                     <span class="info-box-text">Schedules</span>
                                     <a href="{{ route('schedules.view') }}" class="small-box-footer mt-2 text-sm">
                                         View <i class="fas fa-arrow-circle-right"></i>
                                     </a>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                         <!-- /.col -->

                         <div class="col-12 col-sm-6 col-md-2">
                             <div class="info-box mb-3 shadow-md rounded-lg">
                                 <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-users"></i></span>

                                 <div class="info-box-content">
                                     <span class="info-box-text">Users</span>
                                     <a href="{{ route('users.view') }}" class="small-box-footer mt-2 text-sm">
                                         View <i class="fas fa-arrow-circle-right"></i>
                                     </a>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                         <!-- /.col -->
                     </div>
                 @endif
                 <h5>Departments</h5>
                 <div class="row">
                     <!-- /.col -->
                     <div class="col-12 col-sm-6 col-md-2">
                         <div class="info-box mb-3 shadow-md rounded-lg">
                             <span class="info-box-icon elevation-1"><img src="{{ asset('backend/images/budget.png') }}"
                                     alt=""></span>
                             <div class="info-box-content">
                                 <span class="info-box-text text-sec"><strong>Reception</strong></span>
                                 <a href="{{ route('rept.login') }}" class="small-box-footer mt-2 text-sm">
                                     View <i class="fas fa-arrow-circle-right"></i>
                                 </a>
                             </div>
                             <!-- /.info-box-content -->
                         </div>
                         <!-- /.info-box -->
                     </div>
                     <!-- /.col -->
                     <!-- /.col -->
                     <div class="col-12 col-sm-6 col-md-2">
                         <div class="info-box mb-3 shadow-md rounded-lg">
                             <span class="info-box-icon elevation-1" style="height:60px;width:70px"><img
                                     src="{{ asset('backend/images/hospital.png') }}" alt=""></span>
                             <div class="info-box-content">
                                 <span class="info-box-text text-sec"><strong>OPD</strong></span>
                                 <a href="{{ route('opd.login') }}" class="small-box-footer mt-2 text-sm">
                                     View <i class="fas fa-arrow-circle-right"></i>
                                 </a>
                             </div>
                             <!-- /.info-box-content -->
                         </div>
                         <!-- /.info-box -->
                     </div>
                     <!-- /.col -->
                     @foreach ($all_dept as $dept)
                         @if ($dept->name == 'RADIOLOGY')
                             <div class="col-12 col-sm-6 col-md-2">
                                 <div class="info-box shadow-md rounded-lg">
                                     <span class="info-box-icon elevation-1" style="height:60px;width:60px"><img
                                             src="{{ asset('backend/images/ct-scan.png') }}" alt=""></span>
                                     <div class="info-box-content">
                                         <span class="info-box-text text-sec"><strong> Radiology</strong></span>
                                         <a href="{{ route('redirect.dept', $dept->id) }}"
                                             class="small-box-footer mt-2 text-sm">
                                             View <i class="fas fa-arrow-circle-right"></i>
                                         </a>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>
                             <!-- /.col -->
                         @endif
                         @if ($dept->name == 'PATHOLOGY')
                             <div class="col-12 col-sm-6 col-md-2">
                                 <div class="info-box mb-3 shadow-md rounded-lg">
                                     <span class="info-box-icon elevation-1" style="height:60px;width:60px"><img
                                             src="{{ asset('backend/images/microscope.png') }}" alt=""></span>
                                     <div class="info-box-content">
                                         <span class="info-box-text text-sec"><strong>Pathology</strong></span>
                                         <a href="{{ route('redirect.dept', $dept->id) }}"
                                             class="small-box-footer mt-2 text-sm">
                                             View <i class="fas fa-arrow-circle-right"></i>
                                         </a>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>
                             <!-- /.col -->
                         @endif
                         @if ($dept->name == 'ECHO&USG')
                             <div class="col-12 col-sm-6 col-md-2">
                                 <div class="info-box mb-3 shadow-md rounded-lg">
                                     <span class="info-box-icon elevation-1"><img
                                             src="{{ asset('backend/images/ultrasound.png') }}" alt=""></span>
                                     <div class="info-box-content">
                                         <span class="info-box-text text-sec"><strong>Echo & USG</strong></span>
                                         <a href="{{ route('redirect.dept', $dept->id) }}"
                                             class="small-box-footer mt-2 text-sm">
                                             View <i class="fas fa-arrow-circle-right"></i>
                                         </a>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>
                             <!-- /.col -->
                         @endif

                         @if ($dept->name == 'ACCOUNTS')
                             <div class="col-12 col-sm-6 col-md-2">
                                 <div class="info-box mb-3 shadow-md rounded-lg">
                                     <span class="info-box-icon elevation-1" style="height:60px;width:60px"><img
                                             src="{{ asset('backend/images/budget.png') }}" alt=""></span>
                                     <div class="info-box-content">
                                         <span class="info-box-text text-sec"><strong>Accounts</strong></span>
                                         <a href="{{ route('redirect.dept', $dept->id) }}"
                                             class="small-box-footer mt-2 text-sm">
                                             View <i class="fas fa-arrow-circle-right"></i>
                                         </a>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>
                             <!-- /.col -->
                         @endif

                     @endforeach
                     <!-- fix for small devices only -->
                     <div class="clearfix hidden-md-up"></div>
                 </div>
                 <div class="row">
                     <div class="col-lg-12">
                         <h5>Activities Today</h5>
                         <div class=" w-100 btn-group btn-group-toggle " data-toggle="buttons">
                             <label class="btn btn-default mr-2 rounded-lg border-lg">
                                 <input type="radio" name="options" id="all_report" autocomplete="off" checked=""> Reports
                             </label>
                             <label class="btn btn-default mr-2 rounded-lg">
                                 <input type="radio" name="options" id="all_appointment" autocomplete="off"> Appointments
                             </label>
                             <label class="btn btn-default rounded-lg">
                                 <input type="radio" name="options" id="all_invoice" autocomplete="off"> Invoices
                             </label>
                         </div>
                     </div>
                 </div>
                 <div class="row mt-3">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title card_title">

                                 </h3>
                                 <span class="float-right">Date - <b>{{ date('d-m-y') }}</b></span>
                             </div>
                             <!-- /.card-header -->
                             <div class="card-body table-responsive p-0" style="height: 300px;">
                                 <table class="table table-head-fixed text-nowrap report_tbl">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>Report ID</th>
                                             <th>Invoice ID</th>
                                             <th>Patient Details</th>
                                             <th>Invoice Date</th>
                                             <th>Test Details</th>
                                             <th>Status</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($invoice_details as $key => $inv_d)
                                             @php
                                                 $payment = App\Model\Payment::where('invoice_id', $inv_d->invoice_id)->first();
                                                 $test = App\Model\Test::where('id', $inv_d->test_id)->first();
                                             @endphp
                                             <tr>
                                                 <td>{{ $key + 1 }}</td>
                                                 <td>{{ $inv_d->id }}</td>
                                                 <td>{{ $inv_d->invoice_id }}</td>
                                                 <td><span class="font-weight-bold">Patient ID -
                                                         {{ $payment['customer']['id'] }}</span> <br>
                                                     Patient Name - {{ $payment['customer']['name'] }} <br>
                                                     Contact No - <span
                                                         class="font-weight-bold">{{ $payment['customer']['mobile_no'] }}</span>
                                                 </td>
                                                 <td>{{ date('d-m-Y', strtotime($inv_d->created_at)) }}</td>
                                                 <td><span class="tag tag-success"><b>Test Name</b> -
                                                         {{ $test->name }}</span>
                                                     <br> <b>Department</b> - {{ $test['dept']['name'] }} <br>
                                                 </td>
                                                 @if ($inv_d->report_file == null && $inv_d->report_study == null)

                                                     <td><span class="badge badge-danger">Not
                                                             Ready</span></td>
                                                 @else
                                                     <td><span class="badge badge-success">Uploaded</span></td>

                                                 @endif
                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                                 <table class="table table-head-fixed text-nowrap appointment_tbl ">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>ID</th>
                                             <th>App No.</th>
                                             <th>Patient Details</th>
                                             <th>Booking Date</th>
                                             <th>Booking Time</th>
                                             <th>Appoint Date</th>
                                             <th>Doctor</th>
                                             <th>Mode</th>
                                             <th>Status</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($appointments as $key => $app)
                                             @php
                                                 $schedule = App\Model\Schedule::where('id', $app->schedule_id)->first();
                                                 $doctor = App\Model\Doctor::where('id', $schedule->doctor_id)->first();
                                             @endphp
                                             <tr>
                                                 <td>{{ $key + 1 }}</td>
                                                 <td>{{ $app->id }}</td>
                                                 <td>{{ $app->app_no }}</td>
                                                 <td><span class="font-weight-bold">
                                                         Patient Name - {{ $app->patient_name }} <br>
                                                         Contact No - <span
                                                             class="font-weight-bold">{{ $app->patient_mobile }}</span>
                                                 </td>
                                                 <td>{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                                                 <td>{{ date('H:i:s', strtotime($app->created_at)) }}</td>
                                                 <td>{{ date('d-m-Y', strtotime($app->date)) }}</td>
                                                 <td><span class="tag tag-success">{{ $doctor->name }}</span></td>
                                                 <td><span class="tag tag-success">{{ $app->type }}</span></td>
                                                 @if ($app->status == '0')
                                                     <td><span class="badge badge-danger">Incomplete</span></td>
                                                 @else
                                                     <td><span class="badge badge-success">Completed</span></td>
                                                 @endif

                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                                 <table class="table table-head-fixed text-nowrap invoice_tbl ">
                                     <thead>
                                         <tr>
                                             <th>ID</th>
                                             <th>Invoice ID</th>
                                             <th>Invoice No</th>
                                             <th>Patient Details</th>
                                             <th>Date</th>
                                             <th>Status</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($invoice_today as $key => $inv)
                                             @php
                                                 $payment = App\Model\Payment::where('invoice_id', $inv->id)->first();
                                             @endphp
                                             <tr>
                                                 <td>{{ $key + 1 }}</td>
                                                 <td>{{ $inv->id }}</td>
                                                 <td>{{ $inv->invoice_no }}</td>
                                                 <td><span class="font-weight-bold">Patient ID -
                                                         {{ $payment['customer']['id'] }}</span> <br>
                                                     Patient Name - {{ $payment['customer']['name'] }} <br>
                                                     Contact No - <span
                                                         class="font-weight-bold">{{ $payment['customer']['mobile_no'] }}</span>
                                                 </td>
                                                 <td>{{ date('d-m-Y', strtotime($inv->created_at)) }}</td>
                                                 @if ($inv->status == '0')
                                                     <td><span class="badge badge-danger">on hold</span></td>
                                                 @else
                                                     <td><span class="badge badge-success">Approved</span></td>
                                                 @endif
                                                 

                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                             </div>
                             <!-- /.card-body -->
                         </div>
                     </div>
                 </div>

             </div><!-- /.container-fluid -->
         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->

 @endsection
