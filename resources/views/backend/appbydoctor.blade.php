@php
$apps = App\Model\Appointment::where('schedule_id', $schedule->id)->orderBy('created_at','asc')->orderBy('id','desc')->get();
@endphp
@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper  mt-0 py-5 bg-prim">

        <!-- Main content -->
        <section class="content pt-2 ">
            <div class="container-fluid">

                <h5 class="text-center font-weight-bold bg-sec py-2 rounded-lg">
                    {{ $doctor->name }}
                    (
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
                    @php
                        $subs = substr($schedule->start_time, 0, 2);
                        $sube = substr($schedule->end_time, 0, 2);
                    @endphp
                    @if ($subs > 12 && $sube > 12)

                        {{ substr_replace($schedule->start_time, ' pm', -3) }} -
                        {{ substr_replace($schedule->end_time, ' pm', -3) }}

                    @elseif($subs<12 && $sube<12) {{ substr_replace($schedule->start_time, ' am', -3) }} -
                        {{ substr_replace($schedule->end_time, ' am', -3) }} @elseif($subs<12 && $sube>12)

                            {{ substr_replace($schedule->start_time, ' am', -3) }} -
                            {{ substr_replace($schedule->end_time, ' pm', -3) }}

                        @else

                            {{ substr_replace($schedule->start_time, ' am', -3) }} -
                            {{ substr_replace($schedule->end_time, ' pm', -3) }}

                    @endif
                    )
                    <a href="{{ route('opd.view') }}" class="float-left text-white text-sm px-2 py-1"> <i
                            class="fas fa-arrow-left"></i> Back </a>
                </h5>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card px-2 py-2">
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
                                        <th class="text-center"> Date/Time</th>
                                        <th class="text-center">Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($apps as $key => $app)
                                        @php
                                            $schedule = App\Model\Schedule::where('id', $app->schedule_id)->first();
                                            $doc = App\Model\Doctor::where('id', $schedule->doctor_id)->first();
                                            if($app != null){
                                                $invoice = App\Model\Opdinvoice::where('app_id',$app->id)->first();
                                                if($invoice != null){
                                                    $payment = App\Model\Opdpayment::where('invoice_id',$invoice->id)->first();
                                                }else {
                                                    $payment = null; 
                                                }
                                            }
                                            
                                            
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $app->app_no }}</td>
                                            <td>
                                                Patient Name - {{ $app->patient_name }} <br>
                                                Contact No - <span class="font-weight-bold">{{ $app->patient_mobile }}</span>
                                            </td>
                                            <td class="text-center">{{ $app->date }}</td>
                                            <td class="text-center">{{ $doc->name }}</td>
                                            <td class="text-center">({{ $schedule->start_time }}-{{ $schedule->end_time }})
        
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
                                            <td>{{ $app->created_at }}</td>
                                            
                                            {{-- <td class="text-center">
        
                                                <a href="{{ route('schedules.edit', $app->id) }}"
                                                    class="btn bg-sec btn-sm"> <i class="fas fa-edit"></i> Edit</a>
        
                                                <a href="{{ route('schedules.delete', $app->id) }}"
                                                    class="btn btn-danger btn-sm" id="delete"> Delete</a>
        
                                            </td> --}}
                                            @if ($payment != null)
                                            <td>
                                                <a target="__blank" href="{{ route('opd-invoice-pdf', $app->id) }}"
                                                    class="btn bg-sec btn-sm"> <i class="fas fa-print"></i> Print</a>
                                            </td> 
                                            @else
                                            <td>
                                                <a href="{{ route('opd-invoice-add', $app->id) }}"
                                                    class="btn bg-sec btn-sm"> <i class="fas fa-plus-square"></i> Invoice</a>
                                            </td>
                                            @endif
                                        </tr>
        
                                    @endforeach
        
                                </tbody>
        
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
