@extends('layouts.auth')



@if($user->roles[0]->id == 1)
    @section('page_title', "Student Edit")
    @section('page_name', "Student Detail")
    @section('page_link1', url("admin/dashboard"))
    @section('page_name1', "Dashboard")
    @section('page_link2', url("admin/users-list/student"))
    @section('page_name2', "List of Student")
@elseif($user->roles[0]->id == 3)
    @section('page_title', "Professional Edit")
    @section('page_name', "Professional Detail")
    @section('page_link1', url("admin/dashboard"))
    @section('page_name1', "Dashboard")
    @section('page_link2', url("admin/users-list/professional"))
    @section('page_name2', "List of Professional")
    @else
    @section('page_title', "User Edit")
@section('page_name', "User Detail")
@section('page_link', route("admin.userDetails", $user->id))
@endif

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
				@if($user->roles[0]->id == 1)
                    <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Degree Type</label>
									  <select name="degree_type" id="degree_type" class="form-control">
									  @if(empty($user->student->school_id) || (!empty($user->student->school_id) && $user->student->school->school_option == 'non'))
										<option value="High school" {{$user->student->degree_type== 'High school'? "selected":""}} >High school</option>
                                        <option value="Middle school" {{$user->student->degree_type== 'Middle school'? "selected":""}}>Middle school</option>
                                        
									@else	
                                        <option value="Bachelor degree" {{$user->student->degree_type== 'Bachelor degree'? "selected":""}} >Bachelor degree</option>
                                        <option value="Masters" {{$user->student->degree_type== 'Masters'? "selected":""}}>Masters</option>
                                        <option value="PhD" {{$user->student->degree_type== 'PhD'? "selected":""}}>PhD</option>
										<option value="Associate" {{$user->student->degree_type== 'Associate'? "selected":""}} >Associate</option>
                                        <option value="JD" {{$user->student->degree_type== 'JD'? "selected":""}}>JD</option>
                                        <option value="MD." {{$user->student->degree_type== 'MD.'? "selected":""}}>MD.</option>
									@endif	
                                      </select>
                                  </div>
                    </div>
				@endif		
                                      <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">First Name *</label>
                                      <input value="{{$user->first_name}}" type="text" name="first_name" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Last Name *</label>
                                      <input type="text" value="{{$user->last_name}}" name="last_name" class="form-control" required>
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
                                      <input value="{{$user->userInfo->contact_no}}" type="number" name="contact_no" class="form-control" required >
                                  </div>
                                </div>
								
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Password </label>
                                      <input value="" type="password" name="password" class="form-control" >
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
								@if($user->roles[0]->id == 3)
								 <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Interested Industry</label>
                                      <input value="{{$user->professional->interested_industry}}" type="text" name="interested_industry" class="form-control">
                                  </div>
                                 </div>
								@endif
								
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
                                <div class="col-md-12">
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
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Country</label>
									  <input value="{{$user->userAddress->country}}" type="text" name="country" class="form-control">
									  
                                  </div>
                                </div>
								
			@if($user->roles[0]->id == 1)
				 <!-- student-->
				<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Majaor *</label>
                                      <input value="{{$user->student->majaor}}" type="text" name="majaor" class="form-control" required >
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Indication  *</label>
                                      <input value="{{$user->student->indication}}" type="text" name="indication" class="form-control" required >
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Graduation Completion Date *</label>
                                      <input value="@if($user->student->graduation){{date('m/d/Y',strtotime($user->student->graduation)) }}@endif" type="text" id="graduation_date" name="graduation" class="form-control" required >
                                  </div>
                                </div>
								
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Card Verify</label>
                                     <select  name="card_verify" id="card_verify" class="form-control">
                                                												
                                                      <option value="0" {{$user->student->verify== '0'? "selected":""}} >unVerified</option>
                                                        <option value="1" {{$user->student->verify!= '0'? "selected":""}}>Verified</option>
                                                                                                          
                                                                                                      
                                      </select>
                                  </div>
                                </div>
								
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Minor</label>
                                      <input value="{{$user->student->minor}}" type="text" name="minor" class="form-control">
                                  </div>
                                </div>
								<div class="col-md-6">
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
    <option {{ $school->school->id == $user->student->school_id? "selected":""}} value="{{$school->school->id}}"> {{$school->school->school_name}}</option>
@endforeach															
                                                                                                 
                                      </select>
                                  </div>
                                </div>
			@endif		

                         <div class="col-md-12">
                             <div class="form-group">
							      <button class="themebtnmain">Update</button>
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
<script> 
$(document).ready(function(){
	var dateToday = new Date();
	$("#graduation_date").datepicker('setStartDate', "+1d");
	/*$("#graduation_date").datepicker({
		//defaultDate: "+1w",
		setStartDate: dateToday, 
        //todayBtn:  1,
        //autoclose: true,
    });*/
});	
</script>	
@endsection