@extends('layouts.auth')
@section('page_title','Candidates Profile Edit')
@section('page_name','Candidate Detail')
@section('page_link',route("admin.userDetails", $user->id))

@section('content')

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/css/bootstrap-slider.min.css">--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/bootstrap-slider.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>--}}

    <style>
        .tooltip.top .tooltip-arrow {
            bottom: -5px;
            left: 50%;
            margin-left: -5px;
            border-width: 5px 5px 0;
            border-top-color: #000;
            position: absolute;
            width: 0;
            height: 0;
            border-style: solid;
        }
        .tooltip-arrow {
            position: absolute;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
        }
        .tooltip.in{opacity: 0.9;z-index: 99}
        .slider.slider-horizontal {
            width: 100%;
        }
    </style>
     <div class="container-fluid">


            <div class="row">
            <div class="col-md-12">
                <div class="card candidate-profile-editpage">
                    <div class="card-body">
                        <div class="align-items-center">


                          <div class="">

                              @include("admin.partials.error_forms")
                              @include("admin.partials.success_msg")

                                  {!! Form::open(['route' => ['admin.profileEdit', $user->id],  'method' => 'PUT']) !!}

                                  <div class="row">


                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <input type="hidden" name="rolesAdd" value="1">
                                              <label for="">Specialization</label>
                                              <select name="specialization[]" multiple data-style="bg-white rounded-pill px-4 py-3" class="selectpicker w-100">
                                                  @foreach($roles as $role)
                                                  <option value="{{$role->id}}" {{in_array($role->id, array_column((array)$user->skills->toArray(), 'id')) ? "selected": ""}}>{{$role->role}}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group">

                                              <label class="mdb-main-label">Languages</label>

                                              <select name="language[]" multiple data-style="bg-white rounded-pill px-4 py-3" class="selectpicker w-100">
                                                  @foreach(config('constants.LANGUAGES') as $lang)
                                                      <option value="{{$lang}}" {{in_array($lang, explode(",", $profile->languages))? "selected": ""}}>{{$lang}}</option>
                                                  @endforeach
                                              </select><!-- End -->


                                  </div>
                                      </div>
                                      <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Softwares</label>
                                      <select name="softwares[]" multiple data-style="bg-white rounded-pill px-4 py-3" class="selectpicker w-100">
                                          @foreach(config('constants.SOFTWARES') as $soft)
                                              <option value="{{$soft}}" {{in_array($soft, explode(",", $profile->softwares))? "selected": ""}}>{{$soft}}</option>
                                          @endforeach
                                      </select><!-- End -->


                                  </div>
                                      </div>


                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Graduation Year</label>
                                      <div id="sandbox-container">
                                          <input value="{{$profile->graduation_year}}" type="text" name="graduation_year" class="form-control">
                                      </div>


                                  </div>
                                </div>
                                      <div class="col-md-6">

                                          <div class="form-group">
                                              <label for="">Job Search Range</label>
                                              <input type="range" id="ex8" data-slider-id='ex1Slider' type="text" value="{{$profile->job_search_range}}" data-slider-min="0" data-slider-max="100" data-slider-step="1" name="job_search_range" data-slider-value="{{$profile->job_search_range}}">
                                          </div>
                                      </div>
                              <div class="col-md-12 ">
                                 <div class="row other">
                                     <div class="col-md-6 ">
                                         <div class="form-group">
                                             <label for="">College</label>
                                             <select name="college_id" class="form-control" id="collegeId">
                                                 @foreach($colleges as $college)
                                                     <option value="{{$college->id}}" {{$college->id == $profile->college_id ? 'selected': ''}}>{{$college->name}}</option>
                                                 @endforeach
                                                 <option value="other">Other</option>
                                             </select>

                                         </div>
                                     </div>





                                 </div>
                              </div>


                         <div class="col-md-12">
                             <div class="form-group">
                                  <button class="btn btntheme">Update</button>
                             </div>
                        </div>
                                  </div>
                              {!! Form::close() !!}
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function(){
            $('#collegeId').on('change',function(){
                //var optionValue = $(this).val();
                //var optionText = $('#dropdownList option[value="'+optionValue+'"]').text();
                var optionText = $("#collegeId option:selected").val();
                if(optionText == "other"){

                    $(".other").append(`<div class="col-md-6 otherCollege">  <div class="form-group"> <label for="">Enter College Name</label><input type="text" class="form-control" placeholder="Enter College Name" name="college"  > </div> </div>`);

                }else{
                    $(".otherCollege").remove();

                }

            });

            $(function () {
                $('.selectpicker').selectpicker().clear();
            });
            $("#ex8").slider({
                tooltip: 'always'
            });

            $('#sandbox-container input').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                yearRange: '2000:2050'

            });
        });





    </script>
@endsection