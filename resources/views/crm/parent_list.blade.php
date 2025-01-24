@extends('layouts.school')
@section('page_title','List of Alert')
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
<input type="hidden" name="status" value="{{Request::get('status')}}">                                  						

                                    </div>

                                  </form>

                              </div>
                             <div class="col-md-12">
                                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered">
                                      <thead>
                                      <tr>
                                          <th>User Name</th>
										  <th>Email</th>
                                          <th>Location</th>
                                          <th>Lat & Lng</th>										  
                                          <th>Comment</th>
                                          <th>Status</th>
                                          <th>Sub alert count</th>
                                          <th>Action</th>


                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($alerts as $cand)

                                         <tr>
                                            <td>{{ucfirst($cand->user->firstname)}} {{$cand->user->lastname}}</td>	
											<td>{{$cand->user->email}}</td>											
                                            <td>{{$cand->location}}</td>
											<td>{{$cand->lat}}, {{$cand->lng}}</td>
											<td>{{$cand->comment}}</td>
                                            <td>
											 @if($cand->status== 1) 
											 <form method="POST" action="{{ route('changeParentStatus',$cand->id)}}" accept-charset="UTF-8">
											 @csrf	 
                                                 <select  name="status" id="status" onchange="this.form.submit()">
                                                												
                                                      <option value="1" {{$cand->status== '1'? "selected":""}} >Active</option>
                                                        <option value="0" {{$cand->status== '0'? "selected":""}}>Deactivate</option>
                                                                                                          
                                                                                                      
                                                 </select>

										      </form>			
											 @else Deactivate @endif
                                            </td>
                                            <td>{!!sizeof($cand->subAlert)!!}</td>

                                             <td>
											  <a class="btn btntheme" href="{{route("subAlerts", $cand->id)}}">Sub Alerts</a>
											  <a class="btn btntheme" href="{{route("parentGallery", $cand->id)}}">Gallery</a>
											 </td>
                                         </tr>
                                         @empty
                                         <tr>
                                         <td colspan="500"> <h2 style="padding:20px ;text-align: center;">empty! record not Found</h2>
                                         </td>


                                         </tr>
                                        @endforelse
                                       
                                      </tbody>

                                  </table>                               

                                      {!! $alerts->appends(request()->except('page'))->links() !!}
                                  </div>
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