@extends('layouts.school')
@section('page_title','User Details')

@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
		
        <div class="card">
             <div class="card-header bg-info">
                <h5 class="card-title text-white">User Details</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Title</th>
					<th scope="col">Description</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>				
                  
                    <td>{{$job->title}}</td>
                    <td>{{$job->description}}</td>
                    
                
                </tr>

                </tbody>
            </table>
        </div>
        </div>		
		
{{--user address--}}
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="card-title text-white">User Address</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Position</th>
                    <th scope="col">Position Department</th>
                    <th scope="col">Responsibilty</th>
                    <th scope="col">Image</th>
                    <th scope="col">Video</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                      <td>{{$job->position}}</td>
                    <td>{{$job->position_department}}</td>
                    <td>{{$job->responsibilty}}</td>
                   
                  
				<td>  <img width="200" height="200" src="{{url('/uploads/profile/'.$job->image)}}" alt=""></td>
              <td>  <a href="url">{{url('/uploads/profile/'.$job->video)}}</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>


    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection