@extends('layouts.all.crm')
@section('page_title','Interviews')
@section('content')

    <!-- Container fluid  -->
    <div class="container-fluid dashboard-page">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">
                             <div class="row">
            <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-lg-3">
                    <div class="card card-hover">
                        <div class="box   text-center">
                            <h1 class="font-light text-white">{{$totaljobs}}</h1>
                            <h6 class="text-white">Total Jobs</h6>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-3 col-lg-3">
                    <div class="card card-hover">
                        <div class="box  text-center">
                            <h1 class="font-light text-white">{{$activejobs}}</h1>
                            <h6 class="text-white">Active Jobs</h6>
                        </div>
                    </div>
                </div>   <!-- Column -->
                <div class="col-md-3 col-lg-3">
                    <div class="card card-hover">
                        <div class="box  text-center">
                            <h1 class="font-light text-white">{{$closejobs}}</h1>
                            <h6 class="text-white">Close Jobs</h6>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-3 col-lg-3">
                    <div class="card card-hover">
                        <div class="box  text-center">
                            <h1 class="font-light text-white">{{$pendingjobs}}</h1>
                            <h6 class="text-white">Pending All Jobs</h6>
                        </div>
                    </div>
                </div>
        </div>
		
    </div></div></div></div></div></div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection