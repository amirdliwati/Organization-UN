<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    @yield('css') 

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

</head>

<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="container-fluid">
                        <div class="float-right">

                            <div class="dropdown d-inline-block d-lg-none ml-2">
                                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                                    <form class="p-3">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="dropdown d-none d-lg-inline-block ml-1">
                                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                    <i class="mdi mdi-fullscreen"></i>
                                </button>
                            </div>

                            <div class="dropdown d-inline-block">
                                <li class="list-inline-item">
                                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form2').submit();"><i class="mdi mdi-power text-danger"></i></a>
                                <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                </li>
                            </div>

                        </div>
                        <div>
                            <!-- LOGO -->
                            <div class="navbar-brand-box">
                                <a href="/" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="{{ asset('images/logo-sm.png') }}" alt="" height="50" width="80">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{ asset('images/logo-light.png') }}" alt="" height="60" width="100">
                                    </span>
                                </a>
                            </div>

                            <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn">
                                <i class="fa fa-fw fa-bars"></i>
                            </button>

                            <!-- App Search-->
                            <form class="app-search d-none d-lg-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="بحث ...">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </header> 

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div class="h-100">
        <div class="user-wid text-center py-4">
            <div class="user-img">
                @if(Auth::user()->role_id == 1)
                <img src="{{ asset('images/users/manager.png') }}" alt="" class="avatar-md mx-auto rounded-circle">
                @else
                 <img src="{{ asset('images/users/user.png') }}" alt="" class="avatar-md mx-auto rounded-circle">
                @endif
               
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">{{Auth::User()->name}}</a>
                @if(Auth::user()->role_id == 1)
                    <p class="text-body mt-1 mb-0 font-size-13"> المدير </p>
                @else
                    <p class="text-body mt-1 mb-0 font-size-13"> موظف   </p>
                @endif
                

            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title"> القائمة الرئيسية </li>
                    @if(Auth::user()->role_id == 1)
                        @include('layouts/nav/admin')
                    @else
                        @include('layouts/nav/user')
                    @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    @yield('page_title')
                    @yield('content')
                </div>
                <!-- End Page-content -->

                <footer class="footer text-center text-sm-left">
                        Copyright &copy; <script>document.write(new Date().getFullYear())</script> Fouadi System is Powered By <i class="mdi mdi-heart text-danger"></i> AMIR & Barakat <span class="text-muted d-none d-sm-inline-block float-right"><b>Version</b> 1.0.1</span>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

    @yield('javascript') 

    <script src="{{ asset('js/pages/dashboard.init.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>