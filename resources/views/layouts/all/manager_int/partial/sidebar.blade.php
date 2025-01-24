  <li class="sidebar-item {{ Request::url()==url('/interviewsdata') ? 'selected' : '' }}">
        	<a href="{{url('/interviewsdata')}}" class="sidebar-link">
        		 <img src="{{ asset('images/menu5.png')}}" alt="" class="menu-icom"/> <span class="hide-menu">Dashboard </span></a>
        	</li>
<li class="sidebar-item {{ (Request::url()==url('/interviewsdata') || Request::url()==url('/interviewsdata')) ? 'selected' : '' }}"> 
	<a class="sidebar-link waves-effect has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
		 <img src="{{ asset('images/menu4.png')}}" alt="" class="menu-icom"/> <span class="hide-menu">Manage Interview </span>
	</a>
    <ul aria-expanded="false" class="collapse  first-level">
      
      <li class="sidebar-item {{ Request::url()==url('/interviews') ? 'selected' : '' }}">
      	<a href="{{url('/interviews')}}" class="sidebar-link">
      		 <img src="{{ asset('images/menu1.png')}}" alt="" class="menu-icom"/> <span class="hide-menu">Interview Slots </span></a>
      	</li>
	
	<li class="sidebar-item {{ Request::url().'?status='.Request::input('status')==url('/interview-list?status=done') ? 'selected' : '' }}">
		<a href="{{url('/interview-list?status=done')}}" class="sidebar-link">
			 <img src="{{ asset('images/menu3.png')}}" alt="" class="menu-icom"/> <span class="hide-menu">Completed Interviews </span></a>
		</li>

   <li class="sidebar-item {{ Request::url().'?status='.Request::input('status')==url('/interview-list?status=pending') ? 'selected' : '' }}">
   	<a href="{{url('/interview-list?status=pending')}}" class="sidebar-link">
   		 <img src="{{ asset('images/menu2.png')}}" alt="" class="menu-icom"/> <span class="hide-menu">Pending Interviews </span></a>
   	</li>
   
   </ul>
</li>
