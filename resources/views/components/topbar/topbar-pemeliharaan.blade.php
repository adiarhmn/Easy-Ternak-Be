<ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Detail' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/detail/1') }}"
           role="tab">
           Detail
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Progres' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/progres/1') }}"
           role="tab">
           Progres
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Pengeluaran' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/pengeluaran/1') }}"
           role="tab">
           Pengeluaran
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Investor' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/investor/1') }}"
           role="tab">
           Investor
        </a>
    </li>
</ul>
