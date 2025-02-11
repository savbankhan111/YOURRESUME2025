
<header class="topbar admin-header" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
       
        <div class="navbar-header" data-logobg="skin5">
            
             
            
            
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{route("admin.dashboard")}}">
                <!-- Logo icon -->
                <b class="logo-icon p-l-10 sk">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('images/RESUMELOGO.png')}}" alt="homepage" class="light-logo" height="70px" style="width:170px"/>

                </b>
                
                <!--End Logo icon -->
                <!-- Logo icon -->
                <!-- <b class="logo-icon"> -->
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
            <!-- <img src="{{ asset('images/logo-text.png')}}" alt="homepage" class="light-logo" /> -->

                <!-- </b> -->
                <!--End Logo icon -->
            </a>
            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav ml-auto">


                <!-- ============================================================== -->
                <li class="nav-item dropdown profile-menu">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->first_name}}
					@if(empty(Auth::user()->image))
					<img src="{{ asset('images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31">
					@else 
					<img src="{{ asset('public/images/'.Auth::user()->image)}}" alt="user" class="rounded-circle" width="31">					
					@endif
					</a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        @if(Auth::user()->checkRole("interviewer_manager"))
                            {{-- manager --}}                           
                            @include("layouts.all.manager_int.partial.header")

                        @elseif(Auth::user()->checkRole("employer"))
						 {{-- emp --}}
						  @include("layouts.all.crm.partial.header")

						@endif
                        <div class="dropdown-divider"></div>

                        <form id="logout-form" action="{{ url("/logout")}}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <a class="dropdown-item" href=""
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i>
                           Logout</a>



                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>


<!-- Modal -->
@auth

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="exampleModalLabel" >



                    <form id="mydiv" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }} " id="name" placeholder="Enter Name">
                            {{--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }} " id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            {{--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Password</label>
                            <input type="password" class="form-control" id="old_password" placeholder="Enter Old Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter New Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">New Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" placeholder="Enter New Password">
                        </div>

                        <input name="userimage" type="file" class="form-control" />

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="submitbtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endauth