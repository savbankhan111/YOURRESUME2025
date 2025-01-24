@extends('layouts.all.crm')
@section('page_title','Interview Details')
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid    job-details-page">
        <div class="card">
             <div class="card-header bg-blue">
                <h5 class="card-title text-white">Interview Details</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">User Name</th>
                    <th scope="col">User Email</th>
					<th scope="col">Show Profile</th>
                    <th scope="col">Interview Type</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>		
                    <td>{{ucfirst($interviewerUser->userInfo->first_name)}} {{$interviewerUser->userInfo->last_name}}</td>
                    <td>{{$interviewerUser->userInfo->email}}</td>
					<td>@if($interviewerUser->show_profile == 0) No @else Yes @endif</td> 	
					<td>@if($interviewerUser->interview_type=="profesional")
						Professional 
						@else
						{{ucfirst($interviewerUser->interview_type)}}
						@endif
						</td> 					
					<td>{{ucfirst($interviewerUser->status)}}</td>
                </tr>

                </tbody>
            </table>
        </div>
        </div>		

        <div class="card">
            <div class="card-header bg-blue">
                <h5 class="card-title text-white">Other Info.</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Payment</th>
                    <th scope="col">Video Link</th>
                    <th scope="col">Feedback</th>
                    <th scope="col">Date</th>
					<th scope="col">Day</th>
                    <th scope="col">Start Time</th>
					<th scope="col">End Time</th>
                </tr>
                </thead>
                <tbody>
                <tr>
				<td> @if($interviewerUser->payment=="plain")
					Plan
				@else
				{{ucfirst($interviewerUser->payment)}}
				@endif
			</td>
                <td> @if(!empty($interviewerUser->video)) <a href="{{$interviewerUser->video}}" target="_blank">View</a>@else n/a @endif</td>
                <td> {{ucfirst($interviewerUser->admin_feedback)}}</td>
                <td>{{$interviewerUser->date}}</td>
				<td>{{ucfirst($interviewerUser->day)}}</td>
                <td>{{$interviewerUser->start_time}}</td>
				<td>{{$interviewerUser->end_time}}</td>				
                </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection