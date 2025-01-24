@extends('layouts.auth')
@section('page_title','Profile')
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid profilepagewrap">

        <div class="main-wrapper">
              <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
                <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
                <div class="auth-box">
                    <div>
                        <div class="text-center p-t-20 p-b-20">
                                @if(Auth::user()->image == null)
                            <span class="db"><img src="{{asset('public/images/RESUMELOGO.png')}}" alt="logo" style="width:250px;height:250px;"/></span>
                            @else
                            <span class="db"><img src="{{asset('public/images/'.Auth::user()->image)}}" alt="logo" style="width:250px;height:250px;"/></span>
                            @endif
                        </div>
                        @include('admin.partials.error_forms')
                        @include('admin.partials.error_msg')

                        <div class="card-body">
                        @include('admin.partials.success_msg')
						<form method="POST" action="{{ route('admin.updateProfile')}}" class="form-horizontal m-t-20" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PUT"> 
                        @csrf	   
                            <div class="row p-b-30">
                                <div class="col-12">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text " id="basic-addon1"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control form-control-lg" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" required>
                                    </div>
                                    
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="ti-gallery"></i></span>
                                        </div>
                                        <input type="file" name="image"  class="form-control form-control-lg" placeholder="profile" aria-label="pame" aria-describedby="basic-addon1" accept="image/*">
                                    </div>
                              
                                    <!-- email -->
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
                                        </div>
                                        <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" required>
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                        </div>
                                        <input type="text" name="oldpassword" class="form-control form-control-lg" placeholder="Old Password" aria-label="Password" aria-describedby="basic-addon1" >
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                        </div>
                                        <input type="text" name="newpassword" class="form-control form-control-lg" placeholder=" New Password" aria-label="Password" aria-describedby="basic-addon1" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="p-t-20">
                                            <button class="themebtnmain btn-block" type="submit">Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </form>
                        </div>
                    </div>
                </div>
                      </div>

        </div>
        <script>
            $('[data-toggle="tooltip"]').tooltip();
            $(".preloader").fadeOut();
        </script>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
@endsection