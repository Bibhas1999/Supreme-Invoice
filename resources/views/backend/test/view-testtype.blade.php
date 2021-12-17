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
                                
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">ALL TEST CATEGORIES
                                    <a href="{{route('home')}}" class="text-center float-left text-md text-white mt-1 ml-2"> <i class="fas fa-arrow-left"></i> Back</a>

                                </h5>
                            </div>
                            <div class="card-body">
                                <a class="btn btn-sm bg-sec float-right shadow-lg text-white" data-toggle="modal" data-target="#ttAdd" > <i
                                    class="fa fa-plus-circle"></i> New</a>
                                    <span class="text-white float-right">h</span>
                                <table id="example1" class="table table-responsive w-100 d-md-table d-block" width="100%">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th width="7%">#</th>
                                            <th class="text-center" width="20%">Test Type</th>
                                            <th class="text-center" width="15%">Created By</th>
                                            <th class="text-center" width="15%">Created at</th>
                                            <th class="text-center" width="15%">Updated at</th>
                                            <th class="text-center" width="15%">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $ttype)

                                            <tr>
                                                <td width=""class="text-center">{{$key+1}}</td>
                                                <td class="text-center">{{$ttype->typename}}</td>
                                                <td class="text-center">{{$ttype->created_by}}</td>
                                                <td class="text-center">{{$ttype->created_at}}</td>
                                                <td class="text-center">{{$ttype->updated_at}}</td>
                                                
                                            
                                             
                                                <td class="text-center" >
                                               
                                                    <a href="{{route('testtypes.edit',$ttype->id)}}" class="btn bg-sec btn-sm"> <i class="fas fa-edit" data-toggle="modal" data-target="#deptEdit"></i> Edit</a>
                                                  
                                                    <a href="{{route('testtypes.delete',$ttype->id)}}" class="btn btn-danger btn-sm" id="delete"> Delete</a>
                                                              
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
    {{-- unit add modal --}}
    <div class="modal fade bd-example-modal-lg" id="ttAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-sec">
                    <h5 class="modal-title" id="exampleModalLabel">Add Test Type</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('testtypes.store')}}" id="myForm">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Test Type</label>
                                    <input type="text" class="form-control" placeholder="Enter Test Type" name="typename">
                                </div>
                            </div>
                            <div class="col-sm-3" style="padding-top:32px;">
                                <div class="form-group">
                                    <input type="submit" value="Submit" class="btn btn-md bg-sec px-4">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- unit add modal --}}



@endsection
