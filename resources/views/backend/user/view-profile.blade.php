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
                    <div class="col-lg-4"></div>
                    <section class="col-lg-4">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card text-dark">
                            <div class="card-body box-profile">
                                <a href="{{route('home')}}" class="text-center align-items-center btn bg-sec btn-sm"> <i class="fas fa-arrow-left"></i> Back</a>
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" style="height:130px; width:130px"
                                        src="{{ !empty($user->image) ? url('./upload/user_images/' . $user->image) : url('./upload/user_images/no-user.png') }}"
                                        name="image" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center text-capitalize">{{ $user->name }}</h3>
                                <p class="text-muted text-center">{{ $user->email }}</p>
                                <p class="text-muted text-center">{{ $user->usertype }}</p>
                                
                                <p class="text-muted text-center">{{ $user->dept }}</p>
                                
                                <a href="{{ route('profiles.edit') }}" class="btn bg-sec btn-block text-white"><b> <i
                                            class="fas fa-edit"></i> Edit
                                        Profile</b></a>
                                    <a href="{{ route('profiles.password.view') }}" class="btn bg-sec btn-block text-white"><b> <i
                                            class="fas fa-key"></i> Change Password</b></a>
 
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                    <!-- /.Left col -->
                    <div class="col-lg-4"></div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
