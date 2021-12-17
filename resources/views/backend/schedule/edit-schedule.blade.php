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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">EDIT DOCTOR SCHEDULE
                                    
                                </h5>
                            </div>
                            <div class="card-body">
                               
                                <form role="form" method="POST" action="{{ route('schedules.update',$editData->id) }}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Doctor Name</label>
                                                <select class="form-control form-control-sm" name="doctor_id">
                                                    <option selected=true disabled>Select Doctor</option>
                                                    @foreach ($docs as $doc)
                                                        <option value="{{ $doc->id }}" {{($editData->doctor_id==$doc->id)?"selected":''}}>{{ $doc->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Date</label>
                                                <select name="day" class="form-control form-control-sm" required>
                                                    <option selected disabled>Select Day</option>
                                                    <option value="1" {{($editData->day=="1")?"selected":''}}>Monday</option>
                                                    <option value="2" {{($editData->day=="2")?"selected":''}}>Teusday</option>
                                                    <option value="3" {{($editData->day=="3")?"selected":''}}>Wednesday</option>
                                                    <option disabled class="font-weight-bold">Thursday Closed</option>
                                                    <option value="5" {{($editData->day=="5")?"selected":''}}>Friday</option>
                                                    <option value="6" {{($editData->day=="6")?"selected":''}}>Saturday</option>
                                                    <option value="7" {{($editData->day=="7")?"selected":''}}>Sunday</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Start Time</label>
                                                <input type="time" class="form-control form-control-sm"
                                                placeholder="Enter Start Time" name="start_time" value="{{$editData->start_time}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>End Time</label>
                                                <input type="time" class="form-control form-control-sm"
                                                placeholder="Enter End Time" name="end_time" value="{{$editData->end_time}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3" style="padding-top:32px;">
                                            <div class="form-group">
                                                <input type="submit" value="Update Schedule" class="btn btn-sm bg-sec">
                                                <a href="{{route('schedules.view')}}" class="btn btn-sm btn-danger" >Cancel</a>
                                            </div>
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
