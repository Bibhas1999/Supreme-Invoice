@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-prim mt-0 py-5">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        
                        <div class="card text-dark">
                            <div class="card-header">
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">DOCTORS
                                    <a href="{{ route('opd.view') }}" class="float-left text-white text-sm px-2 py-1"> <i
                                        class="fas fa-arrow-left"></i> Back </a>
                                </h5>
                            </div>
                            <div class="card-body">
                               
                                <form role="form" method="POST" action="{{ route('doctors.store') }}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Doctor name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Specialization</label>
                                                <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter Specialization" name="spec">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Degree</label>
                                                <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter Degree" name="degree">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Fees(Rs)</label>
                                                <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter Doctor Fee Amount" name="fees">
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="padding-top:32px;">
                                            <div class="form-group">
                                                <input type="submit" value="Add Doctor" class="btn btn-sm bg-sec">
                                            </div>
                                        </div>

                                    </div>

                                </form>
                                
                                
                                <span class="float-right text-white">h</span>
                                <table id="example1" class="table table-responsive w-100 d-md-table d-block" width="100%">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Specialization</th>
                                            <th class="text-center">Degree</th>
                                            <th class="text-center">Fees</th>
                                            <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $doctor)

                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $doctor->name }}</td>
                                                <td class="text-center">{{ $doctor->spec }}</td>
                                                <td class="text-center">{{ $doctor->degree }}</td>
                                                <td class="text-center">Rs. {{ $doctor->fees }}</td>
                                                <td class="text-center">

                                                    <a href="{{ route('doctors.edit', $doctor->id) }}"
                                                        class="btn bg-sec btn-sm"> <i class="fas fa-edit"></i> Edit</a>

                                                    <a href="{{ route('doctors.delete', $doctor->id) }}"
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



@endsection
