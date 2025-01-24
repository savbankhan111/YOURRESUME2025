@extends('layouts.school')
@section('page_title','User Details')
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
		 @if($user->image)
											  <img width="200" height="200" src="{{url('public/uploads/profile/'.$user->image)}}" alt="">	 
											 @else
											  <img width="200" height="200" src="{{url('public/images/user-default.png')}}" alt="">	 
											 @endif	 
        
{{--        user details--}}
        <div class="card">
             <div class="card-header bg-info">
                <h5 class="card-title text-white">User Details</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Group Code</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name </th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Email Verified</th>
                </tr>
                </thead>
                <tbody>
                <tr>				
                    <td>@if(isset($user->userGroup->groupCode->code)) {{$user->userGroup->groupCode->code}} @endif</td>
                    <td>{{$user->firstname}}</td>
                    <td>{{$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->contactNo}}</td>
                    <td>@if($user->status=='active') Approved @elseif($user->status=='deactivate')Pending @else Rejected @endif</td>
                    <td> @if($user->email_verified_at==NULL) No @elseif($user->email_verified_at!=Null) Yes @endif</td>
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
					<th scope="col">Permanent Address</th>
                    <th scope="col">Street Name</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                <tr>
				<td> {{$user->permanentAddress}}</td>
                <td> {{$user->streetAddress1}} {{$user->streetAddress2}}</td>
                <td> {{$user->city}}</td>
                <td>@if($user->stateInfo) {{$user->stateInfo->name}}@else {{$user->state}}@endif</td>
                <td>@if($user->countryInfo) {{$user->countryInfo->name}}@else {{$user->country}}@endif</td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>

			<div class="card">
		@if($user->roles[0]->id == 1)
            <!-- student-->
             <div class="card-header bg-info">
                <h5 class="card-title text-white">Student Profile</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">Majaor</th>
                    <th scope="col">Indication</th>
                    <th scope="col">Graduation</th>
                    <th scope="col">Other</th>
                    <th scope="col">Card Verify</th>
                    <th scope="col">School Name</th>
					<th scope="col">School Type</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$user->student->majaor}}</td>
                    <td>{{$user->student->indication}}</td>
                    <td>{{$user->student->graduation}}</td>
                    <td>{{$user->student->other}}</td>
                    <td>{{ $user->student->verify== '0'? "unVerified":"Verified"}}</td>
                    <td>{{$user->student->school->school_name}}</td>
                    <td>{{$user->student->school->school_type}}</td>

                </tr>

                </tbody>
            </table>
        </div>
        @elseif ($user->roles[0]->id == 2)
            <!--professional-->
		 @if($user->professional->companyInfo)	
             <div class="card-header bg-info">
                <h5 class="card-title text-white">Professional Profile</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>

                    <th scope="col">Company Name</th>
                    <th scope="col">Company Type</th>
                    <th scope="col">Badge ID</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$user->professional->companyInfo->firstname}}</td>
                    <td>{{$user->professional->companyInfo->company_type}}</td>
                    <td>{{$user->professional->badge_id}}</td>
                </tr>

                </tbody>
            </table>
        </div>
		@endif
        @else
             <div class="card-header bg-info">
                <h5 class="card-title text-white">Family Profile</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">Nick Name</th>
                    <th scope="col">Family Name</th>
                    <th scope="col">Member Name</th>
                    <th scope="col">Member Phone</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$user->family->nickname}}</td>
                    <td>{{$user->family->family_name}}</td>
                    <td>{{$user->family->membername}}</td>
                    <td>{{$user->family->memberphone}}</td>
                </tr>

                </tbody>
            </table>
        </div>
      
		@endif	
		</div>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection