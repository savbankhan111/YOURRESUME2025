@extends('layouts.auth')

@if(Request::url()==route("admin.editNonSchool",$user->id))
 @section('page_title',"Non School/College Edit")
 @section('page_name',"Non School/College Detail")
 @section('page_link',route("admin.nonSchoolDetails", $user->id))
@else	
 @section('page_title',"School/College Edit")
 @section('page_name',"School/College Detail")
 @section('page_link',route("admin.schoolDetails", $user->id))
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
                                 
<form method="POST" action="{{ route('admin.updateSchool', $user->id)}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf	
                                  <div class="row">
								  <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">School Code *</label>
                                      <input value="{{$user->school_code}}" type="text" name="school_code" class="form-control" required >
                                  </div>
                                   </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">School/College Name *</label>
                                      <input value="{{$user->school_name}}" type="text" name="school_name" class="form-control" required >
                                  </div>
                                      </div>
                                     

                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Phone *</label>
                                      <input value="{{$user->contact_no}}" type="text" name="contact_no" class="form-control" required >
                                  </div>
                                </div>
								
								 <div class="col-md-6">
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
                                      <input value="{{$user->address}}" name="address" type="text" class="form-control">
                                  </div>
                                          </div>

                              
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Country</label>
									  <select name="country" class="form-control">
									  @if(sizeof($country) > 0)
									   @foreach($country as $cu)
								        <option value="{{$cu->id}}" @if($user->country == $cu->id) selected @endif >{{$cu->name}}</option>
									   @endforeach
									  @endif	  
									 </select>
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">State *</label>
									  <select name="state" class="form-control">
									  @if(sizeof($state) > 0)
									   @foreach($state as $st)
								        <option required value="{{$st->id}}" @if($user->state == $st->id) selected @endif >{{$st->name}}</option>
									   @endforeach
									  @endif	  
									 </select> 
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">City</label>
                                      <input value="{{$user->city}}" type="text" name="city" class="form-control">
                                  </div>
                                </div>
			
			<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Zip Code</label>
                                      <input value="{{$user->zip_code}}" type="text" name="zip_code" class="form-control" >
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">More Information</label>
                                      <textarea name="more_info" class="form-control" >{!!$user->more_info!!}</textarea>
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