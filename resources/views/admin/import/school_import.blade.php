@extends('layouts.auth')
@section('page_title',"School/College Import")
@section('content')

     <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">

                          <div class="">

                              @include("admin.partials.error_forms")
                              @include("admin.partials.success_msg")
							  
							  @if ($total_data = Session::get('total_data'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Total: {{ $total_data }}</strong>
										 @if ($total_import = Session::get('total_import'))
										<strong>Completed: {{ $total_import }}</strong>	 
										@else
											<strong>Completed: 0</strong>	
										 @endif
									</div>
								@endif	
                                 
<form method="POST" action="{{ route('admin.putImportSchool')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT">
                        @csrf	
                                  
						<div class="row">
						<div class="col-md-12">
                            <div class="form-group">
							    <label for="">Import CSV FIle</label>
                                <input value="" type="file" name="csv_file" class="form-control" accept=".csv" required />
								
								<h5><i>For sample file <a href="{{url('/uploads/csv/college_import-sample.csv')}}">click here</a></i></h5>
                            </div>
                        </div>
                         <div class="col-md-12">
                             <div class="form-group">
							      <button class="themebtnmain">Import</button>
                             </div>
                         </div>
                        </div>
                      </form>


                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection