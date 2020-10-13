
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin.home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/dist') }}/assets/images/logo-sm-dark.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/dist') }}/assets/images/logo-dark.png" alt="" height="20">
                    </span>
                </a>

                <a href="{{ route('admin.home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/dist') }}/assets/images/logo-sm-light.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/dist') }}/assets/images/logo-light.png" alt="" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/dist') }}/assets/images/users/avatar-1.jpg" alt="Header Avatar">
                    <span class="d-none d-sm-inline-block ml-1">Smith</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <button type="submit" class="dropdown-item" href="#"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</header>
