<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            @yield('main-search')
            <nav aria-label="breadcrumb">

                <h6 class="font-weight-bolder mb-0">@yield('breadcrumb')</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
              
                <ul class="navbar-nav me-auto ms-0 justify-content-end">

                    <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <form method="POST" action="{{ route('logout') }}" class="btn btn-default btn-flat float-right">
                            @csrf
                        <a href="{{route('logout')}}" class="nav-link text-body font-weight-bold px-0 logout" onclick="event.preventDefault();  this.closest('form').submit();">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">تسجيل خروج</span>
                        </a>
                    </form>                        

                    </li>
                    @yield('main-li')

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->