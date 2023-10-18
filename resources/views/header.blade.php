<!-- Header -->
<header class="header-v2">
    @php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp

        <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="wrap-menu-desktop ">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="/template/images/icons/1.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu"><a href="/">Trang Chủ</a> </li>

                        {!! $menusHtml !!}

                        <li>
                            <a href="{{ route('contact') }}">Liên Hệ</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>




                        <!-- Button trigger modal -->
                        @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    Profile
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <span class="float-right text-muted text-sm">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </span>

                            </div>
                        </li>
                        @else
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 ">
                        <button type="button" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" data-toggle="modal" data-target="#exampleModal">
                            <i class="zmdi zmdi-account"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="10" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <div class="login-logo">
                                                Sign in
                                            </div>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <!-- /.login-logo -->
                                                <div class="card-body login-card-body">
                                                                <p class="login-box-msg"> <a href="#"><b> <img src="/template/images/icons/1.png" alt="IMG-LOGO"></b></a></p>
                                                                @include('admin.alert')
                                                                <form action="/admin/users/login/store" method="post">
                                                                    <div class="input-group mb-3">
                                                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text">
                                                                    <span class="fa fa-envelope"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fa fa-lock"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <a href="/admin/users/register" class="text-center">Don't have an account. Register now!</a>
                                                        </div>
                                                        @csrf

                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    @endif

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                         data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="#"><img src="/template/images/icons/1.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>
            <!-- Button trigger modal -->
            @if(Auth::check())
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                {{ Auth::user()->name }}
            </div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @else
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">

                    <!-- Trigger/Open The Modal -->
                    <button id="myBtn2" class="myBtn"> <i class="zmdi zmdi-account"></i></button>

                    <!-- The Modal -->
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <div class="login-logo">
                                            Sign in
                                        </div>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- /.login-logo -->
                                    <div class="card-body login-card-body">
                                        <p class="login-box-msg"> <a href="#"><b> <img src="/template/images/icons/1.png" alt="IMG-LOGO"></b></a></p>
                                        @include('admin.alert')
                                        <form action="/admin/users/login/store" method="post">
                                            <div class="input-group mb-3">
                                                <input type="email" name="email" class="form-control" placeholder="Email">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fa fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="password" name="password" class="form-control" placeholder="Password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fa fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <a href="/admin/users/register" class="text-center">Don't have an account. Register now!</a>
                                            </div>
                                        @csrf

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li class="active-menu"><a href="/">Trang Chủ</a> </li>

            {!! $menusHtml !!}

            <li>
                <a href="{{ route('contact') }}">Liên Hệ</a>
            </li>

        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
