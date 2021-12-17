@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-prim mt-0 py-5">

        <!-- Main content -->
        <section class="content pt-4">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->

                    <section class="col-lg-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card text-dark">
                            <div class="card-header">
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">EDIT DOCTOR
                                   
                                </h5>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('doctors.update',$editData->id) }}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Doctor name" name="name" value="{{$editData->name}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Specialization</label>
                                                <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter Specialization" name="spec" value="{{$editData->spec}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Degree</label>
                                                <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter Degree" name="degree" value="{{$editData->degree}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Fees(Rs)</label>
                                                <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter Doctor Fee Amount" name="fees" value="{{$editData->fees}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-2" style="padding-top:32px;">
                                            <div class="form-group ">
                                                <input type="submit" value="Submit" class="btn btn-sm bg-sec " >
                                                <a class="btn btn-sm bg-danger" href="{{route('doctors.view')}}" >Cancel </a>
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
@endsection
