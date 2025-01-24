@extends('layouts.auth')
@section('page_title',"Employer Edit")
@section('page_name',"Employer List")
@section('page_link',route("admin.employerListBy"))
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
                                 
<form method="POST" action="{{ route('admin.updateEmployer', $user->id)}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
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
                                      <label for="">Last Name *</label>
                                      <input type="text" value="{{$user->last_name}}" name="last_name" class="form-control" required >
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
                                      <label for="">Password</label>
                                      <input value="" type="password" name="password" class="form-control">
                                  </div>
                                </div>	
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Contact number *</label>
                                      <input value="{{$user->employerInfo->phone_number}}" type="text" name="phone_number" class="form-control" required >
                                  </div>
                                </div>
								
																	  
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Fax</label>
                                      <input value="{{$user->employerInfo->fax}}" type="text" name="fax" class="form-control" >
                                  </div>
                                </div>			  
								
								 <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select name="status" id="status" class="form-control">
                                            <option value="active" {{$user->status== 'active'? "selected":""}} >Activate</option>
                                            <option value="deactivate" {{$user->status== 'deactivate'? "selected":""}}>Deactivate</option>
                                            <option value="suspend" {{$user->status== 'suspend'? "selected":""}} >Suspend</option>                  
                                      </select>
                                  </div>
                                          </div>


<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Permanent Address *</label>
                                      <input value="{{$user->userAddress->address}}" name="address" type="text" class="form-control" required >
                                  </div>
                                </div>
								
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Country</label>
									 <select name="country" class="form-control">
									  @if(sizeof($country) > 0)
									   @foreach($country as $cu)
								        <option value="{{$cu->id}}" @if($user->userAddress->country == $cu->id) selected @endif >{{$cu->name}}</option>
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
								        <option value="{{$st->id}}" @if($user->userAddress->province == $st->id) selected @endif >{{$st->name}}</option>
									   @endforeach
									  @endif	  
									 </select> 
									
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">City *</label>
                                      <input value="{{$user->userAddress->city}}" type="text" name="city" class="form-control" required >
                                  </div>
                                </div>
                               
                                	<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Expire Date *</label>
                                      <input  type="date" name="expire_ac" class="form-control" value=<?php echo substr($user->employerInfo->expire_ac,0,10 ); ?> required >
                                  </div>
                                </div>
                
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