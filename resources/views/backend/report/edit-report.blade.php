@extends('backend.layouts.master')
@section('content')

    @php
    $data = $editData->id;
    $test_id = App\Model\Test::where('id', $editData->id)->first();
    $dept_id = App\Model\Dept::where('id', $test_id->dept_id)->first();
    $payment = App\Model\Payment::where('invoice_id', $editData->invoice_id)->first();
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
                                
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">EDIT REPORT
                                </h5>
                            </div>
                            <div class="card-body">
                                <label for="" id="invoice_no_show">Report ID - {{ $editData->id }}</label>
                                <label for="" class="float-right" id=" date_show">Date - {{ date('d-m-Y') }}</label>
                                <hr class="mt-1">

                                <div class="row">
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
                                    <div class="col-sm-3">
                                        <label for="">Mobile No. : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['mobile_no'] }}</span></label>
                                    </div>
                                    

                                </div>

                                <div class="row mt-3 mb-3">
                                    <div class="col-sm-3">
                                        <label for="">Gurdian Name : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['co'] }}</span></label>
                                    </div>
                                    <div class="col-sm-5">

                                        <label for="">Address : <span
                                                class="font-weight-normal text-md text-center">{{ $payment['customer']['address'] }}</span></label>

                                    </div>
                                    <div class="col-sm-3">

                                        <label for="">Ref. Physician : <span
                                                class="font-weight-normal text-md text-center">{{ $editData->doctor }}</span></label>

                                    </div>
                                </div>
                                <form method="POST" action="{{ route('update-report', $editData->id) }}" id="myForm" class="mt-4  px-3 py-2 bg-prim">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Report ID</label>
                                                <input type="text" class="form-control form-control-sm bg-white"
                                                    placeholder="Report ID" name="report_id" value="{{ $editData->id }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Date/Time</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    value="{{ $editData->updated_at }}" name="report_date">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Modality</label>
                                                <input type="text" class="form-control form-control-sm "
                                                    placeholder="Enter Modality" name="report_mod" value="{{$editData->report_mod}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Report Name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Report Name" name="report_name" value="{{$editData->report_name}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Doctor Details</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Name, Degree, Specialization" name="report_tech" value="{{$editData->report_tech}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="text-gray">Report Study</label>
                                            <textarea id="mytextarea" name="report_study" > {!!$editData->report_study!!}</textarea>
                                        </div>

                                        <div class="col-lg-12 mt-2">
                                            <label for="">Report Impression</label>
                                            <textarea name="report_imp" id="report_imp" >{{$editData->report_imp}}</textarea>
                                        </div>
                                        <div class="col-sm-4" style="padding-top:32px;">
                                            <div class="form-group">
                                                <input type="submit" value="Update Report" class="btn  bg-sec">
                                                <a href="{{route('dept_single.view',$dept_id)}}" class="btn bg-danger">Cancel</a>
                                            </div>
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
    <!-- /.content-wrapper -->
    <script src="{{ asset('backend/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            height: "500",
            resize: false,
            branding: false,
            forced_root_block: "",
            mobile: {
                
                menubar: true
            },
            toolbar:
    "undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent",
        });
    </script>
    <script>
        tinymce.init({
            selector: '#report_imp',
            height: "300",
            resize: false,
            branding: false,
            forced_root_block: "",
            toolbar:
          "undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent",
            
        });
    </script>
@endsection
