@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-prim mt-0 py-5">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->

                    <section class="col-lg-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <h5 class="text-center bg-sec rounded-lg shadow-lg mt-3 py-2 px-2 ">EDIT INVOICE
                        </h5>
                        <div class="card text-dark">
                            <div class="card-body">
                                 <label for="">Invoice No : #000{{$editData->invoice_no}}</label>
                                 <label for="" class="float-right">Date : {{ date('d-m-Y',strtotime($editData->date)) }}</label>
                                <form id="myForm" action="{{ route('add-more-invoice', $editData->id) }}" method="post">
                                    @csrf
                                    
                                    <div class="row mt-3 ">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="">Invoice No.</label>
                                                <label for="">
                                                    <input class="form-control form-control-sm bg-light" readonly id="invoice_no"
                                                        name="invoice_no" value="{{ $editData->invoice_no }}" required>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="">Date</label>
                                                <label for="date">
                                                    <input class="form-control form-control-sm bg-light" readonly id="date"
                                                        name="date" value="{{ date('d-m-Y') }}"
                                                        style="background-color:#eee" required>
                                                </label>
                                            </div>
                                        </div>
                                      

                                        <div class="col-sm-4">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Test Name</label>
                                                <select class="form-control form-control-sm select2 " name="test_id"
                                                    required id="test_id">
                                                    <option selected=true disabled>Select Test</option>
                                                    @foreach ($tests as $test)
                                                        <option value="{{ $test->id }}">{{ $test->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Rate/Price(Rs)</label>
                                                <input type="text" class="form-control form-control-sm bg-light" readonly
                                                    name="price" id="price" required>
                                            </div>
                                        </div>


                                        <div class="col-md-1">
                                            <div class="form-group" style="margin-top: 31px;">
                                                <a class="btn btn-sm bg-sec text-white add addeventmore"><i
                                                        class="fa fa-plus-circle"></i> Add</a>
                                            </div>
                                        </div>

                                    </div>

                                    <table id="myForm" class="table mt-3 table-responsive w-100 d-md-table d-block" width="100%">
                                        <thead class="bg-sec">

                                            <tr>

                                                <th class="text-center">Test Name</th>
                                                <th class="text-center" width="7%">No. of</th>
                                                <th class="text-center" width="10%">Unit Price</th>
                                                <th class="text-center" width="17%">Total Price</th>
                                                <th width="10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow">

                                        </tbody>

                                        <tbody>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right">Discount(%)

                                                </td>
                                                <td> <input type="text" class="form-control form-control-sm"
                                                        name="discount_amount" id="discount_amount" autocomplete="off">
                                                    <label for="" id="label"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right">Grand Total</td>
                                                <td>
                                                    <input type="text"
                                                        class="form-control form-control-sm text-right estimated_amount bg-light"
                                                        name="estimated_amount" value="0" id="estimated_amount" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="submit" value="Update test" class="btn bg-sec btn-sm mb-2 ">
                                </form>
                                <form action="{{ route('invoice.update', $editData->id) }}" method="POST" id="myForm">
                                    @csrf
                                    <table class="table mt-3 table-responsive w-100 d-md-table d-block" width="100%">
                                        <thead>
                                            <tr class="text-center bg-prim" >
                                                <th class="fth">SL No.</th>
                                                <th class="fth">Test Name</th>
                                                <th class="fth">Quantity</th>
                                                <th class="fth">Unit Price</th>
                                                <th class="fth">Total Price</th>
                                                <th class="fth">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_sum = '0';
                                                $invoice_details = App\Model\InvoiceDetails::where('invoice_id', $payment->invoice_id)->get();
                                            @endphp
                                            @foreach ($invoice['invoice_details'] as $key => $details)
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
                                                    <td class="ftd"><a
                                                            href="{{ route('invoice-details.delete', $details->id) }}"
                                                            class="btn btn-sm btn-danger" id="delete">Delete</a></td>
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
                                                        <td></td>
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
                                                    <td></td>
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
                                                    <td></td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td class="utd" colspan="4"
                                                    style="text-align:right;padding-top:10px">Paid
                                                    Amount :</td>
                                                <td class="utd" style="padding-top:10px; text-align:center;">Rs.
                                                    {{ $payment->paid_amount }}.00
                                                </td>
                                                <td></td>
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
                                                    <td></td>
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
                                                <td></td>
                                            </tr>
                                           
                                        </tbody>

                                    </table>

                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea name="description" id="description" class="form-control"
                                                placeholder="Write description here..."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row  px-3 py-3 bg-prim">
                                        <div class="form-group col-md-3">
                                            <label for="">Paid Status <span class="text-danger">*</span></label>
                                            <select name="paid_status" id="paid_status"
                                                class="form-control form-control-sm">
                                                <option value="" disabled selected>Select Status</option>
                                                <option value="full_paid"
                                                    {{ $payment->paid_status == 'full_paid' ? 'selected' : '' }}>Full
                                                    Paid</option>
                                                <option value="full_due"
                                                    {{ $payment->paid_status == 'full_due' ? 'selected' : '' }}>Full Due
                                                </option>
                                                <option value="partial_paid"
                                                    {{ $payment->paid_status == 'partial_paid' ? 'selected' : '' }}>
                                                    Partial Paid</option>
                                            </select>
                                            <input type="text" class="mt-1 form-control form-control-sm paid_amount"
                                                name="paid_amount" placeholder="Enter amount" style="display: none">

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""> Doctor Fee(Rs.) </label>
                                            <input type="number" class="form-control form-control-sm" name="doc_fees"
                                                id="doc_fees" placeholder="Enter Doctor Fee " min="100"
                                                value="{{ $payment->doc_fees }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="">Payment Mode <span class="text-danger">*</span></label>
                                            {{-- <input type="text" class="form-control form-control-sm"
                                        name="payment_mode" placeholder="Enter Payment Mode"> --}}
                                            <select name="payment_mode" id="payment_mode"
                                                class="form-control form-control-sm">
                                                <option value="" disabled selected>Select Payment Mode</option>
                                                <option value="cash"
                                                    {{ $payment->payment_mode == 'cash' ? 'selected' : '' }}>Cash
                                                </option>
                                                <option value="online"
                                                    {{ $payment->payment_mode == 'online' ? 'selected' : '' }}>Online
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="">Consultant Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="doctor"
                                                id="doctor" placeholder="Enter Consultant Name"
                                                value="{{ $editData->doctor }}">
                                        </div>

                                    </div>
                                    <h5 class="font-weight-bold pt-3">Patient Details : </h5>
                                    <div class="form-row new_customer px-3 py-3 bg-prim">
                                        <div class="form-group col-sm-3">
                                            <label for="">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="name" id="name"
                                                placeholder="Enter Patient Name"
                                                value="{{ $payment['customer']['name'] }}">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="">Mobile No. <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="mobile_no"
                                                placeholder="Enter Mobile No." id="mobile_no"
                                                value="{{ $payment['customer']['mobile_no'] }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Gender <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control form-control-sm">
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="male"
                                                    {{ $payment['customer']['gender'] == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female"
                                                    {{ $payment['customer']['gender'] == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="others"
                                                    {{ $payment['customer']['gender'] == 'others' ? 'selected' : '' }}>
                                                    Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Age <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="age" id="age"
                                                placeholder="Enter Age" value="{{ $payment['customer']['age'] }}">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Gurdian Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="co" id="co"
                                                placeholder="Enter Gurdian Name" value="{{ $payment['customer']['co'] }}">
                                        </div>
                                        <div class="form-group col-sm-7">
                                            <label for="">Address </label>
                                            <textarea name="address" id="address" placeholder="Enter Full Address"
                                                class="form-control form-control-sm">{{ $payment['customer']['address'] }}</textarea>
                                        </div>
                                    </div>




                                    <div class="form-group pt-2">
                                        <button type="submit" class="btn btn-md bg-sec" id="storeButton">Update
                                            Invoice</button>
                                        <a type="submit" href="{{route('invoice.view')}}" class="btn btn-md bg-danger" id="storeButton">Cancel</a>
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

    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" class="delete_add_more_item">
                                                                                  <input type="hidden" name="date" value="@{{ date }}">
                                                                                 <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
                                                                                 <td>
                                                                                    <input type="hidden" name="test_id[]" value="@{{ test_id }}">
                                                                                    @{{ test_name }}
                                                                                 </td>
                                                                                
                                                                                 <td>
                                                                                    <input type="number" name="selling_qty[]" min="1" required value="1" class="text-right form-control form-control-sm selling_qty">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="unit_price[]" required value="@{{ test_price }}" class=" text-right form-control form-control-sm unit_price" readonly>
                                                                                </td>
                                                                                
                                                                                <td>
                                                                                    <input name="selling_price[]" value="0" class=" text-right form-control form-control-sm selling_price" readonly>
                                                                                </td>
                                                                               
                                                                                <td class="text-center">
                                                                                    <a class="btn btn-danger btn-sm  removeeventmore"><i class="fa fa-window-close text-white"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        </script>

    <script>
        $(function() {
            $(document).on('change', '#test_id', function() {

                var test_id = $(this).val();

                $.ajax({

                    url: "{{ route('get-price') }}",
                    type: "GET",
                    data: {
                        test_id: test_id
                    },
                    success: function(data) {

                        $('#price').val(data);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $(document).on("click", ".addeventmore", function() {

                var date = $('#date').val();
                var invoice_no = $('#invoice_no').val();
                var test_id = $('#test_id').val();
                var test_name = $('#test_id').find('option:selected').text();
                var test_price = $('#price').val();

                if (date == '') {

                    return false;
                }

                if (invoice_no == '') {
                    return false;
                }

                if (test_id == '') {
                    return false;
                }


                var source = $('#document-template').html();
                var template = Handlebars.compile(source);
                var data = {

                    date: date,
                    invoice_no: invoice_no,
                    test_id: test_id,
                    test_name: test_name,
                    test_price: test_price

                };
                var html = template(data);
                $('#addRow').append(html);
                $('.selling_qty').focus().trigger('change');

            });

            $(document).on("click", ".removeeventmore", function(event) {

                $(this).closest(".delete_add_more_item").remove();
                $('#discount_amount').val("");
                $('#estimated_amount').val("");
                $('#label').text("Rs. " + dis_per.toFixed(2));
                totalAmountPrice();
            });

            $(document).on('keyup click change', '.unit_price, .selling_qty', function() {

                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.selling_qty").val();
                var total = unit_price * qty;
                var selling_price = $(this).closest("tr").find("input.selling_price").val(total);

                $('#discount_amount').trigger('keyup');
            });

            $(document).on("keyup", '#discount_amount', function() {

                totalAmountPrice();
            });

            function totalAmountPrice() {

                var sum = 0;
                $(".selling_price").each(function() {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });

                var discount_amount = parseFloat($('#discount_amount').val());


                if (!isNaN(discount_amount) && discount_amount.length != 0) {
                    var dis_per = 0;
                    dis_per = sum * (discount_amount / 100);
                    $('#label').text("Rs. " + dis_per.toFixed(2));
                    sum -= parseFloat(dis_per);
                }

                $('#estimated_amount').val(sum);
            }
        });
    </script>


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


@endsection
