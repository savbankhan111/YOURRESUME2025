@extends('layouts.auth')
@section('page_title','List of Manager')
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
                                    </div>

                                  </form>

                              </div>
                             <div class="col-md-12">
                                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered">
                                      <thead>
                                      <tr>
                                          <th>Name</th>
										  <th>Industry Type</th>
                                          <th>Email</th>
                                          <th>Profession</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($candidates as $cand)

                                         <tr>
											 <td>{{ucfirst($cand->first_name)}} {{$cand->last_name}}</td>
                                             <td>{{ucfirst($cand->indData->name)}}</td>
											 <td>{{$cand->email}}</td>
											 <td>{{$cand->managerdata->profession}}</td>
                                             <td>
											  <form method="POST" action="{{ route('admin.changeUserStatus',$cand->id)}}" accept-charset="UTF-8">
											    @csrf	 
                                                 <select  name="status" id="status" onchange="if(confirm('Do you want to perform this?')){this.form.submit();}">                                                												
                                                      <option value="active" {{$cand->status== 'active'? "selected":""}} >Activate</option>
                                                      <option value="deactivate" {{$cand->status== 'deactivate'? "selected":""}}>Deactivate</option>
                                                      <option value="suspend" {{$cand->status== 'suspend'? "selected":""}}>Suspend</option> 
                                                 </select>
											  </form>

                                             </td>
                                             <td>
											 {{--<a class="btn btntheme" href="{{url('/admin/users-list/professional?manager='.$cand->id)}}">Employees</a>--}}
											 <a class="btn btntheme" href="{{route("admin.managerDetails", $cand->id)}}">Details</a>											 
											  <a class="btn btntheme" href="{{route("admin.editManager", $cand->id)}}">Edit</a>

                                            @if($cand->status != 'deactivate')
											   <a class="btn btn-danger" href="{{route("admin.changeUserStatuss", $cand->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-times"></i></a>
									            @endif											 </td>


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