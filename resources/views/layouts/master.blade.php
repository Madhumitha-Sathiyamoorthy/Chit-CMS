<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="colored">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">

                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <!-- <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{asset('assets/images/logo-sm-dark.png')}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="24">
                            </span>
                        </a> -->

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{asset('assets/images/logo-sm-light.png')}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="24">
                            </span>
                        </a>
                    </div>

                    <!-- Menu Icon -->

                    <button type="button" class="btn px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>


                    <div class="dropdown d-none d-lg-inline-block align-self-center">
                        <button class="btn btn-header waves-effect  dropdown-toggle" type="button" id="createNewDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Create New<i class="mdi mdi-chevron-down ms-2"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="createNewDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

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


                    <!-- App Search -->
                    <!-- <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control border-0" placeholder="Search...">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form> -->

                    <!-- <form class="app-search d-none d-lg-block" autocomplete="off">
                        <div class="position-relative autocomplete">
                            <input type="text" class="form-control border-0" placeholder="Search...">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form> -->
                    <form autocomplete="off" class="app-search d-none d-lg-block">
                        <div class="position-relative autocomplete">
                            <input class="form-control border-0" id="searchList" placeholder="Search..." type="text" name="myCountry" placeholder="Country">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>


                    <!-- Notification Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-bell"></i>
                            <span class="badge bg-info rounded-pill">3</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                            <h5 class="p-3 text-dark mb-0">Notifications (37)</h5>
                            <div data-simplebar style="max-height: 230px;">
                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex mt-3">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-success rounded-circle font-size-16">
                                                <i class="mdi mdi-cart"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">Your order is placed</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">If several languages coalesce the grammar
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex mt-3">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-warning rounded-circle font-size-16">
                                                <i class="mdi mdi-message"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">New Massage received</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">You have 87 unread message
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex mt-3">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-info rounded-circle font-size-16">
                                                <i class="mdi mdi-flag"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">Your item is shipped</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">If several languages coalesce the grammar
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex mt-3">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="mdi mdi-cart"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">Your Order is placed</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">It will seem like simplified English
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex mt-3">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-danger rounded-circle font-size-16">
                                                <i class="mdi mdi-message"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">New Massage received</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">You have 87 unread message
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="p-2 d-grid">
                                <a class="font-size-14 text-center" href="javascript:void(0)">View all</a>
                            </div>
                        </div>
                    </div>

                    <!-- User -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/avatar-4.jpg')}}" alt="Header Avatar">
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle font-size-16 align-middle me-2 text-muted"></i>
                                <span>Hi {{Auth::user()->name}} !</span></a>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-wallet font-size-16 align-middle text-muted me-2"></i>
                                <span>My Wallet</span></a>
                            <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="mdi mdi-wrench font-size-16 align-middle text-muted me-2"></i>
                                <span>Settings</span></a>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline font-size-16 text-muted align-middle me-2"></i>
                                <span>Lock screen</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-primary" href="/logout"><i class="mdi mdi-power font-size-16 align-middle me-2 text-primary"></i>
                                <span>Logout</span></a>
                        </div>
                    </div>

                    <!-- Setting -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="mdi mdi-cog bx-spin"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">
                <div class="user-details">
                    <div class="d-flex">
                        <div class="me-2">
                            <img src="{{asset('assets/images/users/avatar-4.jpg')}}" alt="" class="avatar-md rounded-circle">
                        </div>
                        <div class="user-info w-100">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Donald Johnson
                                    <i class="mdi mdi-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)" class="dropdown-item"><i class="mdi mdi-account-circle text-muted me-2"></i>
                                            {{Auth::user()->name}}
                                            <div class="ripple-wrapper me-2"></div>
                                        </a></li>
                                    <li><a href="javascript:void(0)" class="dropdown-item"><i class="mdi mdi-cog text-muted me-2"></i>
                                            Settings</a></li>
                                    <li><a href="javascript:void(0)" class="dropdown-item"><i class="mdi mdi-lock-open-outline text-muted me-2"></i>
                                            Lock screen</a></li>
                                    <li><a href="/logout" class="dropdown-item"><i class="mdi mdi-power text-muted me-2"></i>
                                            Logout</a></li>
                                </ul>
                            </div>

                            <p class="text-white-50 m-0">Administrator</p>
                        </div>
                    </div>
                </div>


                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-table-settings"></i>
                                <span>Chits</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/chitDetails">Chit Details</a></li>
                                @if(auth()->user()->role == 1)
                                <li><a href="/createChitCustomer">Create Chit</a></li>
                                <li><a href="{{url('auctionChit')}}">Auction Chit</a></li>
                                <li><a href="{{url('socialPost')}}">Social Post</a></li>
                                <li><a href="{{url('createChitBlog')}}">Chit Blog</a></li>
                                <li><a href="{{url('howItWorks')}}">How it works</a></li>
                                @endif
                            </ul>
                        </li>
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
            <!-- End Page-content -->
            @yield('content')
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            Copywrite @ Madhu <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title px-3 py-4">
                <a href="javascript:void(0);" class="right-bar-toggle float-end">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
                <h5 class="m-0">Settings</h5>
            </div>

            <!-- Settings -->
            <hr class="" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="{{asset('assets/images/layouts/layout-1.png')}}" class="img-fluid img-thumbnail" alt="">
                </div>

                <div class="form-check form-switch mb-3">
                    <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="{{asset('assets/images/layouts/layout-2.png')}}" class="img-fluid img-thumbnail" alt="">
                </div>

                <div class="form-check form-switch mb-3">
                    <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="{{asset('assets/css/bootstrap-dark.min.css')}}" data-appStyle="{{asset('assets/css/app-dark.min.css')}}" />
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="{{asset('assets/images/layouts/layout-3.png')}}" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="form-check form-switch mb-5">
                    <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="{{asset('assets/css/app-rtl.min.css')}}" />
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>

                <h6 class="mb-2">Select Custom Colors</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode" id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                    <label class="form-check-label" for="theme-default">Default</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode" id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                    <label class="form-check-label" for="theme-red">Red</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode" id="theme-green" value="green" onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                    <label class="form-check-label" for="theme-green">Green</label>
                </div>
            </div>

        </div>
        <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/js/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/js/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/js/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Peity JS -->
    <script src="{{asset('assets/js/libs/peity/jquery.peity.min.js')}}"></script>

    <script src="{{asset('assets/js/libs/morris.js/morris.min.js')}}"></script>

    <script src="{{asset('assets/js/libs/raphael/raphael.min.js')}}"></script>
    @yield('script')
    <!-- App js -->
    <script src="{{asset('assets/js/app.js')}}"></script>

</body>