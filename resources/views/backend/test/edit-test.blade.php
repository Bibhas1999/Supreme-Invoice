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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">EDIT TEST
                                   
                                </h5>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('tests.update',$editData->id) }}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Test Name</label>
                                                <input type="text" required class="form-control form-control-sm" placeholder="Enter Test name"
                                                    name="name" value="{{$editData->name}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control form-control-sm" name="type_id">
                                                    <option selected=true disabled>Select Type</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}" {{($editData->type_id==$type->id)?"selected":''}}>{{ $type->typename }}</option>
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
                                                        <option value="{{ $dept->id }}" {{($editData->dept_id==$dept->id)?"selected":''}}>{{ $dept->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control form-control-sm" placeholder="Enter Test price" name="price" value="{{$editData->price}}" >
                                            </div>
                                        </div>
                                        
                                        <div class="form-group ">
                                            <input type="submit" value="Submit" class="btn btn-sm bg-sec " style="margin-top:32px">
                                            <a class="btn btn-sm bg-danger" href="{{route('tests.view')}}" style="margin-top:32px">Cancel </a>
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
