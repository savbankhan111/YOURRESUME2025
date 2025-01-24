@extends('layouts.auth')
@section('page_title',"Plan Edit")
@section('page_name',"Plan List")
@section('page_link',route("admin.plans"))
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
                                 
<form method="POST" action="{{ route('admin.updatePlan', $plan->id)}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf	
                                  <div class="row">
								 	 <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">Name</label>
                                      <input value="{{$plan->plan_name}}" type="text" name="plan_name" class="form-control" required >
                                  </div>
                                      </div>
									     <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Plan Type</label>
									  <select name="plan_type" id="plan_type" class="form-control">
                                            <option value="student" {{$plan->plan_type== 'student'? "selected":""}} >Student</option>
                                            <option value="professional" {{$plan->plan_type== 'professional'? "selected":""}} >Professional</option>  
											<option value="both" {{$plan->plan_type== 'both'? "selected":""}} >Both</option>    														
                                      </select>
                                  </div>
                                      </div> 
									  
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Interview Limit</label>
                                      <input type="number" value="{{$plan->interview_count}}" name="interview_count" class="form-control" min='1' required >
                                  </div>
                                      </div>  
									  
                                  <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Day Limit</label>
									   <select name="day_limit" id="day_limit" class="form-control">
									   {{-- <option value="1 Week" {{$plan->day_limit== '1 Week'? "selected":""}} >1 Week</option> --}}
                                            <option value="1 Month" {{$plan->day_limit== '1 Month'? "selected":""}}>1 Month</option>   
											<option value="6 Month" {{$plan->day_limit== '6 Month'? "selected":""}}>6 Month</option>
											<option value="1 Year" {{$plan->day_limit== '1 Year'? "selected":""}}>1 Year</option>  
											<option value="till Graduation" {{$plan->day_limit== 'till Graduation'? "selected":""}}>Till Graduation</option>      											
                                      </select>
                                  </div>
                                  </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Cost($)</label>
                                      <input value="{{$plan->price}}" type="text" name="price" class="form-control" required >
                                  </div>
                                </div>
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Plan Option</label>
									  <select name="plan_option" id="plan_option" class="form-control">									  
                                            <option value="0" {{$plan->plan_option== '0'? "selected":""}}>Plan</option>		
                                            <option value="1" {{$plan->plan_option== '1'? "selected":""}}>Purchase Interview</option>								
                                      </select>
                                  </div>
                                 </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Plan Information</label>
                                       <textarea name="detail" class="form-control" >{{$plan->detail}}</textarea>
                                  </div>
                                </div>  
								
								 <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select name="status" id="status" class="form-control">
                                            <option value="1" {{$plan->status== '1'? "selected":""}} >Activate</option>
                                            <option value="0" {{$plan->status== '0'? "selected":""}}>Deactivate</option>                 
                                      </select>
                                  </div>
                                 </div>
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
@endsection