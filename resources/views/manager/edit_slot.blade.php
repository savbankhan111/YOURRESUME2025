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

                                  @php
                                      $days = ["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]

                                  @endphp
            <h2>Edit time</h2>

                                      <form action="{{route("interviewSlotUpdate",[$index, $day])}}" method="post">

                                      <div class="row">
                                          @csrf
                                          @method("patch")
                                          <div class="col-md-6">  <div class="from-group">
                                                  <label for="">Select Week</label>
                                                  <select class="form-control" name="day" id="">
                                                      @foreach($days as $d)
                                                      <option {{$d == $day ? "selected" : ""}} value="{{$d}}">{{ucwords($d)}}</option>
                                                          @endforeach
                                                  </select>
                                              </div></div>
                                          <div class="col-md-3"> <div class="form-group">
                                                  <label for="">Start Time</label>
                                                  <input type="time" value="{{$slot["start_time"]}}" name="start_time" id="timepicker" class="form-control" required />
                                                 
                                              </div></div>
                                          <div class="col-md-3">  <div class="form-group">
                                                  <label for="">End Time</label>
                                                  <input type="time" value="{{$slot["end_time"]}}" name="end_time" class="form-control" id="timepicker1" required  />
                                                
                                              </div></div>
                                          <div class="col-md-3"><div class="form-group"><input type="submit" class="btn btn-primary" value="Update "></div> </div>
                                      </div>
                                  </form>


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