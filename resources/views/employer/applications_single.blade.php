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


                                </div>
</div>




 </div>


           


                           <div class="single-profile-page">
                           	<div class="col-md-12">
								<button data-user-id="{{$apps->id}}" data-user-name="{{$apps->first_name}} {{$apps->last_name}}" type="button" class="btn btn-primary addUserInProject" data-toggle="modal" data-target="#addToProject">Add Profile in Project </button>

                           		<div class="profilepic">
                           			<img src="{{ asset('public/uploads/profile/'.$apps->image)}}">
                           		</div>
                           	</div>
                           		<div class="col-md-12">
                           	<div class="profildata">
                           		<h3>{{$apps->first_name}} {{$apps->last_name}}</h3>
                           		<h4>{{$apps->appointment->position_held}}</h4>
                           	</div>
                           </div>

                           <div class="col-md-12">
                           	<div class="about-profile secsin">
                           		<h3>About</h3>
                           		 <p>{{$apps->resume->about_us}}.</p>
                           	</div>
                           </div>
                              <div class="col-md-12">
                           	<div class="interviewrecord secsin">
                           		<h3>Interviewer Record</h3>
                           		 <p><a href="#">{{$apps->resume->interview_record}}</a></p>
                           	</div>
                           </div>

                              <div class="col-md-12">
                           	<div class="experience-wrap secsin">
                           		<h3>Experience </h3>
                             <div class="row">
								 @foreach($apps->experience as $exp)

									 <div class="col-md-6">

                             <div class="experience-list">
                             	<div class="row">

                             			<div class="col-md-9"><div class="compny-detail">
                             				<h3>{{$exp->position}}</h3>
                             				<p>{{$exp->company_name}}</p>
												<p>{{$exp->start}} - {{$exp->end}}</p>
                             			</div></div>
                             	</div>
                             </div>
                             </div>
								 @endforeach


                             </div>
                           	</div>
                           </div>


                           <div class="col-md-12">
                           	<div class="experience-wrap secsin">
                           		<h3>Education </h3>
                             <div class="row">

								 @foreach($apps->education as $edu)
                             	<div class="col-md-6">
                             <div class="experience-list">
                             	<div class="row">

                             			<div class="col-md-9"><div class="compny-detail">
                             				<h3>{{$edu->school_name}}</h3>
                             				<p>Class : {{$edu->class_name}}</p>
                             				<p>{{$edu->start_year}} {{$edu->end_year}}</p>
                             			</div></div>
                             	</div>
                             </div>
                             </div>

								 @endforeach

                             </div>
                           	</div>
                           </div>
							 
							   <div class="col-md-12">
                           	<div class="dgreewrap secsin">
                           		<h3>Degree GPA</h3>
                           		 <p>{{$apps->appointment->gpa_range}} GPA</p>
                           	</div>
                           </div>

                              <div class="col-md-12">
                           	<div class="skilhandling secsin">
                           			<h3>Skill Hastags </h3>
								@foreach($apps->skills as  $skill)

									<span class="badge-skill">{{$skill->name}}</span>
								@endforeach


                           	</div>
                           </div>

                               <div class="col-md-12">
                           	<div class="languagesec secsin">
                           			<h3>Languages </h3>
								@foreach($apps->resume->language as $lang)

									<span class="badge-lang"><b>{{$lang->name}}</b>Fluent</span>
								@endforeach


                           	</div>
                           </div>
   						<div class="col-md-12">
                           	<div class="transcript secsin">
                           		<h3>Transcript </h3>
                           		 <p>
									 @foreach($apps->documents as $doc)
										 @if($doc->type == "transcript")
											 {{$doc->file_name}}
											 @endif
										 @endforeach
			               	</div>
                           </div>

                           	<div class="col-md-12">
                           	<div class="transcript secsin">
                           		<h3>Recommendation Letter</h3>
                           		 <p>
									 @foreach($apps->documents as $doc)
										 @if($doc->type == "reccom_letter")
											 {{$doc->file_name}}
										 @endif
									 @endforeach
			               	</div>
                           </div>

                              	<div class="col-md-12">
                           	<div class="portfololink secsin">
                           		<h3>Portfolio</h3>
                         	  <span>{{$apps->resume->interview_record}}</span>
                           	</div>
                           </div>
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

						<button type="submit" class="btn btn-primary">Add Profile in Project</button>
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