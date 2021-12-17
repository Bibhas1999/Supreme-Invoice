@extends('backend.layouts.master')
@section('content')

    @php
    $schedule = App\Model\Schedule::where('id', $app->schedule_id)->first();
    $doctor = App\Model\Doctor::where('id', $schedule->doctor_id)->first();
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-prim mt-0 py-5">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row mt-2">
                    <!-- Left col -->

                    <section class="col-lg-12">
                        <!-- Custom tabs (Charts with tabs)-->

                        <div class="card text-dark px-2 ">
                            <div class="card-header">
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">GENERATE NEW
                                    OPD INVOICE
                                    <a href="{{ route('home') }}" class="bg-sec  text-md text-white pt-1 float-left"> <i
                                            class="fas fa-arrow-left"></i> Back</a>
                                    <a href="{{ route('invoice.view') }}"
                                        class="font-weight-bold bg-sec  text-md text-sm pt-1 float-right text-white"> <i
                                            class="fas fa-list"></i> VIEW INVOICES</a>
                                </h5>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('opd-invoice-store', $app->id) }}" method="POST" id="myForm">
                                    @csrf
                                   
                                    
                                    <label for="" class="float-right" id=" date_show">Date. :
                                        {{ date('d-m-Y') }}</label>

                                        <h5 class="font-weight-bold pt-3 text-sec">Appointment Details : </h5>
                                        <div class="form-row new_customer px-3 py-3 bg-prim rounded-lg">
                                            <div class="form-group col-sm-2">
                                                <label for="">Appointment ID <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-sm bg-light font-weight-bold "
                                                    name="app_id" id="id" placeholder="Enter App ID" readonly
                                                    value="{{ $app->id }}">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="">Appointment No. <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-sm bg-light font-weight-bold "
                                                    name="app_no" placeholder="Enter App No." id="app_no" readonly
                                                    value="{{ $app->app_no }}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Booking Date/Time <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-sm bg-light font-weight-bold "
                                                    name="bokking_date" placeholder="Enter Booking Date." id="booking_date" readonly
                                                    value="{{ date('d-m-Y',strtotime($app->created_at)) }}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="">Appointment Date/Time <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-sm bg-light font-weight-bold "
                                                    name="bokking_date" placeholder="Enter Booking Date." id="booking_date" readonly
                                                    value="{{ date('d-m-Y',strtotime($app->date)) }} ({{substr($schedule->start_time,0,-3)}} - {{substr($schedule->end_time,0,-3)}})">
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label for="">Booking Mode <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-sm bg-light font-weight-bold "
                                                    name="app_no" placeholder="Enter App No." id="app_no" readonly
                                                    value="{{ $app->type }}">
                                            </div>
                                        </div>
                                    
                                    <h5 class="font-weight-bold pt-3 text-sec">Patient Details : </h5>
                                    <div class="form-row new_customer px-3 py-3 bg-prim rounded-lg">
                                        <div class="form-group col-sm-3">
                                            <label for="">Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-sm bg-light font-weight-bold "
                                                name="patient_name" id="name" placeholder="Enter Patient Name" readonly
                                                value="{{ $app->patient_name }}">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="">Mobile No. <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-sm bg-light font-weight-bold "
                                                name="mobile_no" placeholder="Enter Mobile No." id="mobile_no" readonly
                                                value="{{ $app->patient_mobile }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Gender <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-sm bg-light font-weight-bold "
                                                name="gender" placeholder="Enter Gender." id="gender" readonly
                                                value="{{ $app->gender }}">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Age <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-sm bg-light font-weight-bold " name="age"
                                                id="age" placeholder="Enter Age" readonly value="{{ $app->age }}">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Gurdian Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-sm bg-light font-weight-bold " name="co"
                                                id="co" placeholder="Enter Gurdian Name" readonly
                                                value="{{ $app->gurdian_name }}">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="">Address </label>
                                            <textarea name="address" id="address" placeholder="Enter Full Address"
                                                class="form-control form-control-sm bg-light font-weight-bold "
                                                readonly>{{ $app->patient_address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-row  px-3 py-3 bg-prim">
                                        <div class="form-group col-sm-5">
                                            <label for="">Doctor Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm bg-light" name="doctor"
                                                id="doctor" placeholder="Enter Consultant Name" readonly value="{{$doctor->name}}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""> Doctor Fee(Rs.) </label>
                                            <input type="number" class="form-control form-control-sm" name="doc_fees"
                                                id="doc_fees" placeholder="Enter Doctor Fee " min="100" value="{{$doctor->fees}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Payment Mode <span class="text-danger">*</span></label>
                                            {{-- <input type="text" class="form-control form-control-sm"
                                        name="payment_mode" placeholder="Enter Payment Mode"> --}}
                                            <select name="payment_mode" id="payment_mode"
                                                class="form-control form-control-sm">
                                                <option value="" disabled selected>Select Payment Mode</option>
                                                <option value="cash">Cash</option>
                                                <option value="online">Online</option>
                                            </select>
                                        </div>
                                       

                                    </div>


                                    <div class="form-group pt-2">
                                        <button type="submit" class="btn btn-md bg-sec" id="storeButton">Create
                                            Invoice</button>
                                    </div>
                                </form>
                            </div>
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

    <div class="modal fade bd-example-modal-lg" id="dailyreport" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-olive">
                    <h5 class="modal-title" id="exampleModalLabel">Invoice Report</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <label for=""> Date Wise Report</label>
                            <input type="radio" checked name="invoice_report_show" value="date_wise" class="search_value">
                            <label for="">Monthly Report</label>
                            <input type="radio" name="invoice_report_show" value="monthly" class="search_value">
                        </div>
                    </div>
                    <form action="{{ route('invoice.daily.report.pdf') }}" method="GET" target="__blank" id="myForm"
                        class="show_daily">

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <label class=" pl-1">
                                        <input type="date" class="form-control form-control bg-light" id="start_date"
                                            placeholder="YYYY-MM-DD" name="start_date">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <label class=" pl-1">
                                        <input class="form-control bg-light" type="date" name="end_date" id="end_date"
                                            placeholder="YYYY-MM-DD">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-top:31px;">
                                <button type="submit" href="" class="btn btn-md bg-olive font-weight-bold">Search</button>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('invoice.monthly.report.pdf') }}" method="GET" class="show_monthly"
                        style="display:none" target="__blank">
                        <div class="row">
                            <div class="col-lg-10">
                                <select name="month" id="" class="form-control" required>
                                    <option selected disabled>Select Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" href="" class="btn btn-md bg-olive font-weight-bold">Search</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/handlebars/handlebars.min.js') }}"></script>
    <script src="{{ asset('backend/js/gijgo.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('backend/js/gijgo.min.css') }}" rel="stylesheet" type="text/css" />
    <script>
        $('.datepicker').datepicker({

        });
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>


@endsection
