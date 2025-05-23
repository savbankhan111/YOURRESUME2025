@extends('layouts.auth')
@section('page_title','List of School/College')
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
														<option value="active" @if('active' == Request::get('status')) selected @endif >Active</option>
														<option value="deactivate" @if('deactivate' == Request::get('status')) selected @endif >Deactivate</option>
														<option value="pending" @if('pending' == Request::get('status')) selected @endif >Pending</option>
														
                                                    </select>
                                                </div>
                                    </div>
                                    </div>
                                  </form>

                              </div>
                             <div class="col-md-12">
                                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered">
                                      <thead>
                                      <tr>
										  <th>School Code</th>
                                          <th>School/College Name</th>
										  <th>Total Students</th>
                                          <th>Status</th>
                                          <th>Actions</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($candidates as $cand)

                                         <tr>
											 <td>{{$cand->school_code}}</td>
                                             <td>{{ucfirst($cand->school_name)}}</td>
											 <td>{{sizeof($cand->student)}}</td>
                                             <td>
											  <form method="POST" action="{{ route('admin.changeSchoolStatus',$cand->id)}}" accept-charset="UTF-8">
												 @csrf	 
                                                <select  name="status" id="status" onchange="if(confirm('Do you want to perform this?')){this.form.submit();}">
													<option value="active" {{$cand->status== 'active'? "selected":""}} >Active</option>
                                                    <option value="deactivate" {{$cand->status== 'deactivate'? "selected":""}}>Deactivate</option>
                                                    <option value="pending" {{$cand->status== 'pending'? "selected":""}}>Pending</option>
                                                </select>
											  </form>
                                             </td>
                                             <td>
											 <a class="btn btntheme" href="{{url('/admin/users-list/student?school='.$cand->id)}}">Students</a>
											 <a class="btn btntheme" href="{{route("admin.schoolDetails", $cand->id)}}">Details</a>											 
											  <a class="btn btntheme" href="{{route("admin.editSchool", $cand->id)}}">Edit</a>
											 </td>
                                         </tr>
                                         @empty
                                         <tr>
                                         <td colspan="500"> <h2 style="padding:20px ;text-align: center;">No data Found</h2>
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