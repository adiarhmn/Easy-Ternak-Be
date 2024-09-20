<ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Mitra' ? 'active' : '' }}"
           href="{{ url('admin/pengguna/mitra') }}"
           role="tab">
           Mitra
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Investor' ? 'active' : '' }}"
           href="{{ url('admin/pengguna/investor') }}"
           role="tab">
           Investor
        </a>
    </li>
</ul>
