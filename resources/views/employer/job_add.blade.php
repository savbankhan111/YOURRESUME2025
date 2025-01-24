@extends('layouts.all.crm')
@section('page_title',"Add Job")
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

                              <form method="POST" action="{{ route('employer.storeJob') }}" class="form-horizontal m-t-20" enctype="multipart/form-data">
                                @csrf
                                <!-- Remove the hidden input field or correct it -->
                                <input type="hidden" name="_method" value="POST">
                                  <div class="row">
								  <div class="col-md-6">
                                          <div class="form-group">
                                      <label for="">Company *</label>
                                      <input value="" type="text" name="company" class="form-control" required >
                                  </div>
                    </div>
                    <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Position *</label>
									 <input value="" type="text" name="position" class="form-control" required >
                                  </div>
                    </div>
					
								  
                                      <div class="col-md-12">
                                          <div class="form-group">
                                      <label for="">Location *</label>
                                      <input value="" type="text" name="location" class="form-control" required >
                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Employment Type *</label>
                                     <select name="employment_type" id="employment_type" class="form-control">
									  @if(sizeof($employment_type) > 0)
									   @foreach($employment_type as $et)	  
                                        <option value="{{$et->id}}" >{{$et->name}}</option>
									   @endforeach
									  @endif	
                                      </select>
                                  </div>
                                      </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Position Department *</label>
                                      <input value="" type="text" name="position_department" class="form-control" required >
                                  </div>
                                </div>
                                
                                
                                 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Min Salery *</label>
                                      <input value="" type="text" name="min_salary" class="form-control" required >
                                  </div>
                                </div>
                                
                                 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Max Salery *</label>
                                      <input value="" type="text" name="max_salary" class="form-control" required >
                                  </div>
                                </div>
                                

                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Industry type *</label>
									  <select name="industry_type" class="form-control">
									  @if(sizeof($industry) > 0)
									   @foreach($industry as $id)
								        <option value="{{$id->id}}" >{{$id->name}}</option>
									   @endforeach
									  @endif	  
									 </select>
                                  </div>
                                          </div>

								<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Job Description *</label>
                                      <textarea name="description" class="form-control" required ></textarea>
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Responsibilty</label>
                                      <textarea name="responsibilty" class="form-control" ></textarea>
                                  </div>
                                </div>
								
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Skills Requirement</label>
                                      <input value="" name="skill" id="skill" type="text" class="form-control" data-role="tagsinput" >
                                  </div>
                                          </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Image</label>
                                      <input value="" type="file" name="image" class="form-control" accept="image/*" >
                                  </div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Job Video</label>
                                      <input value="" type="file" name="job_video" class="form-control" accept="video/mp4,video/x-m4v,video/*" >
                                  </div>
                                </div>
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Job Status</label>
									  <select  name="job_status" id="job_status" class="form-control">
                                        <option value="open" >Open</option>
                                        <option value="close" >Close</option>
										<option value="pending" >Pending</option>
                                      </select>
                                  </div>
                                  </div>
								 <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Status</label>
									  <select  name="status" id="status" class="form-control">
                                        <option value="draft" >Draft</option>
                                        <option value="pending" >Pending</option>
										<option value="publish" >Publish</option>
										<option value="trash" >Trash</option>
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
