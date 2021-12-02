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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2">PATIENT PAYMENT RECORDS
                                   
                                </h5>
                            </div>
                            <div class="card-body pt-2">
                                <a href="{{ route('customers.paid.pdf') }}" target="_blank"
                                    class="btn bg-sec btn-sm float-right font-weight-bold"> <i class="fas fa-download"></i> PDF</a>
                                    <a href="{{ route('invoice.view') }}" 
                                    class="btn bg-sec btn-sm float-left font-weight-bold"> <i class="fas fa-list"></i> VIEW INVOICES</a>
                                <span class="float-right text-white">h</span>
                                @php
                                    $total_paid = '0';
                                @endphp
                                <table id="example1" class="table table-responsive w-100 d-md-table d-block">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice No.</th>
                                            <th>Patient Name</th>
                                            <th>Date</th>
                                            <th>Amount</th>
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
                                                <td class="font-weight-bold text-success">Rs. {{ $payment->paid_amount }}</td>
                                                @php
                                                    $total_paid += $payment->paid_amount;
                                                @endphp
                                                <td>
                                                    <a href="{{ route('invoice.details.pdf', $payment->invoice_id) }}"
                                                        target="_blank" class="btn btn-default btn-sm"> <i
                                                            class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>
                                <div class="jumbotron mt-2 mb-0 pt-2 pb-1">
                                    <h6 class="text-center font-weight-bold">Grand Total Payment : ₹ {{ $total_paid }}
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
