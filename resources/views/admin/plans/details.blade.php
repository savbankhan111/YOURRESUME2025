@extends('layouts.auth')
@section('page_title','Plan Details')
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid details-page">
    <br>
    <div class="btn-right text-right">
	<a class="btn btntheme" href="{{route("admin.editPlan", $user->id)}}">Edit</a>
                                            
                                              @if($user->status != '0')
											   <a class="btn btn-danger" href="{{route("admin.updateStatusPlan", $user->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-times"></i></a>
										   @endif
        
{{--        user details--}}</div>
<br>
        <div class="card">
             <div class="card-header bg-blue">
                <h5 class="card-title">Details</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Plan Name</th>
                    <th scope="col">More Detail</th>
                   
                </tr>
                </thead>
                <tbody>
                <tr>
					 <td>{{$user->plan_name}}</td>
                    <td>{{$user->detail}}</td>
                   				
                  
                </tr>

                </tbody>
            </table>
        </div>
        </div>		
		
{{--address--}}
        <div class="card">
            <div class="card-header bg-blue">
                <h5 class="card-title">More</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
                      <th scope="col">Plan Option</th>
					<th scope="col">Plan Type</th>
                    <th scope="col">Interview Count</th>
                    <th scope="col">Day Limit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                     <td>@if($user->plan_option=='1') InterView @else Plans @endif</td>
				<td> {{$user->plan_type}}</td>
                <td> {{$user->interview_count}}</td>
                <td>{{$user->day_limit}}</td>
                <td>{{$user->price}}</td> 
                <td>@if($user->status=='1') Activate @else Deactivate  Pending @endif</td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>
		
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
<script> 
$(document).ready(function(){
});
</script>	
@endsection