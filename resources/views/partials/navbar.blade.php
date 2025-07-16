
   <div class="navbar navbar-expand-xl navbar-light navbar-static px-0">
		<div class="d-flex flex-1 pl-3">
			<div class="navbar-brand wmin-0 mr-1" style="
    padding: 7px 0;
">
				<a href="index.html" class="d-inline-block">
					<img src="{{asset('images/LOGO_CMSS_ONEE_NEW-13.png')}}" class="d-none d-sm-block" alt="" style="width: 85px; height: auto;" class="d-none d-sm-block" alt="">
					
				</a>
			</div>
		</div>

		<div class="d-flex w-100 w-xl-auto overflow-auto overflow-xl-visible scrollbar-hidden border-top border-top-xl-0 order-1 order-xl-0">
    
		</div>

		<div class="d-flex flex-xl-1 justify-content-xl-end order-0 order-xl-1 pr-3">
            <ul class="navbar-nav navbar-nav-underline flex-row">
				
		
				<li class="nav-item nav-item-dropdown-xl dropdown dropdown-user h-100">
					<a href="{{ route('choix.espace') }}" class="navbar-nav-link navbar-nav-link-toggler d-flex align-items-center h-100 dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('images/profile.jpeg') }}" class="rounded-circle mr-xl-2" height="38" alt="">
						                   <span class="d-none d-xl-block"><div class="username">{{ Auth::user()->nom_complet }}</div></span>
					</a>
		
							
						
					<div class="dropdown-menu dropdown-menu-right">
    <a href="{{ route('profile.index') }}" class="dropdown-item">
        <i class="icon-user-plus"></i> Mon profil
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>


    <a href="#" class="dropdown-item"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="icon-switch2"></i> Déconnexion
    </a>
</div>

				</li>
			</ul>
			
			</div>
	</div>
					


































