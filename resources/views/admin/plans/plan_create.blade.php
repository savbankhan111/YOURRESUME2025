@extends('layouts.auth')
@section('page_title',"Plan Add")
@section('page_name1',"Dashboard")
@section('page_link1',url("admin/dashboard"))
@section('page_name2',"Plan List")
@section('page_link2',url("admin/plans/all"))

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
                                 
<form method="POST" action="{{ route('admin.storePlan')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf	
                                  <div class="row">
								<div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">Name</label>
                                      <input value="" type="text" name="plan_name" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Plan Type</label>
									  <select name="plan_type" id="plan_type" class="form-control">
                                            <option value="student">Student</option>
                                            <option value="professional">Professional</option>  
											<option value="both">Both</option>    														
                                      </select>
                                  </div>
                                      </div>
                                  <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Interview Limit</label>
                                      <input name="interview_count" value="" type="number" class="form-control" min='1' required >
                                  </div>
                                  </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Day Limit</label>									  
									   <select name="day_limit" id="day_limit" class="form-control">
                                            <option value="1 Month">1 Month</option> 
											<option value="6 Month">6 Month</option> 											
											<option value="1 Year">1 Year</option>  
											<option value="till Graduation">Till Graduation</option>   											
                                      </select>
                                  </div>
                                </div>
								
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Cost($)</label>
                                      <input value="" type="text" name="price" class="form-control" required>
                                  </div>
                                </div>
								
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Plan Option</label>
									  <select name="plan_option" id="plan_option" class="form-control">									  
                                            <option value="0">Plan</option>		
                                            <option value="1">Purchase Interview</option>								
                                      </select>
                                  </div>
                                 </div>
															
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Plan Information</label>
                                      <textarea name="detail" class="form-control" ></textarea>
                                  </div>
                                </div>
								
								 <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select  name="status" id="status" class="form-control">
                                                												
                                                      <option value="1">Activate</option>
                                                        <option value="0">Deactivate</option>      
                                      </select>
                                  </div>
                                          </div>

                         <div class="col-md-12">
                             <div class="form-group">
							      <button class="themebtnmain">Create</button>
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