<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
 

    
    
      <link rel="icon" type="image/png" href="{{ asset('images/fev.png')}}"/>
   
<link rel="icon" type="image/png" href="{{ asset('images/fev.png')}}"/>
    <!-- Custom CSS -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-slider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->

    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap-slider.min.js')}}"></script>
    <script src="{{ asset('js/jquery.simple-dtpicker.js')}}"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body>


<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->

@include("layouts.all.header")

<!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->

@include("layouts.all.asidebar")

<!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12   no-block align-items-center">
                    <h4 class="page-title">@yield('page_title') <a class="float-right pageurl" href="@yield('page_link')">@yield('page_name')</a></h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 no-block align-items-center">
                    <h4 class="page-title">
                        {{-- Page link 1 --}}
                      
                        @php
                        $role = Auth::user()->roles->first();
                    @endphp
                    
                    @if(Auth::check() && $role && $role->roles == 'employer')
                        <a class="pageurl" href="{{ route('employer.dashbords') }}">Dashboard</a>
                    @elseif(Auth::check() && $role && $role->roles == 'interviewer_manager')
                        <a class="pageurl" href="{{ url('interviewsdata') }}">Dashboard</a>
                    @endif
                    

                        {{-- Page link 2 --}}
                        @if(View::hasSection('page_link2')) /
                            <a class="pageurl" href="@yield('page_link2')">@yield('page_name2')</a>
                        @endif
                        
                        {{-- Page title --}}
                        @if(View::hasSection('page_title'))
                            / @yield('page_title')
                        @endif
                    </h4>
                </div>
            </div>
        </div>
        
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

    @yield('content')

        <!-- Content Header (Page header) -->

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->





@include("layouts.all.footer")

<!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>

<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('js/all.js')}}"></script>

@include('admin.ajax.reuseajax')
<script>

    $('#zero_config').DataTable();
    $(document).ready(function() {
        let url = "";
    });


</script>
 @yield('footerScript')
</body>
</html>
