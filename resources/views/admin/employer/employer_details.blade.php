@extends('layouts.auth')
@section('page_title','Employer Details')
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid details-page">
    <br>
        <div class="btn-right text-right">
        <a class="btn btntheme" href="{{route('admin.editEmployer', $user->id)}}">Edit</a>  
                                              @if($user->status != 'deactivate')
											   <a class="btn btn-danger" href="{{route("admin.changeUserStatus", $user->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-times"></i></a>
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
					<th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>					
                  
                   
				
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
					 <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>					
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
		
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
<script> 
$(document).ready(function(){
});
</script>	
@endsection