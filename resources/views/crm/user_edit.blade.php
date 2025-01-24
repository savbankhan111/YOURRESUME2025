@extends('layouts.school')
@section('page_title',"User Edit")
@section('page_name',"User Detail")
@section('page_link',route("userDetails", $user->id))
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

<form method="POST" action="{{ route('userUpdate', $user->id)}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">First Name</label>
                                      <input value="{{$user->firstname}}" type="text" name="firstname" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Last Name</label>
                                      <input type="text" value="{{$user->lastname}}" name="lastname" class="form-control" >
                                  </div>
                                      </div>
                                          <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Email</label>
                                      <input readonly value="{{$user->email}}" type="text" class="form-control" required >
                                  </div>
                                          </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Phone</label>
                                      <input value="{{$user->contactNo}}" type="text" name="contactNo" class="form-control" required >
                                  </div>
                                </div>

								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Password</label>
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
                                      <label for="">Status</label>
									  <select  name="status" id="status" class="form-control">

                                                      <option value="active" {{$user->status== 'active'? "selected":""}} >Active</option>
                                                        <option value="deactivate" {{$user->status== 'deactivate'? "selected":""}}>Disabled</option>


                                      </select>
                                  </div>
                                          </div>

										  {{-- <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Email Verified</label>
                                      <select  name="email_verified" id="email_verified" class="form-control">

                                                      <option value="no" {{$user->email_verified_at==NULL? "selected":""}} >No</option>
                                                        <option value="yes" {{$user->email_verified_at!=Null? "selected":""}}>Yes</option>


                                      </select>
                                  </div>
                                </div>--}}

<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Permanent Address</label>
                                      <input value="{{$user->permanentAddress}}" name="permanentAddress" type="text" class="form-control">
                                  </div>
                                          </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Street Address 1</label>
                                      <input value="{{$user->streetAddress1}}" type="text" name="streetAddress1" class="form-control">
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Street Address 2</label>
                                      <input value="{{$user->streetAddress2}}" type="text" name="streetAddress2" class="form-control">
                                  </div>
                                </div>
<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Country</label>		
 <input value="{{$user->country}}" type="text" name="country" class="form-control">									  
																		  
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">State</label>
									   <input value="{{$user->state}}" type="text" name="state" class="form-control">
									
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">City</label>
                                      <input value="{{$user->city}}" type="text" name="city" class="form-control">
                                  </div>
                                </div>
								
								

			@if($user->roles[0]->id == 1)
				 <!-- student-->
				<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Majaor</label>
                                      <input value="{{$user->student->majaor}}" type="text" name="majaor" class="form-control" required >
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Indication</label>
                                      <input value="{{$user->student->indication}}" type="text" name="indication" class="form-control" required >
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Graduation</label>
                                      <input value="{{$user->student->graduation}}" type="text" name="graduation" class="form-control" required >
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
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Other</label>
                                      <input value="{{$user->student->other}}" type="text" name="other" class="form-control">
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">School Name</label>
<select  name="school_id" id="school_id" class="form-control">

@foreach($schools as $school)
    <option {{ $school->school->id == $user->student->school_id? "selected":""}} value="{{$school->school->id}}"> {{$school->school->school_name}}</option>
@endforeach

                                      </select>
                                  </div>
                                </div>
			@elseif ($user->roles[0]->id == 2)
			 <!--professional-->
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Badge ID</label>
                                      <input value="{{$user->professional->badge_id}}" type="text" name="badge_id" class="form-control" required>
                                  </div>
                                </div>
			@elseif ($user->roles[0]->id == 3)
			<!--Family-->
			<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Nick Name</label>
                                      <input value="{{$user->family->nickname}}" type="text" name="nickname" class="form-control" required>
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Family Name</label>
                                      <input value="{{$user->family->family_name}}" type="text" name="family_name" class="form-control" required>
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Member Name</label>
                                      <input value="{{$user->family->membername}}" type="text" name="membername" class="form-control" required>
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Member Phone</label>
                                      <input value="{{$user->family->memberphone}}" type="text" name="memberphone" class="form-control">
                                  </div>
                                </div>
			@else
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
