@extends('layouts.all.crm')
@section('page_title','Students')
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
                                                    <label for="">Job Status</label>
                                                    <select id="job_status" name="job_status" class="form-control fsubmit">
													<option value="">All</option>
                                        <option value="open" @if('open' == Request::get('job_status')) selected @endif >Open</option>
										<option value="close" @if('close' == Request::get('job_status')) selected @endif >Close</option>
										<option value="pending" @if('pending' == Request::get('job_status')) selected @endif >Pending</option>
										
                                                    </select>
                                                </div>
                                    </div>
									<div class="col-md-3">
                                     <div class="form-group">
                                      <label for="">Language</label>
									   <select id="language" name="language" class="form-control fsubmit">
										@foreach($langs as $lan)
										 <option value="{{ $lan->id}}" @if($lan->id == Request::get('language')) selected @endif >{{ $lan->name}}</option>
										@endforeach		
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
										  <th>Email Address</th>
                                          <th>Status</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($users as $cand)
                                         <tr>                                           
                                            <td>{{ucfirst($cand->first_name)}} {{ $cand->last_name}}</td>
											<td>{{$cand->email}}</td>
                                            <td>{!! ucfirst($cand->status)!!}</td>
                                         </tr>
                                         @empty
                                         <tr>
                                          <td colspan="500"><h2 style="padding:20px ;text-align: center;">No record Found</h2></td>
                                         </tr>
                                        @endforelse

                                      </tbody>

                                  </table>

								  {{-- !! $users->appends(request()->except('page'))->links() !! --}}
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