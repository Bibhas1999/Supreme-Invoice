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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">EDIT PROFILE
                                </h5>
                             </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('profiles.update', Auth::user()->id) }}"
                                    id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        @if (Auth::user()->usertype == 'Admin')
                                            <div class="col-sm-3">
                                                <!-- select -->
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select class="form-control form-control-sm" name="usertype">
                                                        <option selected=true disabled>Select Role</option>
                                                        <option value=" Admin"
                                                            {{ $editData->usertype == 'Admin' ? 'selected' : '' }}>Admin
                                                        </option>
                                                        <option value="Manager"
                                                            {{ $editData->usertype == 'Manager' ? 'selected' : '' }}>Manager
                                                        </option>
                                                        <option value="User"
                                                            {{ $editData->usertype == 'User' ? 'selected' : '' }}>User
                                                        </option>
                                                        <option value="Receptionist"
                                                            {{ $editData->usertype == 'Receptionist' ? 'selected' : '' }}>Receptionist
                                                        </option>
                                                    </select>
                                                </div>


                                            </div>
                                          
                                        @endif
                                        @if (Auth::user()->usertype == 'Admin')
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control form-control-sm"
                                                        placeholder="Enter Email" name="email"
                                                        value="{{ $editData->email }}">
                                                </div>
                                            </div>
                                            @else 

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control form-control-sm"
                                                        placeholder="Enter Email" name="email" readonly
                                                        value="{{ $editData->email }}">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Username" name="name"
                                                    value="{{ $editData->name }}">

                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control form-control-sm" name="gender">
                                                    <option selected=true disabled>Select Gender</option>
                                                    <option value="Male"
                                                        {{ $editData->gender == 'Male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="Female"
                                                        {{ $editData->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Mobile No." name="mobile"
                                                    value="{{ $editData->mobile }}">

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <input type="file" name="image" value="{{ $editData->image }}"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <textarea name="address" id="" cols="80" rows="2"
                                                    class="form-control">{{ $editData->address }}</textarea>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="form-group pt-2">
                                        <input type="submit" value="Update" class="btn btn-sm bg-sec px-4">
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
