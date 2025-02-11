@extends('layouts.auth')
@section('page_title','Plan Details')
@section('page_name1',"Dashboard")
@section('page_link1',url("admin/dashboard"))
@section('page_name2',"Plan List")
@section('page_link2',url("admin/plans/all"))
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid details-page">
    <br>
    <div class="btn-right text-right">
	<a class="btn btntheme" href="{{route("admin.editPlan", $user->id)}}">Edit</a>
                                            
                                              @if($user->status != '0')
											   <a class="btn btn-danger" href="{{route("admin.updateStatusPlan", $user->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash-o"></i></a>
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
                     <td style="max-width: 200px; overflow: hidden; white-space: pre-wrap; word-wrap: break-word;">
                        <div id="user-detail" style="white-space: pre-line;">
                            {{$user->detail}}
                        </div>
                    </td>
                    
                    
                   				
                  
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


    document.addEventListener("DOMContentLoaded", function() {
        let detailElement = document.getElementById('user-detail');
        let text = detailElement.innerHTML.trim();  // Remove any leading/trailing spaces
        let words = text.split(/\s+/);  // Split the text by any whitespace
        
        let formattedText = '';
        
        // Loop through words and add a <br> after every 20 words
        for (let i = 0; i < words.length; i++) {
            formattedText += words[i] + ' ';
            if ((i + 1) % 20 === 0) {
                formattedText += '<br>';
            }
        }
        
        // Remove trailing space and update the content with formatted text
        detailElement.innerHTML = formattedText.trim();
    });

</script>	
@endsection