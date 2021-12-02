@extends('backend.layouts.master')
@section('content')
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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2">PATIENT CREDIT RECORDS
                                    
                                </h5>
                            </div>
                            <div class="card-body pt-2">
                                @php
                                    $total_due = '0';
                                @endphp
                                
                                <a href="{{ route('customers.credit.pdf') }}" target="__blank" class="btn btn-sm bg-sec float-right font-weight-bold">
                                    <i class="fas fa-download"></i> PDF
                                    <span class="badge bg-success"></span>
                                </a>
                                <a href="{{ route('invoice.view') }}" 
                                    class="btn bg-sec btn-sm float-left font-weight-bold"> <i class="fas fa-list"></i> VIEW INVOICES</a>
                                <span class="float-right text-white">h</span>
                                <table id="example1" class="table table-responsive w-100 d-md-table d-block">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice No.</th>
                                            <th>Patient Name</th>
                                            <th>Date</th>
                                            <th>Due Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $payment)

                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="font-weight-bold">#{{ $payment['invoice']['invoice_no'] }}</td>
                                                <td>{{ $payment['customer']['name'] }}
                                                    {{ $payment['customer']['mobile_no'] }}
                                                    ({{ $payment['customer']['address'] }})
                                                </td>
                                                
                                                <td>{{ date('d-m-Y', strtotime($payment['invoice']['date'])) }}</td>
                                                <td class="font-weight-bold text-danger">Rs. {{ $payment->due_amount }}</td>
                                                @php
                                                    $total_due += $payment->due_amount;
                                                @endphp
                                                <td> <a href="{{ route('customers.edit.invoice', $payment->invoice_id) }}"
                                                        class="btn bg-sec btn-sm"> <i class="fa fa-edit"></i></a>

                                                    <a href="{{ route('invoice.details.pdf', $payment->invoice_id) }}"
                                                        target="_blank" class="btn btn-default btn-sm"> <i
                                                            class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>
                                <div class="jumbotron mt-2 mb-0 pt-2 pb-1">
                                    <h6 class="text-center font-weight-bold">Grand Total Credit : ₹ {{ $total_due }}
                                    </h6>
                                </div>
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
