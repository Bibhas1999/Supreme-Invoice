 @extends('backend.layouts.master')
 @section('content')


     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper bg-prim mt-0 py-5">
         <!-- Main content -->
         <section class="content pt-4 ">
             <div class="container-fluid ">

                 <!-- Main row -->
                 <div class="row">
                     <!-- Left col -->
                     <section class="col-lg-12 m-0 p-0">
                        
                         <!-- Custom tabs (Charts with tabs)-->
                         <div class="card text-dark">
                             <div class="card-header">
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">ALL USERS 
                                    <a href="{{ route('home') }}"
                                        class="text-white text-md pt-1 float-left"><i class="fas fa-arrow-left "></i> Back</a>
                                </h5>
                             </div>
                             <div class="card-body">
                                <a href="" class="btn btn-sm float-right bg-sec" data-toggle="modal"
                                data-target="#userAdd"> <i class="fa fa-plus-circle"></i> New</a>
                                <span class="text-white float-right">i</span>
                                <table id="example1" class="table table-responsive w-100 d-md-table d-block">
                                     <thead class="bg-prim">
                                         <tr>
                                             <th class="text-center">#</th>
                                             <th class="text-center">Name</th>
                                             <th class="text-center">Email</th>
                                             <th class="text-center">Role</th>
                                             <th class="text-center">Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($allData as $key => $user)
                                         @if (Auth::user() != $user)
                                             <tr>

                                                 <td class="text-center">{{ $key + 1 }}</td>
                                                 <td class="text-center">{{ $user->name }}</td>
                                                 <td class="text-center">{{ $user->email }}</td>
                                                 <td class="text-center" class="text-center"> <span class="badge bg-olive font-weight-bold " >{{ $user->usertype}}</span></td>
                                                 <td class="text-center" class="text-center">
                                                     <a href="{{ route('users.edit', $user->id) }}"
                                                         class="btn bg-sec btn-sm"> <i class="fa fa-edit"></i> Edit</a>
                                                     
                                                         <a href="{{ route('users.delete', $user->id) }}"
                                                             class="btn btn-danger btn-sm" id="delete"> Delete</a>
                                                     
                                                 </td>
                                             </tr>
                                          @endif
                                         @endforeach

                                     </tbody>

                                 </table>
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

     {{-- user Add --}}
     <div class="modal fade bd-example-modal-lg" id="userAdd" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header bg-sec">
                     <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                     <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form role="form" method="POST" action="{{ route('users.store') }}" id="myForm">
                         @csrf
                         <div class="row">
                             <div class="col-sm-2">
                                 <!-- select -->
                                 <div class="form-group">
                                     <label>Role</label>
                                     <select class="form-control form-control-sm" name="usertype">
                                         <option selected=true disabled>Select Role</option>
                                         <option value=" Admin">Admin</option>
                                         <option value="Manager">Manager</option>
                                         <option value="User">User</option>
                                         <option value="Receptionist">Receptionist</option>
                                     </select>
                                     
                                 </div>
                             </div>
                             <div class="col-sm-2">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control form-control-sm" name="dept">
                                        <option selected=true disabled>Select Department</option>
                                        @foreach ($depts as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                            </div>
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label>Username</label>
                                     <input type="text" class="form-control form-control-sm" placeholder="Enter Username" name="name">
                                    
                                 </div>
                             </div>
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label>Email</label>
                                     <input type="email" class="form-control form-control-sm" placeholder="Enter Email" name="email">
                                     <font class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}
                                     </font>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-sm-5">
                                 <!-- text input -->
                                 <div class="form-group">
                                     <label>Password</label>
                                     <input type="password" class="form-control form-control-sm" placeholder="Enter Password"
                                         name="password" id="password">
                                     <font class="text-danger">
                                         {{ $errors->has('password') ? $errors->first('password') : '' }}</font>
                                 </div>
                             </div>
                             <div class="col-sm-5">
                                 <div class="form-group">
                                     <label>Confirm Password</label>
                                     <input type="password" class="form-control form-control-sm" placeholder="Retype Password"
                                         name="password2">
                                     <font class="text-danger">
                                         {{ $errors->has('password2') ? $errors->first('password2') : '' }}</font>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group pt-2">
                             <input type="submit" value="Submit" class="btn btn-md bg-sec px-4">
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     {{-- user add modal --}}


     

     <!-- /.content-wrapper -->


 @endsection
