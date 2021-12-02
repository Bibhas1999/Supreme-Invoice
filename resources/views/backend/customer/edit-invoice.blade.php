@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-prim mt-0 py-5">
            <!-- Main content -->
        <section class="content mt-4">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 ">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card text-dark">
                            <div class="card-body">
                                <label for="" id="invoice_no_show">Invoice ID : #000{{ $payment->invoice_id }}</label>
                                <label for="" class="float-right" id=" date_show">Date : {{ date('d-m-Y') }}</label>
                                

                                <div class="row py-3" style="border: 1px solid #ddd">
                                    <div class="col-sm-2">
                                        <label for="">Patient ID : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['id'] }}</span></label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="">Patient Name : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['name'] }}</span></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Age/Sex : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['age'] }}/{{ $payment['customer']['gender'] }}</span></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Mobile No. : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['mobile_no'] }}</span></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Gurdian Name : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['co'] }}</span></label>
                                    </div>
                                    <div class="col-sm-5 mt-3">

                                        <label for="">Address : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['address'] }}</span></label>

                                    </div>
                          
                                </div>
                                <hr>
                                <form action="{{ route('customers.update.invoice', $payment->invoice_id) }}" method="post"
                                    id="myForm">
                                    @csrf
                                    <table class="table table-responsive w-100 d-md-table d-block" width="100%">
                                        <thead>
                                            <tr class="text-center bg-prim" >
                                                <th class="fth">SL No.</th>
                                                <th class="fth">Test Name</th>
                                                <th class="fth">Quantity</th>
                                                <th class="fth">Unit Price</th>
                                                <th class="fth">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_sum = '0';
                                                $invoice_details = App\Model\InvoiceDetails::where('invoice_id', $payment->invoice_id)->get();
                                            @endphp
                                            @foreach ($invoice_details as $key => $details)
                                                <tr class="text-center">
                                                    <input type="hidden" name="test_id[]" value="{{ $details->test_id }}"
                                                        id="">
                                                    <input type="hidden" name="selling_qty[{{ $details->id }}]"
                                                        value="{{ $details->selling_qty }}" id="">
                                                    <td class="ftd">{{ $key + 1 }}</td>
                                                    <td class="ftd">{{ $details['test']['name'] }}</td>
                                                    <td class="ftd">{{ $details->selling_qty }}</td>
                                                    <td class="ftd">Rs. {{ $details->unit_price }}.00</td>
                                                    <td class="ftd">Rs. {{ $details->selling_price }}.00</td>
                                                </tr>

                                                @php
                                                    $total_sum += $details->selling_price;
                                                @endphp
                                            @endforeach
                                            @if ($payment->doc_fees > '0')
                                                <tr>
                                                    <td class="utd" colspan="4"
                                                        style="text-align:center;font-weight:bold">Doctor Fee</td>
                                                    <td class="utd" style="text-align:center">Rs.
                                                        {{ $payment->doc_fees }}.00</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="utd" colspan="4"
                                                    style="font-weight:bold;text-align:right; padding-top:20px;">Sub Total :
                                                </td>
                                                <td class="utd"
                                                    style="padding-top:10px; text-align:center;padding-top:20px;font-weight:bold">
                                                    Rs.
                                                    {{ $total_sum + $payment->doc_fees }}.00</td>
                                            </tr>

                                            @if ($payment->discount_amount > '0')
                                                <tr>
                                                    <td class="utd" colspan="4"
                                                        style="text-align:right;padding-top:10px">
                                                        Discount :
                                                    </td>
                                                    <td class="utd" style="padding-top:10px; text-align:center;">
                                                        
                                                        {{ $payment->discount_amount }}%
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td class="utd" colspan="4"
                                                    style="text-align:right;padding-top:10px">Paid
                                                    Amount :</td>
                                                <td class="utd" style="padding-top:10px; text-align:center;">Rs.
                                                    {{ $payment->paid_amount }}.00
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="utd" colspan="4"
                                                    style="text-align:right;padding-top:10px">Due
                                                    Amount
                                                    :</td>
                                                <input type="hidden" name="new_paid_amount"
                                                    value="{{ $payment->due_amount }}">
                                                <td class="utd" style="padding-top:10px; text-align:center;">Rs.
                                                    {{ $payment->due_amount }}.00</td>
                                            </tr>

                                            <tr>
                                                <td class="utd" colspan="4"
                                                    style="font-weight:bold;text-align:right;padding-top:10px">Grand Total :
                                                </td>
                                                <td class="utd"
                                                    style="padding-top:10px; text-align:center;font-weight:bold;">
                                                    Rs.
                                                    {{ $payment->total_amount + $payment->doc_fees }}.00
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                    <div class="row mt-2">
                                        <div class="form-group col-lg-3">
                                            <label for="">Paid Status</label>
                                            <select name="paid_status" id="paid_status"
                                                class="form-control form-control-sm">
                                                <option value="" disabled selected>Select Status</option>
                                                <option value="full_paid">Full Paid</option>
                                                <option value="partial_paid">Partial Paid</option>
                                            </select>
                                            <input type="text" class="mt-1 form-control form-control-sm paid_amount"
                                                name="paid_amount" placeholder="Enter amount" style="display: none">
                                        </div>
                                        @php
                                            $current_date = date('d-m-Y');
                                        @endphp
                                        <div class="form-group col-sm-2">
                                            <label for="">Date</label>
                                            <input type="text" name="date" readonly value="{{ $current_date }}"
                                                class="form-control form-control-sm bg-light">
                                        </div>
                                        <div class="form-group float-right col-sm-7">
                                            <a class="btn btn-md bg-danger float-right" style="margin-top: 31px"
                                                href="{{ route('customers.credit') }}">Cancel</a>

                                            <input type="submit" value="Invoice Update"
                                                class="btn btn-md bg-sec float-right mr-2" style="margin-top: 31px">

                                        </div>
                                    </div>
                                </form>

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
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>

    <script>
        $(document).on('change', '#paid_status', function() {
            var paid_status = $(this).val();
            if (paid_status == 'partial_paid') {
                $('.paid_amount').show();
            } else {
                $('.paid_amount').hide();

            }

        });
    </script>
    <!-- /.content-wrapper -->
@endsection
