@extends('layouts.auth')
@if(sizeof($candidates) > 0 && $candidates[0]->roles[0]->id == 1) 
 @section('page_title','List of Students')	
@elseif(sizeof($candidates) > 0 && $candidates[0]->roles[0]->id == 3) 
 @section('page_title','List of Professional')	
@else	
 @section('page_title','List of Users')
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
														<option value="active" @if('active' == Request::get('status')) selected @endif >Active</option>
														<option value="deactivate" @if('deactivate' == Request::get('status')) selected @endif >Deactivate</option>
														<option value="pending" @if('pending' == Request::get('status')) selected @endif >Pending</option>
														
                                                    </select>
                                                </div>
                                    </div>
@if(Request::url()==route("admin.userListBy","student"))
{{-- || Request::url()==route("admin.userListBy","non-student" --}}
                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <label for="">Select School/College</label>

                                                    <select id="school" name="school" class="form-control fsubmit">
                                                        <option value="change">All</option>
												@if(sizeof($schools) >0)		
                                                 @foreach($schools as $school)
													<option {{ $school->id == Request::get('school')? "selected":""}} value="{{$school->id}}"> {{$school->school_name}}</option>
												@endforeach
												@endif
                                                    </select>
                                                </div>
                                            </div>
@endif					
		
                                    </div>

                                  </form>

                              </div>
                             <div class="col-md-12">
                                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered">
                                      <thead>
                                      <tr>
                                          <th>Image</th>
                                          <th>Name</th>
										  
										   @if(sizeof($candidates) > 0 && $candidates[0]->roles[0]->id == 1) 
											   <th>School/College Name</th>
										    
										   @endif
                                          <th>Email</th>
										  @if(sizeof($candidates) > 0 && $candidates[0]->roles[0]->id == 4)
											   <th>Total Members</th>
										  @endif
										  
                                          <th>Status</th>
                                         
										  {{--<th>Payment Status</th>--}}
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($candidates as $cand)

                                         <tr>
                                             <td> 
											 @if($cand->image)
											  <img width="80" height="80" src="{{url('public/uploads/profile/'.$cand->image)}}" alt="">	 
											 @else
											  <img width="80" height="80" src="{{url('/images/user-default.png')}}" alt="">	 
											 @endif	 
											 </td>

                                             <td>{{ucfirst($cand->first_name)}} {{$cand->last_name}}</td>
                                          @if($candidates[0]->roles[0]->id == 1) 
											<td>
										     @if($cand->student->school_id){{ $cand->student->school->school_name}}@else {{$cand->student->school_name}} @endif
										    </td> 
											
										  @endif
										  
                                             <td>{{$cand->email}}</td>
										  @if(sizeof($candidates) > 0 && $candidates[0]->roles[0]->id == 4)
											   <td>{{sizeof($cand->school->student)}}</td>
										  @endif
										   
										 
                                            <td>
											<form method="POST"  action="{{ route('admin.changeUserStatus',$cand->id)}}" accept-charset="UTF-8">
											 @csrf	 
                                                <select  name="status" id="status" onchange="if(confirm('Do you want to perform this?')){this.form.submit();}" >
                                                    <option value="active" {{$cand->status== 'active'? "selected":""}} >Active</option>
                                                    <option value="deactivate" {{$cand->status== 'deactivate'? "selected":""}}>Deactivate</option>
                                                    <option value="pending" {{$cand->status== 'pending'? "selected":""}}>Pending</option>
                                                </select>
											</form>

                                             </td>
                                           
                                             <td> 
											  <a class="btn btntheme" href="{{route("admin.userDetails", $cand->id)}}">Details</a>
											@if(sizeof($candidates) > 0 && $candidates[0]->roles[0]->id == 1)
											  <a class="btn btntheme" href="{{route("admin.editStudent", $cand->id)}}">Edit</a>												
											@else
											  <a class="btn btntheme" href="{{route("admin.userEdit", $cand->id)}}">Edit</a>
										    @endif
										    
										    @if($cand->status != 'deactivate')
											   <a class="btn btn-danger" href="{{route("admin.changeUserStatuss", $cand->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-times"></i></a>
									            @endif
										    
												  {{-- <a class="btn btntheme" href="{{route("admin.userDelete", $cand->id)}}" onclick="return confirm('Are you sure?')">Delete</a>--}}
											 </td>


                                         </tr>
                                         @empty
                                         <tr>
                                         <td colspan="500"> <h2 style="padding:20px ;text-align: center;">No User Found</h2>
                                         </td>


                                         </tr>
                                        @endforelse
                                       
                                      </tbody>

                                  </table>                               

                                      {!! $candidates->appends(request()->except('page'))->links() !!}
                                  </div>
                              </div>

                          </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
      </div>
    <script type="application/javascript">
        $(document).ready(function(){
            $('.fsubmit').change(function() {
                this.form.submit();
            });
        });
    </script>
@endsection