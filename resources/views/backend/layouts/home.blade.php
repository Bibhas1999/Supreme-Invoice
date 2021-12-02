 @php
     
     $count_invoice = App\Model\Invoice::where('status', '!=', '0')->count();
     $pending_invoice = App\Model\Invoice::where('status', '0')->get();
     $count_customer = App\Model\Customer::all();
     $all_dept = App\Model\Dept::all();
     $count_user = App\User::all();
     $invoice = App\Model\Invoice::whereDate('created_at', '=', Carbon\Carbon::today())
         ->orderBy('id', 'desc')
         ->get();
     $all_reports = App\Model\InvoiceDetails::all();
     $invoice_details = App\Model\InvoiceDetails::whereDate('created_at', '=', Carbon\Carbon::today())
         ->orderBy('invoice_id', 'desc')
         ->get();
     
 @endphp

 @extends('backend.layouts.master')

 @section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper  mt-0 py-5 bg-prim">

         <!-- Main content -->
         <section class="content pt-2 ">
             <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box shadow-md rounded-lg">
                    <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text"> Invoices</span>
                      <span class="info-box-number">
                        {{$count_invoice}}
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3 shadow-md rounded-lg">
                    <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-paste"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Reports</span>
                      <span class="info-box-number">{{count($all_reports)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
      
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
      
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3 shadow-md rounded-lg">
                    <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-shopping-cart"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Sales</span>
                      <span class="info-box-number">{{$count_invoice}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3 shadow-md rounded-lg">
                    <span class="info-box-icon bg-sec elevation-1"><i class="fas fa-users"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Patients</span>
                      <span class="info-box-number">{{count($count_customer)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
              </div>
             </div><!-- /.container-fluid -->
         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->

 @endsection
