<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('limitless/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/bootstrap_limitless.min.css') }} "
        rel="stylesheet" type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/layout.min.css') }} " rel="stylesheet"
        type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/components.min.css') }}  " rel="stylesheet"
        type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/colors.min.css') }}  " rel="stylesheet"
        type="text/css">
    <!-- /global stylesheets -->

    @stack('css')
    @livewireStyles

    @vite([])

    <!-- Core JS files -->
    <script src="{{ asset('limitless/global_assets/js/main/jquery.min.js') }} "></script>
    <script src="{{ asset('limitless/global_assets/js/main/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/loaders/blockui.min.js') }} "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('limitless/global_assets/js/plugins/visualization/d3/d3.min.js') }} "></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/styling/switchery.min.js') }} "></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/pickers/daterangepicker.js') }} "></script>

    <script src="{{ asset('limitless/layout_1/LTR/default/full/assets/js/app.js') }} "></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/dashboard.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

	<script src="assets/js/app.js"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/form_select2.js') }}"></script>
    <!-- /theme JS files -->

</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-light">
        <div class="navbar-brand">
            <a href="index.html" class="d-inline-block">
                <img src="limitless/global_assets/images/logo_light.png" alt="">

            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>

            <span class="navbar-text ml-md-3 mr-md-auto">

            </span>

            <ul class="navbar-nav">



                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="limitless/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle"
                            alt="">
                        <span>{{ auth()->user()->nama }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-light sidebar-main sidebar-expand-md"
            style="background-color: #e3e4f1;
background-image: linear-gradient(180deg,#ffffff 10%,#5d65da 100%);
background-size: cover;">

            <!-- Sidebar mobile toggler -->
            <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-main-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                Navigation
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>
            <!-- /sidebar mobile toggler -->


            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#"><img
                                        src="limitless/global_assets/images/placeholders/placeholder.jpg"
                                        width="38" height="38" class="rounded-circle" alt=""></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold">{{ auth()->user()->nama }}</div>
                            </div>

                            <div class="ml-3 align-self-center">
                                <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->


                @include('layouts.sidebar')

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-light">
                {{ $header ?? '' }}
            </div>
            <!-- /page header -->

            @yield('content')
            {{ $slot ?? '' }}

        </div>



    </div>
    <!-- /page content -->


    @livewireScripts
    @stack('js')

</body>

</html>
