@extends('layouts.school')
@section('page_title','List of Sub Alert')
@section('page_name','Alert List')
@section('page_link',route("parentAlerts"))
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
                                    <div class="row" id="pr{{$parent->id}}">                                						
<div class="col-md-12"><b>Parent alert User name:</b> {{ucfirst($parent->user->firstname)}} {{$parent->user->lastname}}</div>
<div class="col-md-12"><b>Email Address:</b> {{$parent->user->email}}</div>
<div class="col-md-12"><b>Location:</b> {{$parent->location}}</div>
                                    </div>

                              </div>
                             <div class="col-md-12">
                                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered">
                                      <thead>
                                      <tr>
                                          <th>User Name</th>
										  <th>Email</th>
                                          <th>Title</th>
										  <th>Sub Title</th>
                                          <th>Lat & Lng</th>										  
                                          <th>Confirmed By</th>
                                      </tr>
                                      </thead>
                                      <tbody>

                                     @forelse($alerts as $cand)

                                         <tr>
                                            <td>{{ucfirst($cand->user->firstname)}} {{$cand->user->lastname}}</td>		
											<td>{{$cand->user->email}}</td>																						
                                            <td>{{$cand->title}}</td>
											<td>{{$cand->sub_title}}</td>
											<td>{{$cand->lat}}, {{$cand->lng}}</td>
											<td>@if($cand->confirmed_by) {{ucfirst($cand->confirmedBy->firstname)}} {{$cand->confirmedBy->lastname}} @else n/a @endif</td>
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