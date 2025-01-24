<li class="sidebar-item {{ Request::url()==url('/crm') ? 'selected' : '' }}">
        	<a href="{{url('/crm')}}" class="sidebar-link">
        		 <img src="{{ asset('images/menu5.png')}}" alt="" class="menu-icom"/> <span class="hide-menu">Dashboard </span></a>
        	</li>
<li class="sidebar-item {{ Request::url()==url('/crm') ? 'selected' : '' }}"> <a class="sidebar-link has-arrow waves-effect sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Manage Jobs </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
        <li class="sidebar-item {{ Request::url()==route("employer.addJob") ? 'selected' : '' }}"><a href="{{route("employer.addJob")}}" class="sidebar-link"><i class="fa fa-plus-circle"></i><span class="hide-menu"> Add Job</span></a></li>
        <li class="sidebar-item {{ Request::url()==route('employer.jobListBy') ? 'selected' : '' }}"><a href="{{route('employer.jobListBy')}}" class="sidebar-link"><i class="fa fa-thumbs-o-up"></i><span class="hide-menu">Jobs </span></a></li>
    </ul>
</li>
<li class="sidebar-item {{ Request::url()==url('/crm/projects') ? 'selected' : '' }}"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Manage Projects </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
        <li class="sidebar-item {{ Request::url()==route('employer.addProject') ? 'selected' : '' }}"><a href="{{route('employer.addProject')}}" class="sidebar-link"><i class="fa fa-plus-circle"></i><span class="hide-menu"> Add Project</span></a></li>
        <li class="sidebar-item {{ Request::url()==route('employer.projectListBy') ? 'selected' : '' }}"><a href="{{route('employer.projectListBy')}}" class="sidebar-link"><i class="fa fa-thumbs-o-up"></i><span class="hide-menu">Projects </span></a></li>
    </ul>
</li>