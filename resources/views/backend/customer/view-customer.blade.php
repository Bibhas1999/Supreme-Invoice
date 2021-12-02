@extends('backend.layouts.master')
@section('content')

@php
    $credit_customer = App\Model\Payment::where('paid_status','partial_paid')->count();
    $paid_customer = App\Model\Payment::where('paid_status','full_paid','partial_paid')->count();
@endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper mt-0 py-5">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 position-fixed m-0 p-0">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-body pt-3">
                        
                                <table id="example1" class="table" width="100%">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="text-center" width="5%">#</th>
                                            <th class="text-center" width="15%">Name</th>
                                            <th class="text-center" width="20%">Email</th>
                                            <th class="text-center" width="12%">Mobile No.</th>
                                            <th class="text-center" width="25%">Address</th>
                                            <th class="text-center" width="7%">Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $customer)

                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $customer->name }}</td>
                                                <td class="text-center">{{ $customer->email }}</td>
                                                <td class="text-center">{{ $customer->mobile_no }}</td>
                                                <td class="text-center">{{ $customer->address }}</td>
                                                <td class="text-center">{{ $customer->created_at }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('customers.edit', $customer->id) }}"
                                                        class="btn btn-info btn-sm"> <i class="fa fa-edit"></i> Edit</a>

                                                    <a href="{{ route('customers.delete', $customer->id) }}"
                                                        class="btn btn-danger btn-sm" id="delete"> Delete</a>

                                                </td>
                                            </tr>

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
    <!-- /.content-wrapper -->

    <div class="modal fade bd-example-modal-lg" id="custAdd" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{route('customers.store')}}" id="myForm">
                    @csrf
                    <div class="row">
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" placeholder="Enter Username" name="name">
                                <font class="text-danger">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Enter Email" name="email">
                                <font class="text-danger">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile No." name="mobile_no">
                                <font class="text-danger">{{($errors->has('mobile_no'))?($errors->first('mobile_no')):''}}</font>
                            </div>
                        </div>

                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="address"></textarea>
                                <font class="text-danger">{{($errors->has('address'))?($errors->first('address')):''}}</font>  
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group pt-2">
                        <input type="submit" value="Submit" class="btn btn-md btn-primary px-4">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
