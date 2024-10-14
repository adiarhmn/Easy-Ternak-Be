<ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Detail' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/detail/' . $idAnimal) }}"
           role="tab">
           Detail
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Progres' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/progres/' . $idAnimal) }}"
           role="tab">
           Progres
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Pengeluaran' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/pengeluaran/' . $idAnimal) }}"
           role="tab">
           Pengeluaran
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Investor' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/investor/' . $idAnimal) }}"
           role="tab">
           Investor
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Jual' ? 'active' : '' }}"
           href="{{ url('admin/pemeliharaan/jual/' . $idAnimal) }}"
           role="tab">
           Jual
        </a>
    </li>
</ul>
