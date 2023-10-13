<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
<link href="{{ asset( 'admin/css/font-face.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

{{-- bootstrap css --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<!-- Bootstrap CSS-->
<link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

<!-- Vendor CSS-->
<link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{ route('category-list') }}">
                                <i class="fas fa-chart-bar"></i>Categories</a>
                        </li>
                    </ul>
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{ route('product-list') }}">
                                <i class="fa-solid fa-clipboard-list"></i>Products</a>
                        </li>
                    </ul>
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{ route('order-list') }}">
                                <i class="fa-solid fa-list"></i>Order List</a>
                        </li>
                    </ul>
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{ route('admin-userMessagePage') }}">
                                <i class="fa-solid fa-envelope"></i>User Messages</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <h4>Admin Dashboard</h4>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image == NULL)
                                                <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle"/>
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded-circle"/>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if (Auth::user()->image == NULL)
                                                             <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle"/>
                                                        @else
                                                             <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded-circle"/>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin-accountInfo') }}">
                                                        <i class="zmdi zmdi-account fs-3"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin-list') }}">
                                                        <i class="fa-solid fa-users-line me-3"></i>Admin List</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin-userList') }}">
                                                        <i class="fa-solid fa-users me-3"></i></i>User List</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin-changePasswordPage') }}">
                                                        <i class="fa-solid fa-key me-3"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <div class="col-8 offset-2">
                                                    <form action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-dark my-3 w-100 ps-3">
                                                            <i class="zmdi zmdi-power me-1"></i> Logout
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            @yield('content')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    {{-- <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script> --}}
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

@yield('jquery')

</html>
<!-- end document-->
