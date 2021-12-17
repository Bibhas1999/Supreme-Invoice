@extends('backend.layouts.master')
@section('content')
 
    @php
   
    $invoices = App\Model\Opdinvoice::all();
   
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
                        <div class="card text-dark shadow-lg">
                            <div class="card-header">
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">OPD INVOICES
                                    <a href="{{ route('opd.view') }}" class="bg-sec  text-md text-white pt-1 float-left"> <i
                                        class="fas fa-arrow-left"></i> Back</a>
                                </h5>
                            </div>
                            <div class="card-body">

                            

                                <table id="example1" class="table table-responsive w-100 d-md-table d-block ">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th>#</th>
                                            <th >Invoice No.</th>
                                            <th >Appointment No/ID.</th>
                                            <th >Patient Details</th>
                                            <th >Booking Date/Time</th>
                                            <th >Appoint Date</th>
                                            <th >Amount</th>
                                            <th >Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $key => $invoice)
                                            
                                        @php
                                            $app = App\Model\Appointment::where('id',$invoice->app_id)->first(); 
                                            $payment = App\Model\Opdpayment::where('invoice_id',$invoice->id)->first(); 
                                            $schedule = App\Model\Schedule::where('id',$app->schedule_id)->first(); 
                                            $doctor = App\Model\Doctor::where('id',$schedule->doctor_id)->first(); 
                                        @endphp
                                            <tr >
                                                <td>{{$key+1}}</td>
                                                
                                                <td class="font-weight-bold">#000{{ $invoice->invoice_no }}</td>
                                                <td>{{$app->app_no}}/{{$invoice->app_id}}</td>
                                                <td>
                                                    Patient Name - {{ $app->patient_name }} <br>
                                                    Contact No - <span class="font-weight-bold">{{ $app->patient_mobile}}</span>
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($invoice->created_at)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                                                <td>{{ $doctor->fees }}</td>
                                                @if ($payment != null)
                                                <td><span class="badge badge-success ">Paid</span> </td>
                                                @else
                                                <td><span class="badge badge-danger ">Due</span> </td>
                                                @endif
                                            </tr>

                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <td colspan="7">
                                            <span class="badge badge-success mx-2">Paid</span> <span class="text-xs font-weight-bold mr-2 ">Payment Completed</span> |
                                             <span class="badge badge-danger mx-2">Unpaid</span> <span class="text-xs font-weight-bold mr-2">Payment Incomplete</span> | 
                                        </td>
                                    </tfoot>
                                </table>
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
    <div class="modal fade bd-example-modal-lg" id="dailyreport" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-sec">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control form-control bg-light" id="start_date"
                                        placeholder="YYYY-MM-DD" name="start_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input class="form-control bg-light" type="date" name="end_date" id="end_date"
                                        placeholder="YYYY-MM-DD">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" href=""
                                    class="btn btn-md bg-sec font-weight-bold btn-block">Search</button>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('invoice.monthly.report.pdf') }}" method="GET" class="show_monthly"
                        style="display:none" target="__blank">
                        <div class="row">
                            <div class="col-lg-12">
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

                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <button type="submit" href=""
                                    class="btn btn-md bg-sec font-weight-bold btn-block">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
