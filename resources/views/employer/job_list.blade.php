@extends('layouts.all.crm')
@section('page_title','List of Job')
@section('page_name',"Add Job")
@section('page_link',route("employer.addJob"))
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
                                                    <label for="">Job Status</label>
                                                    <select id="job_status" name="job_status" class="form-control fsubmit">
													<option value="">All</option>
                                        <option value="open" @if('open' == Request::get('job_status')) selected @endif >Open</option>
										<option value="close" @if('close' == Request::get('job_status')) selected @endif >Close</option>
										<option value="pending" @if('pending' == Request::get('job_status')) selected @endif >Pending</option>
										
                                                    </select>
                                                </div>
                                    </div>
									<div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select id="status" name="status" class="form-control fsubmit">
													<option value="">All</option>
										<option value="draft" @if('draft' == Request::get('status')) selected @endif >Draft</option>
                                        <option value="pending" @if('pending' == Request::get('status')) selected @endif >Pending</option>
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
                                          <th>Company</th>
										  <th>Position</th>
										  <th>Job Status</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                          <th>Applicants</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($jobs as $cand)
                                         <tr>                                           
                                            <td>{{ucfirst($cand->title)}}</td>
											<td>{{$cand->position}}</td>
                                            <td>{{ucfirst($cand->job_status)}}</td>
                                            <td>
											<form method="POST" action="{{ route('employer.changeJobStatus',$cand->id)}}" accept-charset="UTF-8">
											 @csrf	 
                                                <select  name="status" id="status" onchange="this.form.submit()">
                                                    <option value="publish" {{$cand->status== 'publish'? "selected":""}} >Publish</option>
                                                    <option value="pending" {{$cand->status== 'pending'? "selected":""}}>Pending</option>	
													<option value="draft" {{$cand->status== 'draft'? "selected":""}}>Draft</option>													
                                                    <option value="trash" {{$cand->status== 'trash'? "selected":""}}>Trash</option>
                                                </select>
											</form>
											</td>
                                             <td>
											  <a class="btn btntheme" href="{{route("employer.editJob", $cand->id)}}"><i class="fa fa-pencil"></i></a>
											  <a class="btn btn-success" href="{{route("employer.jobDetail", $cand->id)}}"><i class="fa fa-eye"></i></a>
											  @if($cand->status != 'trash')
											   <a class="btn btn-danger" href="{{route("employer.jobSetTrash", $cand->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash-o"></i></a>
									            @endif
										
												  {{-- <a class="btn btntheme" href="{{route("employer.jobDelete", $cand->id)}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></a> --}}
											 </td>
                                             <td>
                                                 <a href="{{route("employer.applications", $cand->id)}}">Applications</a>
                                             </td>
                                         </tr>
                                         @empty
                                         <tr>
                                         <td colspan="500"> <h2 style="padding:20px ;text-align: center;">No Job Found</h2>
                                         </td>


                                         </tr>
                                        @endforelse

                                      </tbody>

                                  </table>

                                      {!! $jobs->appends(request()->except('page'))->links() !!}
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