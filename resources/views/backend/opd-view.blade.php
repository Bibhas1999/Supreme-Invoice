@php

$count_invoice = App\Model\Invoice::where('status', '!=', '0')->count();
$count_doc = App\Model\Doctor::count();
$pending_invoice = App\Model\Invoice::where('status', '0')->get();
$count_customer = App\Model\Customer::all();
$all_dept = App\Model\Dept::all();
$count_user = App\User::all();
$invoice_today = App\Model\Invoice::whereDate('created_at', '=', Carbon\Carbon::today())
    ->orderBy('id', 'desc')
    ->get();
$all_reports = App\Model\InvoiceDetails::all();
$invoice_details = App\Model\InvoiceDetails::whereDate('created_at', '=', Carbon\Carbon::today())
    ->orderBy('invoice_id', 'desc')
    ->get();
$appointments = App\Model\Appointment::whereDate('created_at', '=', Carbon\Carbon::today())
    ->orderBy('id', 'desc')
    ->get();
$count_appointment = App\Model\Appointment::all()->count();
$schedule = App\Model\Schedule::all();
@endphp

@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper  mt-0 py-5 bg-prim">

        <!-- Main content -->
        <section class="content pt-2 ">
            <div class="container-fluid">
                    <h5 class="text-center font-weight-bold bg-sec py-2 rounded-lg">OPD VIEW
                        <a href="{{route('home')}}" class="text-center float-left text-md text-white mt-1 ml-2"> <i class="fas fa-arrow-left"></i> Back</a>

                    </h5>


                <div class="row">

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-md rounded-lg">
                            <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Doctors</span>
                                <a href="{{ route('doctors.view') }}" class="small-box-footer mt-2 text-sm">
                                    View <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-md rounded-lg">
                            <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Appointments</span>
                                <a href="{{ route('apps.view') }}" class="small-box-footer mt-2 text-sm">
                                    View <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-md rounded-lg">
                            <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Schedules</span>
                                <a href="{{ route('schedules.view') }}" class="small-box-footer mt-2 text-sm">
                                    View <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-md rounded-lg">
                            <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Invoices</span>
                                <a href="{{ route('opd-invoice-view') }}" class="small-box-footer mt-2 text-sm">
                                    View <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <h5 class="text-center font-weight-bold bg-sec py-2 rounded-lg">Doctor Schedule</h5>
                <div class="row">

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
                   @foreach ($schedule as $sche)
                    @php
                        $doc = App\Model\Doctor::where('id',$sche->doctor_id)->first();
                    @endphp 
                        <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-md rounded-lg">
                            
                            <div class="info-box-content">
                                <span class="info-box-text text-sec"><strong>{{$doc->name}}</strong></span>
                                <span class="info-box-text font-italic">({{$doc->degree}})</span>
                                <span class="info-box-text font-weight-bold">
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

                                @php
                                    $subs = substr($sche->start_time,0,2);
                                    $sube = substr($sche->end_time,0,2);
                                @endphp
                                    @if ($subs>12 && $sube>12)

                                    {{substr_replace($sche->start_time," pm",-3)}} - {{substr_replace($sche->end_time," pm",-3)}}
                                    
                                    @elseif($subs<12 && $sube<12)
                                    
                                    {{substr_replace($sche->start_time," am",-3)}} - {{substr_replace($sche->end_time," am",-3)}}
                                   
                                    @elseif($subs<12 && $sube>12)
                                    
                                    {{substr_replace($sche->start_time," am",-3)}} - {{substr_replace($sche->end_time," pm",-3)}}
                                   
                                    @else
                                    
                                    {{substr_replace($sche->start_time," am",-3)}} - {{substr_replace($sche->end_time," pm",-3)}}

                                    @endif
                                   </span>
                                <a href="{{ route('apps.bydoctor',['id'=>$sche->doctor_id,'sche_id'=>$sche->id]) }}" class="small-box-footer mt-2 text-sm">
                                    View Appointments <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                   @endforeach
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
