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

            <h2>Add time</h2>

                                  <form action="{{route("interviewSlotStore")}}" method="post">
                                      <div class="row">
                                          @csrf
                                          <div class="col-md-6">  <div class="from-group">
                                                  <label for="">Select Week</label>
                                                  <select class="form-control" name="day" id="">
                                                      <option value="monday">Monday</option>
                                                      <option value="tuesday">Tuesday</option>
                                                      <option value="wednesday">Wednesday</option>
                                                      <option value="thursday">Thursday</option>
                                                      <option value="friday">Friday</option>
                                                      <option value="saturday">Saturday</option>
                                                      <option value="sunday">Sunday</option>
                                                  </select>
                                              </div></div>
                                          <div class="col-md-3"> <div class="form-group">
                                                  <label for="">Start Time</label>
                                                  <input name="start_time" id="timepicker" class="form-control"/>
                                                  <script>
                                                      $('#timepicker').timepicker({
                                                          uiLibrary: 'bootstrap4'
                                                      });
                                                  </script>
                                              </div></div>
                                          <div class="col-md-3">  <div class="form-group">
                                                  <label for="">End Time</label>
                                                  <input name="end_time" class="form-control" id="timepicker1" />
                                                  <script>
                                                      $('#timepicker1').timepicker({
                                                          uiLibrary: 'bootstrap4'
                                                      });
                                                  </script>
                                              </div></div>
                                          <div class="col-md-3"><div class="form-group"><input type="submit" class="btn btn-primary" value="Add "></div> </div>
                                      </div>
                                  </form>
                                  <br>
                                  <br>
                                  <h2>Times of week</h2>

                                  @php
                                      $days = ["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]

                                  @endphp
                                      <table class="table timeslottable">
                                          <thead>
                                          <tr>
                                              <th scope="col">Monday <br> Start : End</th>
                                              <th scope="col">Tuesday</th>
                                              <th scope="col">Wendsday</th>
                                              <th scope="col">Thursday</th>
                                              <th scope="col">Friday</th>
                                              <th scope="col">Saturday</th>
                                              <th scope="col">Sunday</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          <tr>


                                              @foreach($days as $day)
                                              <td>

                                                  @if(!empty($slots) && $slots->{$day})
                                                  @foreach(json_decode($slots->{$day}) as $key=>$slot)
                                                          {{$slot->start_time}} {{$slot->end_time}}<a href="{{'interview-edit/'.$key.'/'.$day}}">Edit</a>
                                                          <a href="{{'interview-delete/'.$key.'/'.$day}}">Del</a> <br>

                                                      @endforeach
                                                  @endif
                                              </td>
                                              @endforeach
                                          </tr>

                                          </tbody>

                                      </table>



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