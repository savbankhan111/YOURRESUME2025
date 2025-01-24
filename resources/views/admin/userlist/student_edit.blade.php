@extends('layouts.auth')
@section('page_title',"Student Edit")
@section('page_name',"Student Detail")
@section('page_link',route("admin.userDetails", $user->id))
@section('content')

     <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">

                          <div class="">

                              @include("admin.partials.error_forms")
                              @include("admin.partials.success_msg")
                                 
<form method="POST" action="{{ route('admin.updateUser', $user->id)}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf	
                                  <div class="row">				
                                      <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">First Name *</label>
                                      <input value="{{$user->first_name}}" type="text" name="first_name" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Last Name</label>
                                      <input type="text" value="{{$user->last_name}}" name="last_name" class="form-control" >
                                  </div>
                                      </div>
                                          <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Email *</label>
                                      <input readonly value="{{$user->email}}" type="text" class="form-control" required >
                                  </div>
                                          </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Phone *</label>
                                      <input value="{{$user->userInfo->contact_no}}" type="text" name="contact_no" class="form-control" required >
                                  </div>
                                </div>
								
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Password </label>
                                      <input value="" type="password" name="password" class="form-control">
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Image</label>
									  @if($user->image)
									   <img width="100" height="100" src="{{url('public/uploads/profile/'.$user->image)}}" alt="">
									 @endif
                                      <input value="" type="file" name="image" class="form-control">
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">ID Card</label>
									  @if($user->student->school_proff_id)
									   <img width="100" height="100" src="{{url('public/uploads/profile/'.$user->student->school_proff_id)}}" alt="">
									  @endif
                                       <input value="" type="file" name="school_proff_id" class="form-control">
                                  </div>
                                </div>
								
								 <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select  name="status" id="status" class="form-control">
                                        <option value="active" {{$user->status== 'active'? "selected":""}} >Active</option>
                                        <option value="deactivate" {{$user->status== 'deactivate'? "selected":""}}>Deactivate</option>
                                        <option value="pending" {{$user->status== 'pending'? "selected":""}}>Pending</option>
                                      </select>
                                  </div>
                                          </div>

<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Address</label>
                                      <input value="{{$user->userAddress->address}}" name="address" type="text" class="form-control">
                                  </div>
                                          </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Street Name</label>
                                      <input value="{{$user->userAddress->street_name}}" type="text" name="street_name" class="form-control">
                                  </div>
                                </div>
								
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">City</label>
                                      <input value="{{$user->userAddress->city}}" type="text" name="city" class="form-control">
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">State</label>
									   <input value="{{$user->userAddress->province}}" type="text" name="province" class="form-control">
									 
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">ZipCode</label>
									   <input value="{{$user->userAddress->zipcode}}" type="text" name="zipcode" class="form-control">
									 
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Country</label>
									   <input value="{{$user->userAddress->country}}" type="text" name="country" class="form-control">
									  
                                  </div>
                                </div>
								
			@if($user->roles[0]->id == 1)
				 <!-- student-->
				<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Major *</label>
                                      <input value="{{$user->student->major}}" type="text" name="major" class="form-control" required >
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Indication *</label>
                                      <input value="{{$user->student->indication}}" type="text" name="indication" class="form-control" required >
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Graduation Completion Date *</label>
                                      <input value="@if($user->student->graduation_date){{date('m/d/Y',strtotime($user->student->graduation_date)) }}@endif" type="text" id="graduation_date" name="graduation_date" class="form-control" required >
                                  </div>
                                </div>
																
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Minor</label>
                                      <input value="{{$user->student->minor}}" type="text" name="minor" class="form-control">
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Other</label>
                                      <input value="{{$user->student->other}}" type="text" name="other" class="form-control">
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Assign School/College</label>
<select name="school_id" id="school_id" class="form-control">
  @if(empty($user->student->school_id)) <option value="">--</option> @endif                                           				
@foreach($schools as $school)
    <option {{ $school->id == $user->student->school_id? "selected":""}} value="{{$school->id}}"> {{$school->school_name}}</option>
@endforeach															
                                                                                                 
                                      </select>
                                  </div>
                                </div>
			
			@endif		

                         <div class="col-md-12">
                             <div class="form-group">
							      <button class="btn btn-primary">Update</button>
                             </div>
                        </div>
                                  </div>
                      </form>


                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection	
@section('footerJS')		
<script> 
$(document).ready(function(){
	var dateToday = new Date();
	$("#graduation_date").datepicker('setStartDate', "+1d");

});	
</script>	
@endsection