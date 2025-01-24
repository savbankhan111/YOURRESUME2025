@extends('layouts.auth')
@section('page_title','Sent Notifications')
@section('content')

    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card notificationpage">
                    <div class="card-body">
                        <div class="align-items-center">

                          <div class="row">
                              <div class="col-md-12">
                                  @include("admin.partials.success_msg")
                              </div>
                             <div class="col-md-12">
                                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered">
                                      <thead>
                                      <tr>
										  <th>Subject</th>
                                          <th>Description</th>
                                          <th>Sent Date</th>										  
										  <th>Sender Type</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($alert_notification as $alnt)
                                         <tr>									
											<td>{{$alnt->header}}</td>											
                                            <td class="whitspceinhert">{{$alnt->description}}</td>
											<td>{{date('d-m-Y',strtotime($alnt->created_at))}}</td>											
										    <td>{{ucfirst($alnt->notification_type)}}</td>	
                                         </tr>
                                     @empty
                                         <tr>
                                         <td colspan="500"> <h2 style="padding:20px ;text-align: center;">empty! record not Found</h2>
                                         </td>
                                         </tr>
                                     @endforelse
                                       
                                      </tbody>

                                  </table>                               

                                      {!! $alert_notification->appends(request()->except('page'))->links() !!}
                                  </div>
                              </div>

                          </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
      </div>
@endsection