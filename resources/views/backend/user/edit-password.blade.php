@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-olive mt-0 py-5">
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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">CHANGE PASSWORD
                                </h5>
                             </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{route('profiles.password.update')}}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input type="password" autocomplete="off" class="form-control form-control-sm" placeholder="Enter Current Password" name="current_password">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" autocomplete="off" class="form-control form-control-sm" placeholder="Enter New Password" name="new_password" id="newpassword">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input type="password" autocomplete="off" class="form-control form-control-sm" placeholder="Confirm New Password" name="confirm_password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pt-2">
                                        <input type="submit" value="Submit" class="btn btn-sm bg-sec px-4">
                                        <a href="{{route("profiles.view")}}" class="btn btn-sm btn-danger">Cancel</a>
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
