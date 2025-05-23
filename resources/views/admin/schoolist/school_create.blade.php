@extends('layouts.auth')
@section('page_title',"School/College Add")

@section('page_link1',url("admin/dashboard"))
@section('page_name1',"Dashboard")
@section('page_link2',url("admin/school-list?status=active"))
@section('page_name2',"List of School/College")
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
                                 
<form method="POST" action="{{ route('admin.storeSchool')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf	
                                  <div class="row">
								   <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">School Code *</label>
                                      <input value="" type="text" name="school_code" class="form-control" required >
                                  </div>
                                      </div>
									  
                                      <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">School/College Name *</label>
                                      <input value="" type="text" name="school_name" class="form-control" required >
                                  </div>
                                      </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Phone *</label>
                                      <input value="" type="number" name="contact_no" class="form-control" required >
                                  </div>
                                </div>
								
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select  name="status" id="status" class="form-control" >
                                                												
                                                      <option value="active" >Active</option>
                                                        <option value="deactivate">Deactivate</option>
                                                      <option value="pending">Pending</option>                                                    
                                                                                                      
                                      </select>
                                  </div>
                                          </div>


<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Address</label>
                                      <input value="" name="address" type="text" class="form-control" required>
                                  </div>
                                          </div>

								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Country</label>
									  <select name="country" class="form-control" required>
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
                                      <label for="">State *</label>
									  <select name="state" class="form-control" required>
									  @if(sizeof($state) > 0)
									   @foreach($state as $st)
								        <option value="{{$st->id}}" >{{$st->name}}</option>
									   @endforeach
									  @endif	  
									 </select> 
                                  </div>
                                </div>
								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">City</label>
                                      <input value="" type="text" name="city" class="form-control" required>
                                  </div>
                                </div>
								
								
								
			
			<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Zip Code</label>
                                      <input value="" type="text" name="zip_code" class="form-control" required>
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">More Information</label>
                                      <textarea name="more_info" class="form-control" required></textarea>
                                  </div>
                                </div>
								

                         <div class="col-md-12">
                             <div class="form-group">
							      <button class=" themebtnmain">Create</button>
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