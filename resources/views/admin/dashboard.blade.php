@extends('layouts.auth')
@section('page_title','Dashboard')
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid dashboard-page">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row" style="margin-top: 20px;">
            <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-lg-3">
                    <div class="card card-hover">
                        <div class="box text-center">
                            <h1 class="font-light text-white">{{$stuTotals->users_count}}</h1>
                            <h6 class="text-white">Total Students</h6>
                        </div>
                    
                <div class="card-body">
                    <h5 class="card-title m-b-0">Students</h5>
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td scope="col">Total Active</td>
                        <td scope="col"><span class="badge badge-success"> {{$stuTotals->user_active_total_count}}</span></td>
                    </tr>
                    <tr>
                        <td>Total Deactivate </td>
                        <td><span class="badge badge-warning">{{$stuTotals->user_disabled_total_count}} </span></td>
                    </tr>
					<tr>
                        <td scope="col">Total Pending</td>
                        <td scope="col"><span class="badge badge-success"> {{$stuTotals->user_pending_total_count}}</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
                </div>
                <!-- Column -->
                <div class="col-md-3 col-lg-3">
                    <div class="card card-hover">
                        <div class="box text-center">
                            <h1 class="font-light text-white">{{$empTotals->users_count}}</h1>
                            <h6 class="text-white">Total Employees</h6>
                        </div>
                 
                <div class="card-body">
                    <h5 class="card-title m-b-0">Employees</h5>
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td scope="col">Total Active</td>
                        <td scope="col"><span class="badge badge-success"> {{$empTotals->user_active_total_count}}</span></td>
                    </tr>
                    <tr>
                        <td>Total Deactivate </td>
                        <td><span class="badge badge-warning">{{$empTotals->user_disabled_total_count}} </span></td>
                    </tr>
					<tr>
                        <td scope="col">Total Pending</td>
                        <td scope="col"><span class="badge badge-success"> {{$empTotals->user_pending_total_count}}</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
                </div>   <!-- Column -->
                <div class="col-md-3 col-lg-3">
                    <div class="card card-hover">
                        <div class="box text-center">
                            <h1 class="font-light text-white">{{$profTotals->users_count}}</h1>
                            <h6 class="text-white">Total Professionals</h6>
                        </div>
                     
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Professionals</h5>
                    </div>
                    <table class="table">

                        <tbody>
                        <tr>
                            <td>Total Active </td>
                            <td><span class="badge badge-success">{{$profTotals->user_active_total_count}} </span></td>
                        </tr>
                        <tr>
                            <td>Total Deactivate</td>
                            <td><span class="badge badge-warning">{{$profTotals->user_disabled_total_count}}</span></td>
                        </tr>
						<tr>
                        <td scope="col">Total Pending</td>
                        <td scope="col"><span class="badge badge-success"> {{$profTotals->user_pending_total_count}}</span></td>
                    </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <!-- Column -->
				<div class="col-md-3 col-lg-3">
                    <div class="card card-hover">
                        <div class="box text-center">
                            <h1 class="font-light text-white">{{$mangTotals->users_count}}</h1>
                            <h6 class="text-white">Total Recruitment Managers</h6>
                        </div>
                    
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Managers</h5>
                    </div>
                    <table class="table">

                        <tbody>
                        <tr>
                            <td>Total Active </td>
                            <td><span class="badge badge-success">{{$mangTotals->user_active_total_count}} </span></td>
                        </tr>
                        <tr>
                            <td>Total Deactivate</td>
                            <td><span class="badge badge-warning">{{$mangTotals->user_disabled_total_count}}</span></td>
                        </tr>
						<tr>
                        <td scope="col">Total Suspend</td>
                        <td scope="col"><span class="badge badge-success"> {{$mangTotals->user_suspend_total_count}}</span></td>
                    </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <!-- Column -->
        </div>
		 
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection