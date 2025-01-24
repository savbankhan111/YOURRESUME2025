@extends('layouts.all.crm')
@section('page_title',"Project Add")
@section('page_name',"Project List")
@section('page_link',route("employer.projectListBy"))
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

<form method="POST" action="{{ route('employer.storeProject')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf
                                  <div class="row">
								  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Project</label>
                                      <input value="" type="text" name="name" class="form-control" required >
                                    </div>
								  </div>

                                
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">About this project</label>
                                      <textarea name="description" class="form-control" rows="6" required ></textarea>
                                  </div>
                                </div>
								
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Project Status</label>
									  <select name="project_status" id="project_status" class="form-control">
										<option value="open">Open</option>
										<option value="pending">Pending</option>
                                        <option value="under_progress">Under Progress</option>
                                        <option value="close">Close</option>											
                                        <option value="complete">Complete</option>
                                      </select>
                                  </div>
                                  </div>
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select  name="status" id="status" class="form-control">									  
										<option value="publish">Publish</option>
                                        <option value="draft">Draft</option>
										<option value="trash">Trash</option>
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
	
@section('footerScript')
@endsection