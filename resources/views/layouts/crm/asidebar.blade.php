<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
		@if(Auth::user()->roles[0]->id == 4)
			{{-- school --}}
			<li class="sidebar-item {{ Request::url()==url('/school') ? 'selected' : '' }}"> <a class="sidebar-link waves-effect waves-dark sidebar-link active"  href="{{url("/school")}}" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Manage Students</span></a></li>
                <li class="sidebar-item {{ Request::url()==route('school.schoolParentAlerts') ? 'selected' : '' }}"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-bell"></i><span class="hide-menu">Alert System </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
					 <li class="sidebar-item {{ Request::url()==route('school.schoolParentAlerts') ? 'selected' : '' }}"><a href="{{route('school.schoolParentAlerts')}}" class="sidebar-link"><i class="fa fa-thumbs-o-up"></i><span class="hide-menu">Alerts </span></a></li>
                    </ul>
                </li>
				<li class="sidebar-item {{ Request::url()==url('/school/send-notification') ? 'selected' : '' }}"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-bell"></i><span class="hide-menu">Push Notifications </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
					  <li class="sidebar-item {{ Request::url()==route('school.sentNotification') ? 'selected' : '' }}"><a href="{{route('school.sentNotification') }}" class="sidebar-link"><i class="fa fa-thumbs-o-up"></i><span class="hide-menu">Notifications </span></a></li>
					  <li class="sidebar-item {{ Request::url()==url('/school/send-notification') ? 'selected' : '' }}"><a href="{{url('/school/send-notification')}}" class="sidebar-link"><i class="fa fa-thumbs-o-up"></i><span class="hide-menu">Send Notification </span></a></li>
                    </ul>
                </li>
        @elseif(Auth::user()->roles[0]->id == 2) 
		 {{-- employer --}}
                <li class="sidebar-item {{ Request::url()==url('/crm') ? 'selected' : '' }}"> <a class="sidebar-link has-arrow waves-effect sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Manage Jobs </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
					<li class="sidebar-item {{ Request::url()==route("employer.addJob") ? 'active' : '' }}"><a href="{{route("employer.addJob")}}" class="sidebar-link"><i class="fa fa-plus-circle"></i><span class="hide-menu"> Add Job</span></a></li>
                     <li class="sidebar-item {{ Request::url()==route('employer.jobListBy') ? 'selected' : '' }}"><a href="{{route('employer.jobListBy')}}" class="sidebar-link"><i class="fa fa-thumbs-o-up"></i><span class="hide-menu">Jobs </span></a></li>
                    </ul>
                </li>
                
               
                	
		@endif
				
				
			
				
			</ul>		
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>