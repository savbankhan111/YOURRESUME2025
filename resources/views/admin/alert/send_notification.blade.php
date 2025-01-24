@extends('layouts.auth')
@section('page_title',"Send Notification")
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

<form method="POST" action="{{ route('admin.putSendNotif')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf
                                  <div class="row">
								  <div class="col-md-12">
                                          <div class="form-group">
                                      <label for="">Send To</label>
                                      <select name="send_to" class="form-control" required >
									   <option value="all">All</option>
									   <option value="student">College Students</option>
									   <option value="non-student">Non College Students</option>
									   <option value="professional">Professionals</option>
                                      </select>
                                  </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                      <label for="">Header</label>
                                      <input value="" type="text" name="header" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Description</label>
                                      <textarea name="description" class="form-control" required ></textarea>
                                  </div>
                                      </div>
                         <div class="col-md-12">
                             <div class="form-group">
							      <button class="themebtnmain">Send</button>
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
