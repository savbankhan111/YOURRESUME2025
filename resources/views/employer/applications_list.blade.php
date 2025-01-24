@extends('layouts.all.crm')
@section('page_title','List of Job')
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


									@if ($message = Session::get('error'))
										<div class="alert alert-warning alert-block">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>{{ $message }}</strong>
										</div>p
									@endif


									@if ($errors->any())
										<div class="alert alert-danger">
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									@endif

									<a class="btn btn-primary" href="{{route("employer.applications", $job_id)}}" >Refresh</a>
									
                                    <form action="" method="get">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Status</label>

                                                    <select id="status" name="status" class="form-control ">
                                                        <option value="">All</option>
                                                        @foreach(config("constants.status") as $status)
														<option value="{{$status}}" @if($status == Request::get('status')) selected @endif >{{$status}}</option>
                                                   		@endforeach
                                                    </select>
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Language</label>
                                                    <select id="language" name="language" class="form-control ">
                                                        <option value="">All</option>
                                                        @foreach($langs as $lang)
														<option value="{{$lang->name}}" @if($lang->name == Request::get('language')) selected @endif >{{$lang->name}}</option>
                                                   		@endforeach
                                                    </select>
                                                </div>
                                            </div>

                                          <div class="col-md-3">
												<div class="form-group">
													<label for="">Degree</label>
													<select id="type_of_degree" name="type_of_degree" class="form-control ">

														<option value="">All</option>
														@foreach(config("constants.degree") as $degree)
															<option value="{{$degree}}" @if($degree == Request::get('type_of_degree')) selected @endif >{{$degree}}</option>

														@endforeach
													</select>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label for="">Experience</label>
													<select id="years_of_experience" name="years_of_experience" class="form-control ">
														<option value="">All</option>
														@foreach(config("constants.experiences") as $exp)
														<option value="{{$exp}}" @if($exp == Request::get('years_of_experience')) selected @endif >{{$exp}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="">Gpa</label>
													<input id="gpa_range" name="gpa_range" class="form-control" value="{{Request::get('gpa_range')}}"/>
														
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label for="">Intership</label>
													<select id="intership_co_op_exp" name="intership_co_op_exp" class="form-control ">
														<option value="">All</option>
														<option value="yes" @if('yes' == Request::get('intership_co_op_exp')) selected @endif >Yes</option>
														<option value="no" @if('no' == Request::get('intership_co_op_exp')) selected @endif >No</option>

													</select>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label for="">Residency</label>
													<select id="residency" name="residency" class="form-control ">
														<option value="">All</option>
														<option value="yes" @if('yes' == Request::get('residency')) selected @endif >Yes</option>
														<option value="no" @if('no' == Request::get('residency')) selected @endif >No</option>

													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="">Position</label>
													<select id="position_held" name="position_held" class="form-control ">
														<option value="">All</option>
													@foreach(config("constants.position") as $pos)
														<option value="{{$pos}}" @if($pos == Request::get('position_held')) selected @endif >{{$pos}}</option>
												@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="">Licenses</label>
													<select id="professional_licenses" name="professional_licenses" class="form-control ">
														<option value="">All</option>
														<option value="yes" @if('yes' == Request::get('professional_licenses')) selected @endif >Yes</option>
														<option value="no" @if('no' == Request::get('professional_licenses')) selected @endif >No</option>

													</select>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label for="">Certifications</label>
													<select id="certifications" name="certifications" class="form-control ">
														<option value="">All</option>
														<option value="yes" @if('yes' == Request::get('certifications')) selected @endif >Yes</option>
														<option value="no" @if('no' == Request::get('certifications')) selected @endif >No</option>

													</select>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label for="">Skills</label>
													<select id="skills" name="skills" class="form-control ">
														<option value="">All</option>
														@foreach($skills as $skill)
														<option value="{{$skill->skillData->name}}" @if($skill->skillData->name == Request::get('skills')) selected @endif >{{$skill->skillData->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
										<button class="btn btn-primary">Search</button>

                                        </div>
                                    </form>

                                </div>
</div>


                            @foreach($apps as $app)

                            <div class="cadidatelist-wrap">
                            		<div class="candidate-list">
                            			<div class="row">
                            				<div class="col-md-2">
                            					<div class="profile-pic">
                            						<img width="150px" height="150px" src="{{ asset('public/uploads/profile/'.$app->image)}}" alt="homepage"/>
                            					</div>
                            				</div>
                            				<div class="col-md-10">
                            					<div class="profile-detail">
                            						<div class="row">
                            							<div class="col-md-6"><h3 class="namec"><a href="{{route("employer.jobUserDetails", $app->id)}}">{{$app->first_name}} {{$app->last_name}}</a></h3> </div>
                            							<div class="col-md-6 text-right"><p class="posttitle"><i class="fa fa-bookmark-o" aria-hidden="true"></i> <span>
                            							    	@if(!is_null($app->appointment))
																	{{$app->appointment->position_held ?? ""}}
																	
																		@endif
                            							 
                            							    </span> &nbsp;&nbsp;<span><button data-user-id="{{$app->id}}" data-user-name="{{$app->first_name}} {{$app->last_name}}" type="button" class="btn btn-primary addUserInProject" data-toggle="modal" data-target="#addToProject">Add Profile in Project </button></span> </p> </div></div>

 <p class="info-c">
	 @if(!is_null($app->resume))
     {{$app->resume->about_us}}
		 @endif
 </p>
                            					</div>
                            				</div>
                            			<div class="col-md-12"><div class="profile-meta">
                            				<p><strong>Skill: </strong>

                                                <span>
													@if(!is_null($app->skills))
                                                     @foreach($app->skills as $lanInd => $skill)
                                                      {{$skill->name}}{{(count($app->skills) -2) < $lanInd ? "": ","}}
                                                    @endforeach
														@endif

                                                </span>&nbsp;&nbsp; <strong>Language: </strong><span>
                                                    @if(!is_null($app->language))
													@foreach($app->language as $lang)
                                                        {{$lang->name}}{{(count($app->language) -2) < $lanInd ? "": ","}}
                                                     @endforeach
                                                     @endif

                                                </span></p>
                            			</div>
                            		</div>
                            		 </div>
                            		</div>

@endforeach


                                {{$apps->links()}}


 </div>










                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


	<!-- Modal -->
	<div class="modal fade" id="addToProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					Name : <h4 id="job_user_name">kkkk</h4>
					<form action="{{route("employer.addUserInProject")}}" method="post">
						@csrf
						<input type="hidden" id="job_user_id" name="userId">
						<div class="form-group">
							<select class="form-control" name="projectId" id="">
								<option value="">Select Project</option>
								@foreach($projects as $pro)
									<option value="{{$pro->id}}">{{$pro->name}}</option>
								@endforeach
							</select>
						</div>

						<button type="submit" class="btn btn-primary"> Add Profile in Project</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
	</div>

    <script>
        $(document).ready(function(){

        	$(".addUserInProject").click(function (event) {

        		console.log($(this).data("userName"));
        		console.log($(this).data("userId"));
				$("#job_user_name").text("");
				$("#job_user_id").val("");

				$("#job_user_name").text($(this).data("userName"));
				$("#job_user_id").val($(this).data("userId"));
			});

            $('.fsubmit').change(function() {
                this.form.submit();
            });
        });
    </script>

@endsection