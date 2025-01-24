<!-- ============================================================== -->
<aside class="left-sidebar admin-sidebar" data-sidebarbg="skin5">
   <!-- Sidebar scroll-->
   <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
         <ul id="sidebarnav" class="p-t-30">
            <li class="sidebar-item {{ Request::url()==route("admin.dashboard") ? 'active' : '' }}"> <a class="sidebar-link waves-effect waves-dark sidebar-link "  href="{{url("admin/dashboard")}}" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
          
            <li class="sidebar-item {{ Request::url()==route("admin.userListBy","student") ? 'active' : '' }}"> <a class="sidebar-link waves-effect waves-dark sidebar-link " href="{{route('admin.userListBy','student')}}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu"> List of Students </span></a></li>
            <li class="sidebar-item {{ Request::url()==route("admin.userListBy","non-student") ? 'active' : '' }}"> <a class="sidebar-link waves-effect waves-dark sidebar-link " href="{{route('admin.userListBy','non-student')}}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">List of Non College Students </span></a></li>
            <li class="sidebar-item {{ Request::url()==route("admin.userListBy","professional") ? 'active' : '' }}"> <a class="sidebar-link waves-effect waves-dark sidebar-link " href="{{route('admin.userListBy','professional')}}" aria-expanded="false"><i class="fa fa-building"></i><span class="hide-menu"> Professionals</span></a></li>
            <li class="sidebar-item {{ (Request::url()==route("admin.schoolListBy") || Request::url() == route('admin.sendMailMess')) ? 'selected' : '' }}">
               <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                   <i class="fa fa-graduation-cap"></i><span class="hide-menu">Schools/College </span>
               </a>
               <ul aria-expanded="false" class="collapse first-level">
                   <li class="sidebar-item {{ Request::url()==route("admin.addSchool") ? 'selected' : '' }}">
                       <a href="{{route("admin.addSchool")}}" class="sidebar-link">
                           <i class="fas fa-school"></i><span class="hide-menu"> School/College Add </span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::url()==route("admin.addNonSchool") ? 'selected' : '' }}">
                       <a href="{{route("admin.addNonSchool")}}" class="sidebar-link">
                           <i class="fas fa-school"></i><span class="hide-menu"> Non School/College Add </span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::url()==route("admin.importSchool") ? 'selected' : '' }}">
                       <a href="{{route('admin.importSchool')}}" class="sidebar-link">
                           <i class="fa fa-download"></i><span class="hide-menu"> School/College Import </span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::url()==route("admin.schoolListBy") ? 'selected' : '' }}">
                     <a href="{{route('admin.schoolListBy')}}" class="sidebar-link">
                         <i class="fa fa-list"></i><span class="hide-menu"> List of School/College </span>
                     </a>
                 </li>
               
                 <li class="sidebar-item {{ Request::url()==route("admin.nonSchoolListBy") ? 'selected' : '' }}">
                  <a href="{{route('admin.nonSchoolListBy')}}" class="sidebar-link">
                      <i class="fa fa-list"></i><span class="hide-menu">List of Non School/College</span>
                  </a>
              </li>
            
               </ul>
           </li>
           
           

           
      
            <li class="sidebar-item {{ Request::url()==route("admin.managerListBy") ? 'selected' : '' }}">
               
               <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                   <i class="fa fa-user-md"></i><span class="hide-menu">Recruitment Managers </span>
               </a>
               <ul aria-expanded="false" class="collapse first-level">
                   <li class="sidebar-item {{ Request::url()==route("admin.addManager") ? 'selected' : '' }}">
                       <a href="{{route("admin.addManager")}}" class="sidebar-link">
                           <i class="fa fa-plus-circle"></i><span class="hide-menu"> Add Manager </span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::get('status') == 'active' ? 'selected' : '' }}">
                       <a href="{{route("admin.managerListBy", "status=active")}}" class="sidebar-link">
                           <i class="fa fa-thumbs-o-up"></i><span class="hide-menu"> Active </span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::get('status') == 'deactivate' ? 'selected' : '' }}">
                       <a href="{{route("admin.managerListBy", "status=deactivate")}}" class="sidebar-link">
                           <i class="fa fa-clock-o"></i><span class="hide-menu"> Deactivate </span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::get('status') == 'suspend' ? 'selected' : '' }}">
                       <a href="{{route("admin.managerListBy", "status=suspend")}}" class="sidebar-link">
                           <i class="fa fa-close"></i><span class="hide-menu"> Suspend </span>
                       </a>
                   </li>  
               </ul>
           </li>

           
           
            {{-- <li class="sidebar-item {{ Request::url()==route("admin.employerListBy") ? 'selected' : '' }}">
               <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                   <i class="fa fa-address-book"></i><span class="hide-menu">Employers </span>
               </a>
               <ul aria-expanded="false" class="collapse first-level">
                  
                   <li class="sidebar-item {{ Request::url()==route("admin.addEmployer") ? 'selected' : '' }}">
                       <a href="{{route("admin.addEmployer")}}" class="sidebar-link">
                           <i class="fa fa-plus-circle"></i><span class="hide-menu"> Add Employer</span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::url()==route("admin.employerListBy") ? 'selected' : '' }}">
                       <a href="{{route("admin.employerListBy")}}" class="sidebar-link">
                           <i class="fas fa-id-badge"></i><span class="hide-menu">Active Employers</span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::url()==route("admin.employerListBy") ? 'selected' : '' }}">
                     <a href="{{route("admin.employerListBy", "status=deactivate")}}" class="sidebar-link">
                         <i class="fas fa-id-badge"></i><span class="hide-menu">Deactive Employers</span>
                     </a>
                 </li><li class="sidebar-item {{ Request::url()==route("admin.employerListBy") ? 'selected' : '' }}">
                  <a href="{{route("admin.employerListBy")}}" class="sidebar-link">
                      <i class="fas fa-id-badge"></i><span class="hide-menu">Total Pending Employers</span>
                  </a>
              </li> 
               </ul>
           </li> --}}
           
           <li class="sidebar-item {{ Request::url() == route('admin.employerListBy', ['status' => 'active']) ? 'selected' : '' }}">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="fa fa-address-book"></i><span class="hide-menu">Employers</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item {{ Request::url() == route('admin.addEmployer') ? 'selected' : '' }}">
                    <a href="{{ route('admin.addEmployer') }}" class="sidebar-link">
                        <i class="fa fa-plus-circle"></i><span class="hide-menu"> Add Employer</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::url() == route('admin.employerListBy') ? 'selected' : '' }}">
                  <a href="{{ route('admin.employerListBy') }}" class="sidebar-link">
                      <i class="fas fa-id-badge"></i><span class="hide-menu"> Employers</span>
                  </a>
              </li>
                <li class="sidebar-item {{ Request::url() == route('admin.employerListBy', ['status' => 'active']) ? 'selected' : '' }}">
                    <a href="{{ route('admin.employerListBy', ['status' => 'active']) }}" class="sidebar-link">
                        <i class="fas fa-id-badge"></i><span class="hide-menu">Active Employers</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::url() == route('admin.employerListBy', ['status' => 'deactivate']) ? 'selected' : '' }}">
                    <a href="{{ route('admin.employerListBy', ['status' => 'deactivate']) }}" class="sidebar-link">
                        <i class="fas fa-id-badge"></i><span class="hide-menu">Deactivated Employers</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::url() == route('admin.employerListBy', ['status' => 'suspend']) ? 'selected' : '' }}">
                    <a href="{{ route('admin.employerListBy', ['status' => 'suspend']) }}" class="sidebar-link">
                        <i class="fas fa-id-badge"></i><span class="hide-menu">Suspended Employers</span>
                    </a>
                </li>
            
            </ul>
         </li>
         
            {{-- <li class="sidebar-item {{ Request::url()==route('admin.plans') ? 'selected' : '' }}">
               <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                   <i class="fa fa-file"></i><span class="hide-menu">Plans </span>
               </a>
               <ul aria-expanded="false" class="collapse first-level">
                   <li class="sidebar-item {{ Request::url()==route('admin.addPlan') ? 'selected' : '' }}">
                       <a href="{{route('admin.addPlan')}}" class="sidebar-link">
                           <i class="fa fa-plus-circle"></i><span class="hide-menu"> Add Plan</span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::url()==route('admin.plans') ? 'selected' : '' }}">
                       <a href="{{route('admin.plans')}}" class="sidebar-link">
                           <i class="fa fa-money"></i><span class="hide-menu"> Plans</span>
                       </a>
                   </li> 
               </ul>
           </li>
            --}}

            <li class="sidebar-item {{ Request::url() == route('admin.plans') ? 'selected' : '' }}">
               <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                   <i class="fa fa-file"></i><span class="hide-menu">Plans</span>
               </a>
               <ul aria-expanded="false" class="collapse first-level">
                   <li class="sidebar-item {{ Request::url() == route('admin.addPlan') ? 'selected' : '' }}">
                       <a href="{{ route('admin.addPlan') }}" class="sidebar-link">
                           <i class="fa fa-plus-circle"></i><span class="hide-menu"> Add Plan</span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ Request::url() == route('admin.plans') ? 'selected' : '' }}">
                       <a href="{{ route('admin.plans') }}" class="sidebar-link">
                           <i class="fa fa-money"></i><span class="hide-menu"> All Plans</span>
                       </a>
                   </li> 
                   <li class="sidebar-item {{ Request::url() == route('admin.plans', ['status' => 'active']) ? 'selected' : '' }}">
                       <a href="{{ route('admin.plans', ['status' => 'active']) }}" class="sidebar-link">
                           <i class="fa fa-check-circle"></i><span class="hide-menu"> Active Plans</span>
                       </a>
                   </li> 
                   <li class="sidebar-item {{ Request::url() == route('admin.plans', ['status' => 'deactivate']) ? 'selected' : '' }}">
                       <a href="{{ route('admin.plans', ['status' => 'deactivate']) }}" class="sidebar-link">
                           <i class="fa fa-times-circle"></i><span class="hide-menu"> Deactivated Plans</span>
                       </a>
                   </li>
               </ul>
            </li>
            

          
            <li class="sidebar-item {{ Request::url()==url('/admin/send-notification') ? 'selected' : '' }}">
               <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-bell"></i><span class="hide-menu">Push Notifications </span></a>
               <ul aria-expanded="false" class="collapse  first-level">
                  <li class="sidebar-item {{ Request::url()==route('admin.sentNotification') ? 'selected' : '' }}"><a href="{{route('admin.sentNotification') }}" class="sidebar-link"><i class="fa fa-thumbs-o-up"></i><span class="hide-menu">Sent Notifications </span></a></li>
                  <li class="sidebar-item {{ Request::url()==url('/admin/send-notification') ? 'selected' : '' }}"><a href="{{url('/admin/send-notification')}}" class="sidebar-link"><i class="fa fa-thumbs-o-up"></i><span class="hide-menu">Notification</span></a></li>
               </ul>
            </li>
         </ul>
      </nav>
      <!-- End Sidebar navigation -->
   </div>
   <!-- End Sidebar scroll-->
</aside>

