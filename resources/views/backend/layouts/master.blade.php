<!DOCTYPE html>
<html>
@php
$route = Route::current()->getName();
@endphp


<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Supreme Health Care Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    {{-- data-table --}}
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/chartjs/Chart.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <style>
    .bg-sec{
     background-color: #6366F1;
     color: #ffff;
   } 
   .bg-sec:hover {
       color: white;
   }
   .bg-prim{
     background-color: #F1F5F9;
   } 
   
   .text-sec {
     color: #6366F1;
   }
   .sidebar-dark-primary {
    background-color: #1e293b;
   }
   /* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>
</head>

<body class=" layout-fixed sidebar-closed  layout-footer-fixed layout-navbar-fixed" data-panel-auto-height-mode="height" style="height: auto;">

    <img src="{{ asset('backend/images/load.gif') }}" alt="" srcset="" class="load"
        style="height: 100px;width:100px;z-index:999;position:fixed;left:47%;bottom:47%">

    <div class="wrapper " style="display: none">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light py-1 ">
            <!-- Left navbar links -->
            <ul class="navbar-nav ">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                        <a class="dropdown-item" href="{{ route('profiles.view') }}"> <i
                                class="fas fa-user-circle"></i> Profile</a>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @php
                    $users = App\User::all();
                @endphp
                <li class="nav-item dropdown">

                    <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v " style="color: grey"></i>
                    </button>
                    <div class="dropdown-menu rounded-lg shadow-lg " aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-header text-gray " aria-disabled="true">Switch Accounts</a>

                        @foreach ($users as $user)
                            @if (Auth::user() != $user)
                                <input type="hidden" value="{{ $user->id }}">
                                <a class="dropdown-item text-sm py-2" href="{{ route('switch-user', $user->id) }}">
                                    <img class="img-circle img-fluid " style="height:20px; width:20px;"
                                        src="{{ !empty($user->image) ? url('./upload/user_images/' . $user->image) : url('./upload/user_images/no-user.png') }}"
                                        name="image" alt="User profile picture">
                                    {{ $user->name }}</a>
                            @endif
                        @endforeach

                    </div>

                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('backend.layouts.sidebar')
        </aside>
        <!-- /.navbar -->
        @include('sweetalert::alert')


        @yield('content')
         
        <footer class="main-footer py-1">
            <strong>Copyright &copy; 2021</strong>
            All rights reserved By <strong><a class="text-sec" href="https://bibhasash.great-site.net/"
                    target="__blank">Bibhas Ash</a></strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/handlebars/handlebars.min.js') }}"></script>

{{-- <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },


                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },

                    new_password: {
                        required: true,
                    },
                    current_password: {
                        required: true,
                    },
                    confirm_password: {
                        required: true,
                        equalTo: '#newpassword',
                    },
                    password2: {
                        required: true,
                        equalTo: '#password',
                    },

                    password: {
                        required: true,
                        minlength: 6
                    },
                    name: {

                        required: true,
                    },
                    usertype: {

                        required: true,
                    },

                    age: {
                        required: true,
                        number: true,
                    },
                    type_id: {
                        required: true,
                    },
                    dept_id: {
                        required: true,
                    },

                    typename: {
                        required: true,
                    },
                    month: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    customer_id: {
                        required: true,
                    },
                    discount_amount: {

                        number: true,
                        max: 100,
                    },
                    payment_mode: {
                        required: true,
                    },
                    doc_fees: {
                        number: true,
                    },
                    co: {
                        required: true,
                    },
                    doctor: {
                        required: true,
                    },
                    mobile_no: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 13,
                    },

                    paid_amount: {
                        required: true,
                        number: true,
                        min: 1,

                    },

                    paid_status: {
                        required: true,
                    },
                    terms: {
                        required: true
                    },

                    report_study: {
                        required: true,
                    },

                    report_mod: {
                        required: true,
                    },

                    report_name: {
                        required: true,
                    },
                    report_tech: {
                        required: true,
                    },
                    report_imp: {
                        required: true,
                    },
                    report_date: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    password2: {
                        required: "Please confirm your password",
                        equalTo: "Password doesn't match"
                    },
                    mobile_no: {
                        required: "Please provide a mobile no.",
                        minlength: "Mobile no. must have minimum 10 characters.",
                        maxlength: "Mobile no. must have maximum 13 characters"
                    },

                    confirm_password: {
                        equalTo: "Password doesn't match"
                    },

                    usertype: {
                        required: "Please choose an usertype",

                    },

                    report_date: {
                        required: "Please provide date & time",

                    },
                    report_name: {
                        required: "Please provide a report name",

                    },
                    report_mod: {
                        required: "Please provide modality",

                    },
                    report_tech: {
                        required: "Please provide doctor details",

                    },
                    report_imp: {
                        required: "Please provide report impression",

                    },
                    report_study: {
                        required: "Please provide report details",

                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback text-danger');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20],
                    [5, 10, 20]
                ],
                dom: '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>'
            });

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        $(function() {

            $(document).on('click', '#delete', function(e) {

                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6366F1',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                        Swal.fire(
                            'Deleted!',
                            'Your Data has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>


    <script>
        $(document).on('change', '.search_value', function() {


            var search_value = $(this).val();

            if (search_value === 'monthly') {

                $('.show_daily').hide();
                $('.show_monthly').show();


            } else if (search_value === 'date_wise') {

                $('.show_monthly').hide();
                $('.show_daily').show();

            }


        });



        $("body").on("contextmenu", function(e) {
            return false;
        });
        $(document).keydown(function(e) {
            if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {
                return false;
            }
            if (e.which === 123) {
                return false;
            }
            if (e.metaKey) {
                return false;
            }
            //document.onkeydown = function(e) {
            // "I" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                return false;
            }
            // "J" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                return false;
            }
            // "S" key + macOS
            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                return false;
            }
            if (e.keyCode == 224 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                return false;
            }
            // "U" key
            if (e.ctrlKey && e.keyCode == 85) {
                return false;
            }
            // "F12" key
            if (event.keyCode == 123) {
                return false;
            }
        });
    </script>


    <script>
        $(window).on('load', function() {
            $('.load').fadeOut(500);
            $('.wrapper').fadeIn(400);

        })
    </script>


</body>

</html>
