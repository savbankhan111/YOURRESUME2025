@extends('layouts.auth')
@section('page_title','List of Employer')

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
														<option value="suspend" @if('suspend' == Request::get('status')) selected @endif >Suspend</option>
														
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
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Contact number</th>
                                            <th>Expire Date</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($candidates as $cand)
                                         <tr>
											<td>{{ucfirst($cand->first_name)}} {{$cand->last_name}}</td>
											<td>{{$cand->email}}</td>
											<td>{{$cand->employerInfo->phone_number}}</td>
												<td><?php echo substr($cand->employerInfo->expire_ac,0,10 ); ?></td>
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
                                            <td><a class="btn btntheme" href="{{route('admin.editEmployer', $cand->id)}}">Edit</a>  <a class="btn btntheme" href="{{route('admin.detailsEmployer', $cand->id)}}">Detail</a>
                                              @if($cand->status != 'deactivate')
											   <a class="btn btn-danger" href="{{route("admin.changeUserStatus", $cand->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash-o"></i></a>
									            @endif
                                           
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