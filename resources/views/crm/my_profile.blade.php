@extends('layouts.school')
@section('page_title',"My Profile")
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
                                 
<form method="POST" action="{{ route('updateProfile')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf	
                                  <div class="row">
								  <div class="col-md-12">
                                          <div class="form-group">
                                      <label for="">Group Code</label>
                                      <input value="{{$user->userGroup->groupCode->code}}" type="text" class="form-control" readonly >
                                  </div>
                                      </div>
									  
                                      <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">Company Name</label>
                                      <input value="{{$user->company->company_name}}" type="text" name="company_name" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Company Type</label>
                                      <input type="text" value="{{$user->company->company_type}}" name="company_type" class="form-control" required >
                                  </div>
                                      </div>
                                          <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Email</label>
                                      <input value="{{$user->email}}" name="email" type="text" class="form-control" required >
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
								
								{{-- <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select  name="status" id="status" class="form-control">
                                                												
                                                      <option value="active" {{$user->status== 'active'? "selected":""}} >Active</option>
                                                        <option value="deactivate" {{$user->status== 'deactivate'? "selected":""}}>Disabled</option>
                                                                                                          
                                                                                                      
                                      </select>
                                  </div>
								</div> --}}


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
								<div class="col-md-4">
                                  <div class="form-group">
                                      <label for="">Country</label>
									  <input value="{{$user->country}}" type="text" name="country" class="form-control">
									 
                                  </div>
                                </div>
								<div class="col-md-4">
                                  <div class="form-group">
                                      <label for="">State</label>
									  <input value="{{$user->state}}" type="text" name="state" class="form-control">
									
                                  </div>
                                </div>
								<div class="col-md-4">
                                  <div class="form-group">
                                      <label for="">City</label>
                                      <input value="{{$user->city}}" type="text" name="city" class="form-control">
                                  </div>
                                </div>
                         <div class="col-md-12">
                             <div class="form-group">
							      <button class="btn btn-primary">Update Profile</button>
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