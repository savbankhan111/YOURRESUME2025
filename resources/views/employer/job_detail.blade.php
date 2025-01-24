@extends('layouts.all.crm')
@section('page_title','Job Detail')
@section('page_name',"Job List")
@section('page_link',route("employer.jobListBy"))
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
   
    <div class="container-fluid  job-details-page">
  
    <div class="text-right">
	 <a class="themebtnmain" href="{{route("employer.editJob", $job->id)}}">Edit</i></a></div>
     <br>
        <div class="card">
            
             <div class="card-header bg-blue">
                <h5 class="card-title text-white">Job Information </h5>
            </div>
             
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Title</th>
					<th class="whitesapce" scope="col">Description</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>				
                  
                    <td>{{$job->title}}</td>
                    <td class="whitesapce">{{$job->description}}</td>
                    
                
                </tr>

                </tbody>
            </table>
        </div>
        </div>		
		
{{--user address--}}
        <div class="card">
            
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Position</th>
                    <th scope="col">Position Department</th>
                    <th class="whitesapce" scope="col">Responsibilty</th>
                    <th scope="col">Image</th>
                    <th scope="col">Video</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                      <td>{{$job->position}}</td>
                    <td>{{$job->position_department}}</td>
                    <td class="whitesapce">{{$job->responsibilty}}</td>
                   
                  
				<td>  @if($job->image)
									   <img width="100" height="100" src="{{url('public/uploads/jobs/'.$job->image)}}" alt="">
									 @endif</td>
              <td> @if($job->job_video)
								   <video width="320" height="240" controls>
									  <source src="{{url('public/uploads/jobs/videos/'.$job->job_video)}}">
									  Your browser does not support the video tag.
									</video>
									 @endif</td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>


    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection