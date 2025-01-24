@extends('layouts.all.crm')
@section('page_title','Project Members')
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
										  <th>Email</th>
										  <th>Contact No.</th>
                                          <th>Status</th>
										  <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($project_members as $cand)
                                         <tr>                                           
                                            <td>{{ucfirst($cand->user->first_name)}} {{ucfirst($cand->user->last_name)}}</td>
											<td>{{$cand->user->email}}</td>
                                            <td>{{$cand->user->userInfo->contact_no}}</td>
                                            <td>{{ ucfirst($cand->user->status)}}</td>
											<td>
											  <a class="btn btntheme" href="{{route('employer.pmRemove', [$cand->project_id,$cand->id])}}" onclick="return confirm('Are you sure?')">Remove</a>
											</td>
                                         </tr>
                                         @empty
                                         <tr>
                                          <td colspan="500"> <h2 style="padding:20px ;text-align: center;">empty! Record not found</h2></td>
                                         </tr>
                                        @endforelse

                                      </tbody>

                                  </table>

                                      {!! $project_members->appends(request()->except('page'))->links()!!}
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