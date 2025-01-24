<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
		@if(Auth::user()->checkRole("interviewer_manager"))
			{{-- interviewer_manager --}}
            @include("layouts.all.manager_int.partial.sidebar")
        @elseif(Auth::user()->checkRole("employer"))
		 {{-- employer --}}
            @include("layouts.all.crm.partial.asidebar")
		@endif
				
			</ul>		
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>