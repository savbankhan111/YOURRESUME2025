@extends('layouts.school')
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

<form method="POST" action="{{route('putSendNotif')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf
                                  <div class="row">
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
                                      <label for="">Type</label>
									  <select  name="type" id="type" class="form-control">
									  <option value="normal">Normal</option>
									  <option value="warning">Warning</option>
									  <option value="danger">Danger</option>
                                      </select>
                                  </div>
                                          </div>

                         <div class="col-md-12">
                             <div class="form-group">
							      <button class="btn btn-primary">Send</button>
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
