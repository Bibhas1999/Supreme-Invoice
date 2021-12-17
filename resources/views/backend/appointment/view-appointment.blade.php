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
                                <h5 class="text-center bg-sec rounded-lg shadow-lg py-2 px-2 font-weight-bold">APPOINTMENTS
                                    <a href="{{ route('opd.view') }}" class="float-left text-white text-sm px-2 py-1"> <i
                                            class="fas fa-arrow-left"></i> Back </a>
                                </h5>
                            </div>
                            <div class="card-body">

                                <form role="form" method="POST" action="{{ route('apps.store') }}" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Patient Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Patient Name" name="patient_name">
                                                    @error('patient_name')
                                                    <span class="text-danger text-sm">Please provide patient name</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Patient Age<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Patient Age" name="patient_age">
                                                @error('age')
                                                    <span class="text-danger text-sm">Please provide patient age</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Gender <span class="text-danger">*</span></label>
                                                <select name="patient_gender" id="gender"
                                                    class="form-control form-control-sm">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="others">Others</option>
                                                </select>
                                                @error('gender')
                                                <span class="text-danger text-sm">Please select a gender</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Patient Email<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control form-control-sm"
                                                    placeholder="Enter Patient Email" name="patient_email">
                                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Patient Mobile No.<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Mobile No." name="patient_mobile">
                                                    @error('patient_mobile')
                                                    <span class="text-danger text-sm">Please provide mobile no.</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Gurdian Name.<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Gurdian Name." name="gurdian_name">
                                                    @error('gurdian_name')
                                                    <span class="text-danger text-sm">Please provide gurdian name</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label for="">Address <span class="text-danger">*</span></label>
                                            <textarea name="patient_address" id="address" placeholder="Enter Full Address"
                                                class="form-control form-control-sm"></textarea>
                                                @error('patient_address')
                                                <span class="text-danger text-sm">Please provide address</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Schedule <span class="text-danger">*</span></label>
                                                <select class="form-control form-control-sm" name="schedule_id">
                                                    <option selected=true disabled>Select Schedule</option>
                                                    @foreach ($schedule as $sche)
                                                        @php
                                                            $doc = App\Model\Doctor::where('id', $sche->doctor_id)->first();
                                                        @endphp
                                                        <option value="{{ $sche->id }}">
                                                            {{ $doc->name }}({{ $sche->start_time }}-{{ $sche->end_time }})

                                                            @if ($sche->day == '1')
                                                                Monday
                                                            @elseif($sche->day == '2')
                                                                Tuesday
                                                            @elseif($sche->day == '3')
                                                                Wednesday
                                                            @elseif($sche->day == '4')
                                                                Thursday
                                                            @elseif($sche->day == '5')
                                                                Friday
                                                            @elseif($sche->day == '6')
                                                                Saturday
                                                            @elseif($sche->day == '7')
                                                                Sunday
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('schedule_id')
                                                <span class="text-danger text-sm">Please select a schedule</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control form-control-sm"
                                                    placeholder="Enter Appointment Date" name="date">
                                                    @error('date')
                                                    <span class="text-danger text-sm">Please provide appointment date</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-1" style="padding-top:32px;">
                                            <div class="form-group">
                                                <input type="submit" value="Create Appointment" class="btn btn-sm bg-sec">
                                            </div>
                                        </div>

                                    </div>

                                </form>


                                <span class="float-right text-white">h</span>
                                <table id="example1" class="table table-responsive w-100 d-md-table d-block" width="100%">
                                    <thead class="bg-prim">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">App No</th>
                                            <th class="text-center">Patient Details</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Doctor</th>
                                            <th class="text-center">Schedule</th>
                                            <th class="text-center">Mode</th>
                                            <th class="text-center">Status</th>
                                            {{-- <th class="text-center">Action</th> --}}
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $app)
                                            @php
                                                $schedule = App\Model\Schedule::where('id', $app->schedule_id)->first();
                                                $doc = App\Model\Doctor::where('id', $schedule->doctor_id)->first();
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>{{ $app->app_no }}</td>
                                                <td>
                                                    Patient Name - {{ $app->patient_name }} <br>
                                                    Contact No - <span
                                                        class="font-weight-bold">{{ $app->patient_mobile }}</span>
                                                </td>
                                                <td class="text-center">{{ $app->date }}</td>
                                                <td class="text-center">{{ $doc->name }}</td>
                                                <td class="text-center">
                                                    ({{ $schedule->start_time }}-{{ $schedule->end_time }})

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
                                                <td>{{ $app->type }}</td>
                                                <td>
                                                    @if ($app->status == '0')
                                                        <span class="badge badge-danger">Incomplete</span>
                                                    @else
                                                        <span class="badge badge-success">Completed</span>
                                                    @endif
                                                </td>
                                                {{-- <td class="text-center">

                                                    <a href="{{ route('schedules.edit', $app->id) }}"
                                                        class="btn bg-sec btn-sm"> <i class="fas fa-edit"></i> Edit</a>

                                                    <a href="{{ route('schedules.delete', $app->id) }}"
                                                        class="btn btn-danger btn-sm" id="delete"> Delete</a>

                                                </td> --}}
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
