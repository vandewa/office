<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Informasi Perkantoran Elektronik | Kabupaten Wonosobo</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('limitless/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/bootstrap_limitless.min.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/layout.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/components.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('limitless/layout_1/LTR/default/full/assets/css/colors.min.css') }}" rel="stylesheet"
        type="text/css">
    <!-- /global stylesheets -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.0/viewer.min.css" rel="stylesheet">

    @stack('css')
    @livewireStyles
    @vite([])

    <!-- Core JS files -->
    <script src="{{ asset('limitless/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('limitless/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('limitless/layout_1/LTR/default/full/assets/js/app.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/dashboard.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/form_select2.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/editors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/editor_summernote.js') }}"></script>
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

        @can('sekre-staff')
            <!-- Main sidebar -->
            <div class="sidebar sidebar-light sidebar-main sidebar-expand-md"
                style="background-color: #e3e4f1; background-image: linear-gradient(180deg,#ffffff 10%,#5d65da 100%);
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
                                    <a href="#"><img src="limitless/global_assets/images/placeholders/placeholder.jpg"
                                            width="38" height="38" class="rounded-circle" alt=""></a>
                                </div>

                                <div class="media-body">
                                    <div class="media-title font-weight-semibold">
                                        {{ auth()->user()->nama }} <br>
                                    </div>
                                    <div class="media-title font-weight-normal">
                                        @php
                                            $skpdData = json_decode(auth()->user()->skpd, true);
                                            $skpd = isset($skpdData['skpd']) ? $skpdData['skpd'] : '';
                                        @endphp
                                        <div class="media-title font-weight-normal">
                                            @can('sekretariat')
                                                <span> Sekretariat {{ $skpd }}</span>
                                            @elsecan('kepala_dinas')
                                                <span> Kepala Dinas {{ $skpd }}</span>
                                            @elsecan('kepala_bidang')
                                                <span> kepala Bidang {{ $skpd }}</span>
                                            @elsecan('staff')
                                                <span> Staff {{ $skpd }}</span>
                                            @endcan
                                        </div>
                                    </div>
                                    {{-- <sp>{{ $skpd }}</sp<an> --}}

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
        @elsecan('staff')
            <!-- Main sidebar -->
            <div class="sidebar sidebar-light sidebar-main sidebar-expand-md"
                style="background-color: #e3e4f1; background-image: linear-gradient(180deg,#ffffff 10%,#d8da5d 100%);
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
                                    <div class="media-title font-weight-semibold">
                                        {{ auth()->user()->nama }} <br>
                                    </div>
                                    <div class="media-title font-weight-normal">
                                        @php
                                            $skpdData = json_decode(auth()->user()->skpd, true);
                                            $skpd = isset($skpdData['skpd']) ? $skpdData['skpd'] : '';
                                        @endphp
                                        <div class="media-title font-weight-normal">
                                            @can('sekretariat')
                                                <span> Sekretariat {{ $skpd }}</span>
                                            @elsecan('kepala_dinas')
                                                <span> Kepala Dinas {{ $skpd }}</span>
                                            @elsecan('kepala_bidang')
                                                <span> kepala Bidang {{ $skpd }}</span>
                                            @elsecan('staff')
                                                <span> Staff {{ $skpd }}</span>
                                            @endcan
                                        </div>
                                    </div>

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

            </div>\
            <!-- /main sidebar -->
        @elsecan('kabid-sekre')
            <!-- Main sidebar -->
            <div class="sidebar sidebar-light sidebar-main sidebar-expand-md"
                style="background-color: #e3e4f1; background-image: linear-gradient(180deg,#ffffff 10%,#5d65da 100%);
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
                                    <div class="media-title font-weight-semibold">
                                        {{ auth()->user()->nama }} <br>
                                    </div>
                                    <div class="media-title font-weight-normal">
                                        @php
                                            $skpdData = json_decode(auth()->user()->skpd, true);
                                            $skpd = isset($skpdData['skpd']) ? $skpdData['skpd'] : '';
                                        @endphp
                                        <div class="media-title font-weight-normal">
                                            @can('sekretariat')
                                                <span> Sekretariat {{ $skpd }}</span>
                                            @elsecan('kepala_dinas')
                                                <span> Kepala Dinas {{ $skpd }}</span>
                                            @elsecan('kepala_bidang')
                                                <span> kepala Bidang {{ $skpd }}</span>
                                            @elsecan('staff')
                                                <span> Staff {{ $skpd }}</span>
                                            @endcan
                                        </div>
                                    </div>

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
        @elsecan('kepala_dinas')
            <!-- Main sidebar -->
            <div class="sidebar sidebar-light sidebar-main sidebar-expand-md"
                style="background-color: #e3e4f1; background-image: linear-gradient(180deg,#ffffff 10%,#8bda5d 100%);
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
                                    <div class="media-title font-weight-semibold">
                                        {{ auth()->user()->nama }} <br>
                                    </div>
                                    <div class="media-title font-weight-normal">
                                        @php
                                            $skpdData = json_decode(auth()->user()->skpd, true);
                                            $skpd = isset($skpdData['skpd']) ? $skpdData['skpd'] : '';
                                        @endphp
                                        <div class="media-title font-weight-normal">
                                            @can('sekretariat')
                                                <span> Sekretariat {{ $skpd }}</span>
                                            @elsecan('kepala_dinas')
                                                <span> Kepala Dinas {{ $skpd }}</span>
                                            @elsecan('kepala_bidang')
                                                <span> kepala Bidang {{ $skpd }}</span>
                                            @elsecan('staff')
                                                <span> Staff {{ $skpd }}</span>
                                            @endcan
                                        </div>
                                    </div>

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
        @elsecan('kepala_bidang')
            <!-- Main sidebar -->
            <div class="sidebar sidebar-light sidebar-main sidebar-expand-md"
                style="background-color: #e3e4f1; background-image: linear-gradient(180deg,#ffffff 10%,#da6e5d 100%);
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
                                    <div class="media-title font-weight-semibold">
                                        {{ auth()->user()->nama }} <br>
                                    </div>
                                    <div class="media-title font-weight-normal">
                                        @php
                                            $skpdData = json_decode(auth()->user()->skpd, true);
                                            $skpd = isset($skpdData['skpd']) ? $skpdData['skpd'] : '';
                                        @endphp
                                        <div class="media-title font-weight-normal">
                                            @can('sekretariat')
                                                <span> Sekretariat {{ $skpd }}</span>
                                            @elsecan('kepala_dinas')
                                                <span> Kepala Dinas {{ $skpd }}</span>
                                            @elsecan('kepala_bidang')
                                                <span> kepala Bidang {{ $skpd }}</span>
                                            @elsecan('staff')
                                                <span> Staff {{ $skpd }}</span>
                                            @endcan
                                        </div>
                                    </div>

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
        @endcan



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
    <!-- Additional JS files -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.0/viewer.min.js"></script>

    <!-- Your custom JS -->
    <script>
        // Your custom JavaScript here
    </script>
</body>

</html>
