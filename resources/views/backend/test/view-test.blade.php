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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">ALL TESTS
                                   
                                </h5>
                            </div>
                            <div class="card-body">
                               
                                <form role="form" method="POST" action="{{ route('tests.store') }}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Test Name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Test name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control form-control-sm" name="type_id">
                                                    <option selected=true disabled>Select Type</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->typename }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control form-control-sm" name="dept_id">
                                                    <option selected=true disabled>Select Department</option>
                                                    @foreach ($depts as $dept)
                                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Test price" name="price">
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="padding-top:32px;">
                                            <div class="form-group">
                                                <input type="submit" value="Add Test " class="btn btn-sm bg-sec">
                                            </div>
                                        </div>

                                    </div>

                                </form>
                                
                                <a href="{{ route('depts.view') }}" class="btn btn-sm  bg-sec float-left">
                                    <i class="fas fa-building"></i> Departments
                                </a>
                                <span class="text-white float-left">i</span>
                                <a href="{{ route('testtypes.view') }}" class="btn btn-sm  bg-sec float-left">
                                    <i class="fas fa-temperature-low"></i> Test Category
                                </a>
                                <a href="{{route('test.print.list')}}" target="__blank"
                                    class="btn btn-sm bg-sec float-right">
                                    <i class="fas fa-download"></i> PDF
                                </a>
                                <span class="float-right text-white">h</span>
                                <table id="example1" class="table table-responsive w-100 d-md-table d-block" width="100%">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $test)

                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $test->name }}</td>
                                                <td class="text-center">{{ $test['type']['typename'] }}</td>
                                                <td class="text-center">{{ $test['dept']['name'] }}</td>
                                                <td class="text-center"> <i class="fas fa-rupee-sign text-sm"></i>
                                                    {{ $test->price }}</td>

                                                <td class="text-center">

                                                    <a href="{{ route('tests.edit', $test->id) }}"
                                                        class="btn bg-sec btn-sm"> <i class="fas fa-edit"
                                                            data-toggle="modal" data-target="catAdd"></i> Edit</a>

                                                    <a href="{{ route('tests.delete', $test->id) }}"
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
