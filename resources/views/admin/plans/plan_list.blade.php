@extends('layouts.auth')
@section('page_title','List of Plans')
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
										  <th>Plan Type</th>
                                          <th>Interview Limit</th>
                                          <th>Day Limit</th>
										  <th>Cost</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($plans as $plan)

                                         <tr>
											 <td>{{ucfirst($plan->plan_name)}}</td>
                                             <td>{{ucfirst($plan->plan_type)}}</td>
											 <td>{{$plan->interview_count}}</td>
											 <td>{{ucfirst($plan->day_limit)}}</td>
											 <td>${{$plan->price}}</td>
                                             <td>{{$plan->status== '1'? "Active":"Deactivate"}}</td>
                                             <td><a class="btn btntheme" href="{{route("admin.editPlan", $plan->id)}}">Edit</a>
                                             <a class="btn btntheme" href="{{route("admin.detailsPlan", $plan->id)}}">Details</a>
                                              @if($plan->status != '0')
											   <a class="btn btn-danger" href="{{route("admin.updateStatusPlan", $plan->id)}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-times"></i></a>
									            @endif
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
                                      {!! $plans->appends(request()->except('page'))->links() !!}
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