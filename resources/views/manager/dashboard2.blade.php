
@extends('layouts.all.crm')
@section('page_title','Dashboard')
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
                <div class="col-md-4">
                    <div class="card card-hover">
                        <div class="box text-center">
                            <h1 class="font-light text-white">{{$slots}}</h1>
                            <h6 class="text-white">Total Interviews</h6>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-4">
                    <div class="card card-hover">
                        <div class="box text-center">
                            <h1 class="font-light text-white">{{$slots-$pendingslots}}</h1>
                            <h6 class="text-white">Complete Interviews</h6>
                        </div>
                    </div>
                </div> 
                <!-- Column -->
                <div class="col-md-4">
                    <div class="card card-hover">
                        <div class="box text-center">
                            <h1 class="font-light text-white">{{$pendingslots}}</h1>
                            <h6 class="text-white">Pending Interviews</h6>
                        </div>
                    </div>
                </div>   <!-- Column -->
                
        </div>
		 
    </div></div></div></div></div></div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection