@extends('layouts.all.crm')
@section('page_title',"Project Edit")
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

<form method="POST" action="{{ route('employer.projectUpdate',$project->id)}}" class="form-horizontal m-t-20" enctype="multipart/form-data">			
						<input name="_method" type="hidden" value="PUT">
                        @csrf
                                  <div class="row">
								  <div class="col-md-12">
                                          <div class="form-group">
                                      <label for="">Project</label>
                                      <input value="{{$project->name}}" type="text" name="name" class="form-control" required >
                                  </div>
								</div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">About this project</label>
                                      <textarea name="description" class="form-control" rows="6" required >{{$project->description}}</textarea>
                                  </div>
                                </div>
								
								
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Project Status</label>
									  <select name="project_status" id="project_status" class="form-control">
                                        <option value="open" @if('open' == $project->project_status) selected @endif >Open</option>
                                        <option value="close" @if('close' == $project->project_status) selected @endif >Close</option>
										<option value="pending" @if('pending' == $project->project_status) selected @endif >Pending</option>
										 <option value="under_progress" @if('under_progress' == $project->project_status) selected @endif >Under Progress</option>
										 <option value="complete" @if('complete' == $project->project_status) selected @endif >Complete</option>
                                      </select>
                                  </div>
                                  </div>
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select name="status" id="status" class="form-control">
                                        <option value="draft" @if('draft' == $project->status) selected @endif >Draft</option>
										<option value="publish" @if('publish' == $project->status) selected @endif >Publish</option>
										<option value="trash" @if('trash' == $project->status) selected @endif >Trash</option>
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
	
@section('footerScript')
@endsection