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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">EDIT USER
                                </h5>
                             </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('users.update', $editData->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control form-control-sm" name="usertype">
                                                    <option selected=true disabled>Select Role</option>
                                                    <option value="Admin"
                                                        {{ $editData->usertype == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="Manager"
                                                        {{ $editData->usertype == 'Manager' ? 'selected' : '' }}>Manager
                                                    </option>
                                                    <option value="User" {{ $editData->usertype == 'User' ? 'selected' : '' }}>
                                                        User</option>
                                                    <option value="Receptionist"
                                                        {{ $editData->usertype == 'Receptionist' ? 'selected' : '' }}>
                                                        Receptionist</option>
                                                </select>
                                                <font class="text-danger">
                                                    {{ $errors->has('usertype') ? $errors->first('usertype') : '' }}</font>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control form-control-sm" name="dept">
                                                    <option selected=true disabled>Select Department</option>
                                                    @foreach ($depts as $dept)
                                                        <option value="{{ $dept->id }}"
                                                            {{ $editData->dept == $dept->id ? 'selected' : '' }}>
                                                            {{ $dept->name }}</option>
                                                    @endforeach
                                                </select>
                                                <font class="text-danger">
                                                    {{ $errors->has('usertype') ? $errors->first('usertype') : '' }}</font>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control form-control-sm" placeholder="Enter Username"
                                                    name="name" value="{{ $editData->name }}">
                                                <font class="text-danger">
                                                    {{ $errors->has('name') ? $errors->first('name') : '' }}</font>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control form-control-sm" placeholder="Enter Email"
                                                    name="email" value="{{ $editData->email }}">
                                                <font class="text-danger">
                                                    {{ $errors->has('email') ? $errors->first('email') : '' }}</font>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pt-2">
                                        <input type="submit" value="Submit" class="btn btn-sm bg-sec px-4">
                                        <a href="{{route('users.view')}}" class="btn btn-sm btn-danger">Cancel</a> 
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
