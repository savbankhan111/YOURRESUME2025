@extends('layouts.auth')

@if($user->roles[0]->id == 1)
    @section('page_title', 'Student Details')
    @section('page_name', "Student Detail")
    @section('page_link1', url("admin/dashboard"))
    @section('page_name1', "Dashboard")

    @if(optional($user->student->school)->school_type == 'direct')
        @section('page_link2', url("admin/users-list/student"))
        @section('page_name2', "List of Student")
    @else
        @section('page_link2', url("admin/users-list/non-student"))
        @section('page_name2', "List of Non-Student")
    @endif
@elseif($user->roles[0]->id == 3)
    @section('page_title', 'Professional Details')
    @section('page_name', "Professional Detail")
    @section('page_link1', url("admin/dashboard"))
    @section('page_name1', "Dashboard")
    @section('page_link2', url("admin/users-list/professional"))
    @section('page_name2', "List of Professional")
@endif

@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid details-page">
        <div class="userimges">
		 @if($user->image)
											<div class="imgwraps">  <img width="200" height="200" src="{{url('public/uploads/profile/'.$user->image)}}" alt="">	 </div>
											 @else
                                             <div class="imgwraps">  <img width="200" height="200" src="{{url('')}}" alt="">	</div> 
											 @endif	

                                             <div class="btnwraps">

											  <a class="btn btntheme" href="{{route("admin.userEdit", $user->id)}}">Edit</a>										    
										    @if($user->status != 'deactivate')
											   <a class="btn btn-danger" href="{{route("admin.changeUserStatuss", $user->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash-o"></i></a>
									         
                                               @endif	
                                               </div>										 
                                                </div>    
{{--        user details--}}

        <div class="card">
             <div class="card-header bg-blue">
                <h5 class="card-title">@if($user->roles[0]->id == 1) Student @else Professional @endif Details</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					@if($user->roles[0]->id == 1)
					 <th scope="col">Group Code</th>	
					@endif	
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
					@if($user->roles[0]->id == 3)
					 <th scope="col">Interested industry</th>
					@endif
                    <th scope="col">Status</th>
                    <th scope="col">Email Verified</th>
                </tr>
                </thead>
                <tbody>
                <tr>
				  @if($user->roles[0]->id == 1)		
                    <td>@if(isset($user->student->school->school_code)) {{$user->student->school->school_code}} @endif</td>
				  @endif		
                    <td>{{ucfirst($user->first_name)}} {{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
					<td>{{$user->userInfo->contact_no }}</td> 
					@if($user->roles[0]->id == 3)
					 <td>{{$user->professional->interested_industry}}</td>
                    @endif
					<td>@if($user->status=='active') Active @elseif($user->status=='deactivate')Deactivate @elseif($user->status=='pending') Pending @else Suspend @endif</td>
                    <td> @if($user->email_verified_at==NULL) No @elseif($user->email_verified_at!=Null) Yes @endif</td>
                </tr>

                </tbody>
            </table>
        </div>
        </div>		
		
{{--user address--}}
        <div class="card">
            <div class="card-header bg-blue">
                <h5 class="card-title">@if($user->roles[0]->id == 1) Student @else Professional @endif Address</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Address</th>
                    <th scope="col">Street Name</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
					<th scope="col">ZipCode</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                <tr>
				<td> {{$user->userAddress->address}}</td>
                <td> {{$user->userAddress->street_name}}</td>
                <td> {{$user->userAddress->city}}</td>
                <td>@if($user->userAddress->stateInfo) {{$user->userAddress->stateInfo->name}}@else {{$user->userAddress->province}}@endif</td>
				<td>{{ $user->userAddress->zipcode}}</td>
                <td>@if($user->userAddress->countryInfo) {{$user->userAddress->countryInfo->name}}@else {{$user->userAddress->country}}@endif</td>				
                </tr>
                </tbody>
            </table>
        </div>
        </div>
 
			<div class="card">
		@if($user->roles[0]->id == 1)

       
            <!-- student-->
             <div class="card-header bg-blue">
                <h5 class="card-title">Student Profile</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">Major</th>
                    <th scope="col">Indication</th>
                    <th scope="col">Graduation Completion Date</th>
                    <th scope="col">Other</th>
					<th scope="col">Minor</th>
                    <th scope="col">School/College Name</th>
					<th scope="col">ID Card</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$user->student->major}}</td>
                    <td>{{$user->student->indication}}</td>
                    <td>{{ date('M d,Y', strtotime($user->student->graduation_date))}}</td>
                    <td>{{$user->student->other}}</td>
					<td>{{$user->student->minor}}</td>
					@if($user->student->school)
                     <td>{{$user->student->school->school_name}}</td>
					@else
					 <td>{{$user->student->school_name}}</td>
					@endif	
					<td>
                    
					 @if($user->student->school_proff_id)
					  <img width="100" height="100" src="{{url('public/uploads/profile/'.$user->student->school_proff_id)}}" alt="">
					 @endif
					</td>
                </tr>
                
                </tbody>
            </table>
        </div>     
		@endif	
		</div>
		
		@if($user->roles[0]->id == 1 || $user->roles[0]->id == 3)
		<div class="card">
		<div class="card-header bg-blue">
                <h5 class="card-title ">Payment History</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Order ID</th>
                    <th scope="col">Payment Type</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Expire Date</th>					
					<th scope="col">Plan Option</th>
					<th scope="col">Total Interview</th>					
                    <th scope="col">Total Amount</th>
                </tr>
                </thead>
                <tbody>	
		      @forelse($user->userOrder as $uo)		  
                <tr>
					<td>#{{$uo->id}}</td>
                    <td>{{ucfirst($uo->payment_type)}}</td>
                    <td>{{date('d-m-Y', strtotime($uo->start_date))}}</td>
                    <td>{{date('d-m-Y', strtotime($uo->end_date))}}</td>
					<td>{!! $uo->plan_option =  '0' ? 'Plan' : 'Purchase Interview'!!}</td>
					<td>{{$uo->total_interview}}</td>
                    <td>{{$uo->total_amount}}</td>
                </tr>
			   @empty
                    <tr>
                        <td colspan="500"><h2 style="padding:20px ;text-align: center;">No record Found</h2></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            </div>
		</div>		
	   @endif

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection