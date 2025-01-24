@extends('layouts.all.crm')
@section('page_title','List of Project')
@section('page_name',"Add Project")
@section('page_link',route("employer.addProject"))
@section('content')

    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">

                          <div class="row">
                              <div class="col-md-12">
                                  @include("admin.partials.success_msg")

                                  <form action="" method="get">
                                    <div class="row">
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Project Status</label>
                                            <select id="project_status" name="project_status" class="form-control fsubmit">
												<option value="">All</option>
												<option value="open" @if('open' == Request::get('project_status')) selected @endif >Open</option>
												<option value="close" @if('close' == Request::get('project_status')) selected @endif >Close</option>
												<option value="complete" @if('complete' == Request::get('project_status')) selected @endif >Complete</option>
												<option value="under_progress" @if('under_progress' == Request::get('project_status')) selected @endif >Under Progress</option>
												<option value="pending" @if('pending' == Request::get('project_status')) selected @endif >Pending</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select id="status" name="status" class="form-control fsubmit">
											 <option value="">All</option>
											 <option value="draft" @if('draft' == Request::get('status')) selected @endif >Draft</option>
											 <option value="publish" @if('publish' == Request::get('status')) selected @endif >Publish</option>
											 <option value="trash" @if('trash' == Request::get('status')) selected @endif >Trash</option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                  </form>

                              </div>
                             <div class="col-md-12">
                                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered">
                                      <thead>
                                      <tr>
                                          <th  class="custom-smallwidth">Name</th>
										  <th class="custom-width">Description</th>
										  <th>Project Status</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($projects as $cand)
                                         <tr>                                           
                                            <td class="custom-smallwidth">{{ucfirst($cand->name)}}</td>
											<td  class="custom-width" >{!! \Illuminate\Support\Str::limit($cand->description,100,'...')!!}</td>
                                            <td>{{ucfirst(str_replace("_", " ", $cand->project_status))}}</td>
                                            <td>
											<form method="POST" action="{{ route('employer.changeProjectStatus',$cand->id)}}" accept-charset="UTF-8">
											 @csrf	 
                                                <select  name="status" id="status" onchange="this.form.submit()">
                                                    <option value="publish" {{$cand->status== 'publish'? "selected":""}} >Publish</option>
													<option value="draft" {{$cand->status== 'draft'? "selected":""}}>Draft</option>													
                                                    <option value="trash" {{$cand->status== 'trash'? "selected":""}}>Trash</option>
                                                </select>
											</form>
											</td>
											<td>
											  <a class="btn btntheme" href="{{route('employer.projectMembers', $cand->id)}}">Project Members</a>
											  <a class="btn btntheme" href="{{route('employer.editProject', $cand->id)}}">Edit</a>
											</td>
                                         </tr>
                                         @empty
                                         <tr>
                                          <td colspan="500"> <h2 style="padding:20px ;text-align: center;">empty! Project not found</h2></td>
                                         </tr>
                                        @endforelse

                                      </tbody>

                                  </table>

                                      {!! $projects->appends(request()->except('page'))->links()!!}
                                  </div>
                              </div>

                          </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
      </div>
<script type="application/javascript">
        $(document).ready(function(){
            $('.fsubmit').change(function() {
                this.form.submit();
            });
        });
</script>

@endsection