@extends('layouts.all.crm')
@if(Request::input('status')=='done')
	@section('page_title','Completed Interviews')
@else
	@section('page_title','Pending Interviews')
@endif
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
                                                    <label for="">Status</label>
                                                    <select id="status" name="status" class="form-control fsubmit">
													 <option value="">All</option>
													 <option value="done" @if('done' == Request::get('status')) selected @endif >Done</option>
													 <option value="pending" @if('pending' == Request::get('status')) selected @endif >Pending</option>
                                                    </select>
                                                </div>
                                    </div>
                                    </div>
                                  </form>

                              </div>
                                <div class="col-md-12">

                                    <table class="table timeslottable">

                                        <thead>
                                        <tr>
                                            <th scope="col">Date  </th>
                                            <th scope="col">User Name</th>
											<th scope="col">Interview Type</th>
                                            <th scope="col">Time </th>
                                          
											<th scope="col">Status</th>
											<th scope="col">Feedback</th>
                                            <th scope="col">Booked Date</th>
											<th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

										@if(sizeof($interviewerUsers) > 0)	

                                            @foreach($interviewerUsers as $interviewerUser)
                                                <tr>
                                                <td>{{$interviewerUser->date}} {{ucfirst($interviewerUser->day)}}</td>
                                                <td>{{ ucfirst($interviewerUser->userInfo->first_name)}} {{$interviewerUser->userInfo->last_name}}</td>
												<td>@if($interviewerUser->interview_type=="profesional")
													Professional 
													@else
													{{ucfirst($interviewerUser->interview_type)}}
													@endif
												</td>
                                                <td>{{$interviewerUser->start_time}} to {{$interviewerUser->end_time}}</td>
												<td>
												<form method="POST" action="{{ route('changeISBStatus',$interviewerUser->id)}}" accept-charset="UTF-8">
												 @csrf	 
                                                 <select  name="status" id="status" onchange="this.form.submit()">
                                                    <option value="done" {{$interviewerUser->status== 'done'? "selected":""}} >Done</option>
                                                    <option value="pending" {{$interviewerUser->status== 'pending'? "selected":""}}>Pending</option>
                                                 </select>
												</form>
												</td>
												<td>@if($interviewerUser->admin_feedback) {{ ucfirst($interviewerUser->admin_feedback)}} @else - @endif</td>
                                                <td>{{date('d-m-Y',strtotime($interviewerUser->created_at))}}</td>
												<td>
												 @if($interviewerUser->status == 'done')
													 <a href="javascript:void(0)" class="btn btntheme" data-toggle="modal" data-target="#iVModal_{{$interviewerUser->id}}">Video</a>
												 @endif
												  <a class="btn btntheme" href="{{ route('getInterview', $interviewerUser->id)}}">View</a>
												</td>
                                                </tr>
												
										<div class="modal" id="iVModal_{{$interviewerUser->id}}">
										  <div class="modal-dialog">
											<div class="modal-content">
											  <!-- Modal Header -->
											  <div class="modal-header">
												<h4 class="modal-title">Interview Info. Update</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											  </div>
											  <!-- Modal body -->
											  <div class="modal-body">
                                             
											  <form method="POST" action="{{ url('ivideo-update', $interviewerUser->id)}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
											
																@csrf	
															<div class="row">				
																<div class="col-md-12">
																	<div class="form-group">
																	  <label for=""><a class="videolinkbtn" href="{{$interviewerUser->video}}" target="_blank" >View The Video</a></button> </label>
																	  <input value="{{$interviewerUser->video}}" type="file" name="video" accept="video/mp4,video/x-m4v,video/*" class="form-control" />
																	</div>
																	<div class="form-group">
																	  <label for="">Feedback</label>
																	   <select id="admin_feedback" name="admin_feedback" class="form-control">
																		 <option value="">-</option>
																		 <option value="pass" @if('pass' == $interviewerUser->admin_feedback) selected @endif >Pass</option>
																		 <option value="fail" @if('fail' == $interviewerUser->admin_feedback) selected @endif >Fail</option>
																		</select>
																	</div>
																	
																		<div class="form-group">
																	  <label for="">Point</label>
																	   <input value="{{$interviewerUser->point}}" type="text" name="point" class="form-control" />
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
											  <!-- Modal footer -->
											  <div class="modal-footer"></div>
											</div>
										  </div>
										</div>											
					@endforeach
	@else
	 <tr><td colspan="10">empty! record not found</td></tr>
	@endif

                                        </tbody>

                                    </table>
									 {!! $interviewerUsers->appends(request()->except('page'))->links() !!}
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
        $(document).ready(function(){
            $('.fsubmit').change(function() {
                this.form.submit();
            });
        });
</script>
@endsection