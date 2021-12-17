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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">DOCTOR SCHEDULE
                                    <a href="{{ route('opd.view') }}" class="float-left text-white text-sm px-2 py-1"> <i
                                        class="fas fa-arrow-left"></i> Back </a>
                                </h5>
                            </div>
                            <div class="card-body">
                               
                                <form role="form" method="POST" action="{{ route('schedules.store') }}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Doctor Name</label>
                                                <select class="form-control form-control-sm" name="doctor_id">
                                                    <option selected=true disabled>Select Doctor</option>
                                                    @foreach ($docs as $doc)
                                                        <option value="{{ $doc->id }}">{{ $doc->name }}</option>
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
                                                    <option value="1">Monday</option>
                                                    <option value="2">Teusday</option>
                                                    <option value="3">Wednesday</option>
                                                    <option disabled class="font-weight-bold">Thursday Closed</option>
                                                    <option value="5">Friday</option>
                                                    <option value="6">Saturday</option>
                                                    <option value="7">Sunday</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Start Time</label>
                                                <input type="time" class="form-control form-control-sm"
                                                placeholder="Enter Start Time" name="start_time">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>End Time</label>
                                                <input type="time" class="form-control form-control-sm"
                                                placeholder="Enter End Time" name="end_time">
                                            </div>
                                        </div>

                                        <div class="col-sm-2" style="padding-top:32px;">
                                            <div class="form-group">
                                                <input type="submit" value="Add Schedule" class="btn btn-sm bg-sec">
                                            </div>
                                        </div>

                                    </div>

                                </form>
                                
                                
                                <span class="float-right text-white">h</span>
                                <table id="example1" class="table table-responsive w-100 d-md-table d-block" width="100%">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Doctor Name</th>
                                            <th class="text-center">Specialization</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Start Time</th>
                                            <th class="text-center">End Time</th>
                                            <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $schedule)
                                             @php
                                                 $doctor = App\Model\Doctor::where('id',$schedule->doctor_id)->first();
                                             @endphp
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $doctor->name }}</td>
                                                <td class="text-center">{{ $doctor->spec }}</td>
                                                <td class="text-center">
                                                    @if ($schedule->day == '1')
                                                    Monday
                                                    @elseif($schedule->day == '2')
                                                    Tuesday 
                                                    @elseif($schedule->day == '3')
                                                    Wednesday   
                                                    @elseif($schedule->day == '4')
                                                    Thursday    
                                                    @elseif($schedule->day == '5')
                                                    Friday    
                                                    @elseif($schedule->day == '6')
                                                    Saturday   
                                                    @elseif($schedule->day == '7')
                                                    Sunday   
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $schedule->start_time }}</td>
                                                <td class="text-center">{{ $schedule->end_time }}</td>
                                                <td class="text-center">

                                                    <a href="{{ route('schedules.edit', $schedule->id) }}"
                                                        class="btn bg-sec btn-sm"> <i class="fas fa-edit"></i> Edit</a>

                                                    <a href="{{ route('schedules.delete', $schedule->id) }}"
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
