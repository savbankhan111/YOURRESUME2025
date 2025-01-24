@extends('layouts.school')
@section('page_title','List of Users')
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
                                          <th>Image</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Status</th>
                                          <th>Email Verified</th>
                                          <th>Registration date </th>
                                          <th>Action</th>


                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($candidates as $cand)



                                         <tr>
                                             <td>
											 @if($cand->image)
											  <img width="100" height="100" src="{{url('public/uploads/profile/'.$cand->image)}}" alt="">
											 @else
											  <img width="100" height="100" src="{{url('public/images/user-default.png')}}" alt="">
											 @endif
											 </td>

                                             <td>{{ucfirst($cand->user->firstname)}} {{$cand->user->lastname}}</td>

                                             <td>{{$cand->user->email}}</td>

                                                 <td>
											<form method="POST" action="{{ route('changeUserStatus',$cand->user->id)}}" accept-charset="UTF-8">
											 @csrf
                                                 <select  name="status" id="status" onchange="this.form.submit()">

                                                      <option value="active" {{$cand->user->status== 'active'? "selected":""}} >Activate</option>
                                                        <option value="deactivate" {{$cand->user->status== 'deactivate'? "selected":""}}>Deactivate</option>


                                                 </select>

													 </form>

                                             </td>
                                             <td> @if($cand->user->email_verified_at==NULL) No @elseif($cand->user->email_verified_at!=Null) Yes @endif</td>
										     <td>{{date('d-m-Y', strtotime($cand->user->created_at))}}</td>

                                             <td>
											  <a class="btn btntheme" href="{{route("userDetails", $cand->user->id)}}">Details</a>
											  <a class="btn btntheme" href="{{route("editUser", $cand->user->id)}}">Edit</a>
												  {{-- <a class="btn btntheme" href="{{route("userDelete", $cand->user->id)}}" onclick="return confirm('Are you sure?')">Delete</a> --}}
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
    <script>
        $(document).ready(function(){
            $('.fsubmit').change(function() {
                this.form.submit();
            });
        });
    </script>
@endsection