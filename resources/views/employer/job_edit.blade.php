@extends('layouts.all.crm')
@section('page_title',"Job Edit")
@section('page_name',"Job List")
@section('page_link',route("employer.jobListBy"))
@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-tagsinput.css')}}">
	<link rel="stylesheet" href="{{ asset('public/css/app-tags.css')}}">
     <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">

                          <div class="">

                              @include("admin.partials.error_forms")
                              @include("admin.partials.success_msg")

<form method="POST" action="{{ route('employer.jobUpdate',$job->id)}}" class="form-horizontal m-t-20" enctype="multipart/form-data">

			@php			
				$skills = '';
				if(sizeof($skillField) > 0){
					$c = 1;
				 foreach($skillField as $sf){
					$skills.=$sf->skillData->name;
					if($c < sizeof($skillField)){
						$skills.= ',';
					}
							$c++;
				}}
			@endphp	
						<input name="_method" type="hidden" value="PUT">
                        @csrf
                                  <div class="row">
								  <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">Company *</label>
                                      <input value="{{$job->title}}" type="text" name="company" class="form-control" required >
                                  </div>
                    </div>
                    <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Position *</label>
									 <input value="{{$job->position}}" type="text" name="position" class="form-control" required >
                                  </div>
                    </div>
					
								  
                                      <div class="col-md-12">
                                          <div class="form-group">
                                      <label for="">Location *</label>
                                      <input value="{{$job->location}}" type="text" name="location" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Employment Type *</label>
                                     <select name="employment_type" id="employment_type" class="form-control">
									  @if(sizeof($employment_type) > 0)
									   @foreach($employment_type as $et)	  
                                        <option value="{{$et->id}}" @if($et->id == $job->employment_type) selected @endif >{{$et->name}}</option>
									   @endforeach
									  @endif	
                                      </select>
                                  </div>
                                      </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Position Department *</label>
                                      <input value="{{$job->position_department}}" type="text" name="position_department" class="form-control" required >
                                  </div>
                                </div>
                                
                                
                                  <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Min Salery *</label>
                                      <input value="{{$job->min_salary}}" type="text" name="min_salary" class="form-control" required >
                                  </div>
                                </div>
                                
                                 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Max Salery *</label>
                                      <input value="{{$job->max_salary}}" type="text" name="max_salary" class="form-control" required >
                                  </div>
                                </div>
                                

<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Industry type *</label>
									  <select name="industry_type" class="form-control">
									  @if(sizeof($industry) > 0)
									   @foreach($industry as $id)
								        <option value="{{$id->id}}" {{$job->industry_id == $id->id? "selected":""}} >{{$id->name}}</option>
									   @endforeach
									  @endif	  
									 </select>
                                  </div>
                                  </div>

								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Job Description *</label>
                                      <textarea name="description" class="form-control" required >{{$job->description}}</textarea>
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Responsibilty</label>
                                      <textarea name="responsibilty" class="form-control" >{{$job->responsibilty}}</textarea>
                                  </div>
                                </div>
								
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Skills Requirement</label>
                                      <input value="{!!$skills!!}" name="skill" id="skill" type="text" class="form-control" data-role="tagsinput" >
                                  </div>
                                          </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Image</label>
									   @if($job->image)
									   <img width="100" height="100" src="{{url('public/uploads/jobs/'.$job->image)}}" alt="">
									 @endif
                                      <input value="" type="file" name="job_image" class="form-control" accept="image/*" >
                                  </div>
                                </div>
								
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Job Video</label>
									   @if($job->job_video)
								   <video width="320" height="240" controls>
									  <source src="{{url('public/uploads/jobs/videos/'.$job->job_video)}}">
									  Your browser does not support the video tag.
									</video>
									 @endif
                                      <input value="" type="file" name="job_video" class="form-control" accept="video/mp4,video/x-m4v,video/*" >
                                  </div>
                                </div>

								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Job Status</label>
									  <select name="job_status" id="job_status" class="form-control">
                                        <option value="open" @if('open' == $job->job_status) selected @endif >Open</option>
                                        <option value="close" @if('close' == $job->job_status) selected @endif >Close</option>
										<option value="pending" @if('pending' == $job->job_status) selected @endif >Pending</option>
                                      </select>
                                  </div>
                                  </div>
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select name="status" id="status" class="form-control">
                                        <option value="draft" @if('draft' == $job->status) selected @endif >Draft</option>
                                        <option value="pending" @if('pending' == $job->status) selected @endif >Pending</option>
										<option value="publish" @if('publish' == $job->status) selected @endif >Publish</option>
										<option value="trash" @if('trash' == $job->status) selected @endif >Trash</option>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
  <script src="{{ asset('public/js/bootstrap-tagsinput.min.js')}}"></script>
<script> 
var skills = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: '{{url("/ajax/skills")}}',
    filter: function(list) {
      return $.map(list, function(skills) {
        return { name: skills }; });
    }
  }
});
skills.initialize();

$('input#skill').tagsinput({
  typeaheadjs: {
    name: 'skills',
    displayKey: 'name',
    valueKey: 'name',
    source: skills.ttAdapter()
  }
});
$(document).ready(function(){
});	
</script>
@endsection
