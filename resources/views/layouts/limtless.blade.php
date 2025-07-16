<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'Application')</title>

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
	   <!-- Global stylesheets -->
    <link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('assets/demo/demo_configurator.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/sliders/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/ui/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/demo/pages/content_cards_header.js') }}"></script>
</head>

<body>


    <!-- Main navbar -->
       @include("partials.navbar")
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        {{-- <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg"> ... </div> --}}
        <!-- /main sidebar -->

        <!-- Main content -->
	 <!-- Main content -->
        <div class="content-wrapper">
            <!-- Inner content -->
            <div class="content-inner">

                {{-- Breadcrumb --}}
				@yield('breadcrumb')
               
				<div class="content">
					{{-- Contenu de la page --}}
								@yield('content')
				</div>
         

                <!-- Page header -->
                {{-- <div class="page-header page-header-light shadow"> ... </div> --}}
                <!-- /page header -->

                <!-- Content area -->
                {{-- <div class="content"> ... </div> --}}
                <!-- /content area -->

                <!-- Footer -->
                {{-- <div class="navbar navbar-sm navbar-footer border-top"> ... </div> --}}
                <!-- /footer -->

            </div>
            <!-- /inner content -->
        </div>
        <!-- /main content -->

        <!-- Right sidebar -->
        {{-- <div class="sidebar sidebar-light sidebar-end sidebar-expand-lg"> ... </div> --}}
        <!-- /right sidebar -->

    </div>
    <!-- /page content -->

    {{-- Scripts injectés par les vues --}}
    @stack('scripts')

</body>
</html>
