@extends('partials.chemin_nav')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
<script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="{{ asset('global_assets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/maps/echarts/world.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_charts/pages/dashboard_6/light/area_gradient.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_charts/pages/dashboard_6/light/map_europe_effect.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_charts/pages/dashboard_6/light/progress_sortable.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_charts/pages/dashboard_6/light/bars_grouped.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_charts/pages/dashboard_6/light/line_label_marks.js') }}"></script>
<!-- /theme JS files -->


</head>
<body>
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
					
    
</body>
</html>


































