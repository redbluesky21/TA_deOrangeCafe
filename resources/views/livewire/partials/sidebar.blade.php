
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="active">
                    <a href="{{ route('admin.home') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-home"></i></div>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <div class="d-inline-block icons-sm mr-1"><span class="uim-svg" style=""><i class="fas fa-list text-primary"></i></span></div>
                        <span>Management Menu</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="{{ route('admin.kategori') }}">Kategori</a></li>
                        <li><a href="{{ route('admin.sub-kategori') }}">Sub Kategori</a></li>
                        <li><a href="{{ route('admin.menupesanan') }}">Menu Restaurant</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
