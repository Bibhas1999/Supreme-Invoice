@extends('backend.layouts.master')
@section('content')

    @php
    $pending_invoice = App\Model\Invoice::where('status', '0')->count();
    $all_tests = App\Model\Test::all()->count();
    $pending_report = App\Model\Invoice::where('report_status', '0')->count();
    $credit_customer = App\Model\Payment::where('paid_status', '!=', 'full_paid')->count();
    $paid_customer = App\Model\Payment::where('paid_amount', '!=', '0')->count();
    $all = App\Model\Invoice::all()->count();
    $pending = App\Model\Invoice::orderBy('date', 'desc')
        ->orderBy('id', 'desc')
        ->where('status', '0')
        ->get();
    $pending_report_show = App\Model\Invoice::where('report_status', '0')->get();
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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">ALL INVOICES
                                    <a href="{{ route('home') }}" class="bg-sec  text-md text-white pt-1 float-left"> <i
                                        class="fas fa-arrow-left"></i> Back</a>
                                </h5>
                            </div>
                            <div class="card-body">

                                <a href="{{ route('invoice.add') }}" class="btn btn-sm bg-sec float-right"> <i
                                        class="fa fa-plus-circle"></i> New</a>
                                <span class="float-right text-white">i</span>
                                <a href="#" data-target="#Pending" data-toggle="modal"
                                    class="btn btn-sm btn-default float-left">
                                    <i class="fas fa-clock"></i> On Hold
                                    <span class="badge bg-success">{{ $pending_invoice }}</span>
                                </a>
                                <span class="float-left text-white">i</span>
                                <a href="{{ route('customers.credit') }}" class="btn btn-sm btn-default float-left">
                                    <i class="fas fa-file-invoice-dollar"></i> Credit Records
                                    <span class="badge bg-success">{{ $credit_customer }}</span>
                                </a>
                                <span class="float-left text-white">i</span>
                                @if (Auth::user()->usertype == 'Admin' or Auth::user()->usertype == 'Manager' or Auth::user()->usertype == 'Receptionist')

                                    <a href="{{ route('customers.paid') }}" class="btn btn-sm btn-default float-left">
                                        <i class="fas fa-hand-holding-usd"></i> Payments
                                        <span class="badge bg-success">{{ $paid_customer }}</span>
                                    </a>

                                @endif

                                @if (Auth::user()->usertype == 'Admin' or Auth::user()->usertype == 'Manager' or Auth::user()->usertype == 'Receptionist')

                                    <span class="float-left text-white">i</span>
                                    <a href="#" data-toggle="modal" data-target="#dailyreport"
                                        class="btn btn-sm btn-default float-left">
                                        <span class="badge bg-success"></span>
                                        <i class="fas fa-download"></i> Daily/Monthly Report</a>
                                    <span class="float-left text-white">i</span>
                                @endif

                                <table id="example1" class="table table-responsive w-100 d-md-table d-block ">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th>#</th>
                                            <th >Invoice No.</th>
                                            <th >Patient Details</th>
                                            <th >Date</th>
                                            <th >Report Status</th>
                                            <th >Amount</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $invoice)

                                            <tr >
                                                <td>{{$key+1}}</td>
                                                <td class="font-weight-bold">#000{{ $invoice->invoice_no }}</td>
                                                <td><span class="font-weight-bold">Patient ID - {{ $invoice['payment']['customer']['id'] }}</span> <br>
                                                    Patient Name - {{ $invoice['payment']['customer']['name'] }} <br>
                                                    Contact No - <span class="font-weight-bold">{{ $invoice['payment']['customer']['mobile_no'] }}</span>
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                                                <td class="text-center">

                                                    <form action="{{ route('invoice.update.report', $invoice->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @if ($invoice->report_status == '0')
                                                            <button type="submit"
                                                                class="btn-sm btn btn-danger py-0 text-sm">Not
                                                                Delivered</button>
                                                        @else
                                                            <span class="badge badge-success">Delivered</span>
                                                        @endif
                                                    </form>

                                                </td>

                                                <td class="text-sec font-weight-bold">Rs.
                                                    {{ $invoice['payment']['total_amount'] + $invoice['payment']['doc_fees'] }}.00 <br>
                                                    <span class="text-sm font-weight-normal"> <i class=" text-success fas fa-arrow-up"></i> {{$invoice['payment']['paid_amount']}} <i class="fas fa-arrow-down text-danger"></i> {{$invoice['payment']['due_amount']}}</span>
                                                </td>
                                                <td>
                                                    <form action="{{ route('send-to-pending', $invoice->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-default btn-sm"> <i
                                                                class="fas fa-clock"></i> Hold</button>
                                                        <a href="{{ route('invoice.print', $invoice->id) }}"
                                                            target="_blank" class="btn bg-sec btn-sm"> <i
                                                                class="fas fa-print"></i>
                                                            Print</a>

                                                    </form>

                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <td colspan="7">
                                            <span class="badge badge-success mx-2">Delivered</span> <span class="text-xs font-weight-bold mr-2 ">Report Delivered</span> |
                                             <span class="badge badge-danger mx-2">Not Delivered</span> <span class="text-xs font-weight-bold mr-2">Report Not Delivered </span> |
                                             <span class="badge badge-default border mx-2"> <i class="fas fa-clock"></i> hold</span><span class="text-xs font-weight-bold mr-2">Wait for payment confirmation</span> |
                                             <span class="badge bg-sec border mx-2"> <i class="fas fa-print"></i> print</span><span class="text-xs font-weight-bold mr-2">Print Invoice</span> |
                                            <span class="text-xs font-weight-bold mx-2"><i class=" text-success text-xs fas fa-arrow-up"></i> Paid Amount</span> |
                                            <span class="text-xs font-weight-bold mx-2"><i class=" text-danger text-xs fas fa-arrow-down"></i> Due Amount</span> 
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

    <div class="modal fade bd-example-modal-lg" id="Pending" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-sec">
                    <h5 class="modal-title" id="exampleModalLabel">Pending Invoices</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="example1" class="table table-responsive w-100 d-md-table d-block">
                        <thead
                            class="">
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Inv No.</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pending as $key => $invoice)
                      
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td width="
                            12%">{{ $invoice['payment']['customer']['name'] }} <br>

                            </td>
                            <td width="10%">#000{{ $invoice->invoice_no }}</td>
                            <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                            <td>Rs. {{ $invoice['payment']['total_amount'] }}</td>
                            <td class="">
                            @if ($invoice->status == '0')
                                <span class="
                                badge badge-danger">Pending</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('invoice.approval', $invoice->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i>
                                        Confirm</button>
                                    <a href="{{ route('invoice.edit', $invoice->id) }}" class="btn btn-info btn-sm"
                                        id="edit"> <i class="fas fa-edit"></i> Edit</a>
                                    <a href="{{ route('invoice.print', $invoice->id) }}" target="_blank"
                                        class="btn btn-primary btn-sm"> <i class="fas fa-print"></i>
                                        Print</a>
                                    <a href="{{ route('invoice.delete', $invoice->id) }}" class="btn btn-danger btn-sm"
                                        id="delete"> Delete</a>

                                </form>
                            </td>
                            </tr>

                            @endforeach

                            </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="PendingReport" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-sec">
                    <h5 class="modal-title" id="exampleModalLabel">Pending Reports</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table id="example1 myTable" class="table mt-3">
                        <input type="text" class="form-control form-control-sm" name="search" id="search"
                            placeholder="Search Pending Report Here..." />
                        <thead>
                            <tr>

                                <th>Patient Details</th>
                                <th>Inv No.</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pending_report_show as $key => $invoice)

                                <tr>

                                    <td>PT00{{ $invoice['payment']['customer']['id'] }}
                                        ({{ $invoice['payment']['customer']['name'] }})
                                    </td>
                                    <td>#000{{ $invoice->invoice_no }}</td>
                                    <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                                    <td>Rs. {{ $invoice['payment']['total_amount'] }}</td>
                                    <td class="">
                            @if ($invoice->report_status == '0')
                                <span class="
                                        badge badge-danger">Pending</span>
                            @endif
                            </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        const searchInput = document.getElementById("search");
        const rows = document.querySelectorAll("tbody tr ");
        console.log(rows);
        searchInput.addEventListener("keyup", function(event) {
            const q = event.target.value.toUpperCase();
            rows.forEach((row) => {
                row.querySelector("td").textContent.toUpperCase().startsWith(q) ?
                    (row.style.display = "table-row") :
                    (row.style.display = "none");
            });
        });
    </script>
@endsection
