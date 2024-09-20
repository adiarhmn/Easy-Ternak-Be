<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="/images/logo.jpg" alt="navbar brand" class="navbar-brand" height="40" />
                <span class="logo-text text-white ml-3">Easy Ternak</span>
            </a>

            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ $page == 'Beranda' ? 'active' : '' }}">
                    <a href="{{ url('admin/beranda') }}">
                        <i class="fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <li class="nav-item {{ $page == 'Slot Investasi' ? 'active' : '' }}">
                    <a href="{{ url('admin/slot') }}">
                        <i class="fas fa-list"></i>
                        <p>Slot</p>
                    </a>
                </li>
                <li class="nav-item {{ $page == 'Pemeliharaan' ? 'active' : '' }}">
                    <a href="{{ url('admin/pemeliharaan') }}">
                        <i class="fas fa-spinner"></i>
                        <p>Pemeliharaan</p>

                    </a>
                </li>
                <li class="nav-item {{ $page == 'Penjualan' ? 'active' : '' }}">
                    <a href="{{ url('admin/penjualan') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Penjualan</p>

                    </a>
                </li>
                <li class="nav-item {{ $page == 'Pengguna' ? 'active' : '' }}">
                    <a href="{{ url('admin/pengguna') }}">
                        <i class="fas fa-user"></i>
                        <p>Pengguna</p>

                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Keluar</p>

                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
