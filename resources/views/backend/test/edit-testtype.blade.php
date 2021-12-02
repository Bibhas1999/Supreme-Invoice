
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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">EDIT TEST CATEGORY
                                   
                                </h5>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{route('testtypes.update',$editData->id)}}">
                                    @csrf
                                    <div class="row">
                                       
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Test Type </label>
                                                <input type="text" required class="form-control form-control-sm" placeholder="Enter Username" name="typename" value="{{$editData->typename}}">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <input type="submit" value="Submit" class="btn btn-sm bg-sec " style="margin-top:32px">
                                            <a class="btn btn-sm bg-danger" href="{{route('testtypes.view')}}" style="margin-top:32px">Cancel </a>
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

