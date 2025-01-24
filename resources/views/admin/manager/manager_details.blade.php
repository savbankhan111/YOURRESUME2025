@extends('layouts.auth')
@section('page_title','Manager Details')
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid details-page ">
        
{{--        user details--}}
        <div class="card">
             <div class="card-header bg-blue">
                <h5 class="card-title ">Details</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>					
                    <th scope="col">Email Verified</th>
                    <th scope="col">Contact number</th>
					<th scope="col">Industry type</th>
					<th scope="col">Profession</th>
					<th scope="col">Expertise</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
					 <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>					
                    <td> @if($user->email_verified_at==NULL) No @elseif($user->email_verified_at!=Null) Yes @endif</td>
                    <td>{{$user->userInfo->contact_no}}</td>
					<td>{{$user->indData->name}}</td>
					<td>{{$user->managerdata->profession}}</td>
					<td>{{$user->managerdata->expertise}}</td>
                    <td>@if($user->status=='active') Approved @elseif($user->status=='deactivate')Deactivate @else Pending @endif</td>
                </tr>

                </tbody>
            </table>
        </div>
        </div>		
		
{{--address--}}
        <div class="card">
            <div class="card-header bg-blue">
                <h5 class="card-title">Address</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">Permanent Address</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                <tr>
				<td> {{$user->userAddress->address}}</td>
                <td> {{$user->userAddress->city}}</td>
                <td>@if($user->userAddress->stateInfo) {{$user->userAddress->stateInfo->name}}@else {{$user->userAddress->province}}@endif</td>
                <td>@if($user->userAddress->countryInfo) {{$user->userAddress->countryInfo->name}}@else {{$user->userAddress->country}}@endif</td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>
		@if($user->userInfo->about_me)
		<div class="card">
            <div class="card-header bg-blue">
                <h5 class="card-title">About</h5>
            </div>
            <div class="table-responsive">
			 {!!$user->userInfo->about_me!!}
            </div>
        </div>
		@endif	
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
<script> 
$(document).ready(function(){
});
</script>	
@endsection