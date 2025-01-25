@extends('layouts.auth')
@section('page_title',"Employer Add")
@section('page_name1',"Dashboard")
@section('page_link1',url("admin/dashboard"))
@section('page_name2',"Employer List")
@section('page_link2',url("admin/employer-list"))
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
                                 
<form method="POST" action="{{ route('admin.storeEmployer')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf	
                                  <div class="row">
								<div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">First Name *</label>
                                      <input value="" type="text" name="first_name" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Last Name *</label>
                                      <input type="text" value="" name="last_name" class="form-control" required >
                                  </div>
                                      </div> 	  
									  
                                 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Email *</label>
                                      <input name="email" value="" type="email" class="form-control" required >
                                  </div>
                                 </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Password *</label>
                                      <input value="" type="password" name="password" class="form-control" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Contact number *</label>
                                      <input value="" type="number" name="phone_number" class="form-control" required >
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Fax</label>
                                      <input value="" type="text" name="fax" class="form-control" >
                                  </div>
                                </div>								
								
								 <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select  name="status" id="status" class="form-control">
                                                												
                                                      <option value="active">Activate</option>
                                                        <option value="deactivate">Deactivate</option>
<option value="suspend">Suspend</option>														
                                                                                                      
                                      </select>
                                  </div>
                                          </div>


<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Permanent Address *</label>
                                      <input value="" name="address" type="text" class="form-control" required >
                                  </div>
                                          </div>

                              
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Country</label>
									 <select name="country" class="form-control">
									  @if(sizeof($country) > 0)
									   @foreach($country as $cu)
								        <option value="{{$cu->id}}" >{{$cu->name}}</option>
									   @endforeach
									  @endif	  
									 </select>
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">State</label>
									  <select name="state" class="form-control">
									  @if(sizeof($state) > 0)
									   @foreach($state as $st)
								        <option value="{{$st->id}}" >{{$st->name}}</option>
									   @endforeach
									  @endif	  
									 </select> 
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">City *</label>
                                      <input value="" type="text" name="city" class="form-control" required >
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Expire Date *</label>
                                      <input value=<?php echo date('Y-m-d');?> type="date" name="expire_ac" class="form-control" required >
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