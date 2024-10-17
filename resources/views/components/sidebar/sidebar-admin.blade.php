<div class="sidebar" data-background-color="white">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="purple">
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
                        
                        <p>Slot <div class="badge" style="background-color: #b1a1e6">Tahap 1</div></p>
                    </a>
                </li>
                <li class="nav-item {{ $page == 'Pemeliharaan' ? 'active' : '' }}">
                    <a href="{{ url('admin/pemeliharaan') }}">
                        <i class="fas fa-spinner"></i>
                        <p>Pemeliharaan <div class="badge " style="background-color: #b1a1e6">Tahap 2</div></p>

                    </a>
                </li>
                <li class="nav-item {{ $page == 'Penjualan' ? 'active' : '' }}">
                    <a href="{{ url('admin/penjualan') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Penjualan <div class="badge " style="background-color: #b1a1e6">Tahap 3</div></p>
                    </a>
                </li>
                
                <li class="nav-item {{ $page == 'Pengguna' ? 'active' : '' }}">
                    <a href="{{ url('admin/pengguna') }}">
                        <i class="fas fa-user"></i>
                        <p>Manajemen Akun</p>
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
