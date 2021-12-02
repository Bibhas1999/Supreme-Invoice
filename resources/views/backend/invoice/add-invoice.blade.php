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
        <section class="content">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row mt-2">
                    <!-- Left col -->

                    <section class="col-lg-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        
                        <div class="card text-dark px-2 ">
                            <div class="card-header">
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">GENERATE NEW INVOICE
                                    <a href="{{ route('home') }}" class="bg-sec  text-md text-white pt-1 float-left"> <i
                                        class="fas fa-arrow-left"></i> Back</a>
                                        <a href="{{ route('invoice.view') }}" class="font-weight-bold bg-sec  text-md text-sm pt-1 float-right text-white"> <i
                                            class="fas fa-list"></i> VIEW INVOICES</a>
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('invoice.store') }}" method="POST" id="myForm">
                                    @csrf
                                    <label for="" id="invoice_no_show">Invoice No. : #000{{ $invoice_no }}</label>
                                    <label for="" class="float-right" id=" date_show">Date. : {{ date('d-m-Y') }}</label>
                                    <h5 class="font-weight-bold pt-3">Patient Details : </h5>
                                    <div class="form-row new_customer px-3 py-3 bg-prim rounded-lg">
                                        <div class="form-group col-sm-3">
                                            <label for="">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="name" id="name"
                                                placeholder="Enter Patient Name">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="">Mobile No. <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="mobile_no"
                                                placeholder="Enter Mobile No." id="mobile_no">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Gender <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control form-control-sm">
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Age <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="age" id="age"
                                                placeholder="Enter Age">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Gurdian Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="co" id="co"
                                                placeholder="Enter Gurdian Name">
                                        </div>
                                        <div class="form-group col-sm-7">
                                            <label for="">Address </label>
                                            <textarea name="address" id="address" placeholder="Enter Full Address"
                                                class="form-control form-control-sm"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3 ">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="">Invoice No.</label>
                                                <label for="">
                                                    <input class="form-control form-control-sm bg-light" readonly id="invoice_no"
                                                        name="invoice_no" value="{{ $invoice_no }}"
                                                        >
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="">Date</label>
                                                <label for="date">
                                                    <input class="form-control form-control-sm bg-light" readonly id="date"
                                                        name="date" value="{{ date('d-m-Y') }}">
                                                </label>
                                            </div>
                                        </div>
                                        {{-- <input type="date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}"
                                        readonly id="date" placeholder="DD-MM-YYYY"> --}}


                                        <div class="col-sm-4">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Test Name</label>
                                                <select class="form-control form-control-sm select2 " name="test_id"
                                                    id="test_id">
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
                                                    name="price" id="price">
                                            </div>
                                        </div>


                                        <div class="col-md-1">
                                            <div class="form-group" style="margin-top: 31px;">
                                                <a class="btn btn-sm bg-sec text-white add addeventmore"><i
                                                        class="fa fa-plus-circle"></i> Add</a>
                                            </div>
                                        </div>

                                    </div>
                                    <table id="myForm" class="table table-responsive w-100 d-md-table d-block mt-3" width="100%">
                                        <thead class="bg-sec">
                                            <tr>

                                                <th class="text-center">Test Name</th>
                                                <th class="text-center" width="7%">No. of</th>
                                                <th class="text-center" width="10%">Unit Price</th>
                                                <th class="text-center" width="17%">Total Price</th>
                                                <th width="10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow bg-prim"></tbody>

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
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea name="description" id="description" class="form-control"
                                                placeholder="Write description here..."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row  px-3 py-3 bg-prim">
                                        <div class="form-group col-md-4">
                                            <label for="">Paid Status <span class="text-danger">*</span></label>
                                            <select name="paid_status" id="paid_status"
                                                class="form-control form-control-sm">
                                                <option value="" disabled selected>Select Status</option>
                                                <option value="full_paid">Full Paid</option>
                                                <option value="full_due">Full Due</option>
                                                <option value="partial_paid">Partial Paid</option>
                                            </select>
                                            <input type="text" class="mt-1 form-control form-control-sm paid_amount"
                                                name="paid_amount" placeholder="Enter amount" style="display: none">

                                        </div>
                                        {{-- <div class="form-group col-md-3">
                                            <label for=""> Doctor Fee(Rs.) </label>
                                            <input type="number" class="form-control form-control-sm" name="doc_fees"
                                                id="doc_fees" placeholder="Enter Doctor Fee " min="100">
                                        </div> --}}
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
                                        <div class="form-group col-sm-4">
                                            <label for="">Consultant Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="doctor"
                                                id="doctor" placeholder="Enter Consultant Name">
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
                                                                <input type="number" name="unit_price[]" required value="@{{ test_price }}" class=" text-right form-control form-control-sm bg-light unit_price" readonly>
                                                            </td>
                                                            
                                                            <td>
                                                                <input name="selling_price[]" value="0" class=" text-right form-control form-control-sm bg-light selling_price" readonly>
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
