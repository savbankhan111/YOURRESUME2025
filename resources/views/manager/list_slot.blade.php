@extends('layouts.all.crm')
@section('page_title','Interview Slots')
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

            <h4>Add time</h4>

                                  <form action="{{route("interviewSlotStore")}}" method="post">
                                      <div class="row">
                                          @csrf
                                          <div class="col-md-3">  <div class="from-group">
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
                                                  <input type="time" name="start_time" id="timepicker" class="form-control" required  />
                                                  
                                              </div></div>
                                          <div class="col-md-3">  <div class="form-group">
                                                  <label for="">End Time</label>
                                                  <input type="time" name="end_time" class="form-control" id="timepicker1" required  />
                                                
                                              </div></div>
                                          <div class="col-md-3"><div style="margin-top:8px;" class="form-group"><br><input type="submit" class=" themebtnmain" value="Add "></div> </div>
                                      </div>
                                  </form>
                                  <br>
                                  <br>
                                  <h4>Times of week</h4>                                     
<br>
                                  @php
                                      $days = ["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]

                                  @endphp
                                      <table class="table timeslottable weekdays">

                                          <thead>
                                          <tr>
                                              <th scope="col">Monday</th>
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
                                                      <p class="timeslotsitem"><span> {{$slot->start_time}}</span><span>To</span><span> {{$slot->end_time}}</span>
                                                        <a class="edit" href="{{'interview-edit/'.$key.'/'.$day}}"><i class="fa fa-pencil"></i></a><a  class="delete" href="{{'interview-delete/'.$key.'/'.$day}}"><i class="fa fa-trash"></i></a></p> 

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