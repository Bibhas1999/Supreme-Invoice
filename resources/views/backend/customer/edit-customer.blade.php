@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper mt-0 py-5">
        <!-- Main content -->
        <section class="content pt-4">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->

                    <section class="col-lg-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h3>Edit Customers
                                    <a href="{{route('customers.view')}}" class="btn btn-md btn-primary float-right"> <i class="fas fa-people-arrows"></i>
                                        Customers</a>
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form role="form" method="POST" action="{{route('customers.update',$editData->id)}}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Username" name="name" value="{{$editData->name}}">
                                                <font class="text-danger">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Enter Email" name="email"  value="{{$editData->email}}">
                                                <font class="text-danger">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input type="text" class="form-control" placeholder="Enter Mobile No." name="mobile_no"  value="{{$editData->mobile_no}}">
                                                <font class="text-danger">{{($errors->has('mobile_no'))?($errors->first('mobile_no')):''}}</font>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="address" >{{$editData->address}}</textarea>
                                                <font class="text-danger">{{($errors->has('address'))?($errors->first('address')):''}}</font>  
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form-group pt-2">
                                        <input type="submit" value="Submit" class="btn btn-md btn-primary px-4">
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
