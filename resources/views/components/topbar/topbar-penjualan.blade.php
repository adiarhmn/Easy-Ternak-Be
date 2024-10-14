<ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Detail' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/' . $idAnimal) }}" role="tab" >Detail</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Keuangan' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/keuangan/' . $idAnimal) }}" role="tab">Profit</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Transfer' ? 'active' : '' }}"  href="{{ url('admin/penjualan/detail/transfer/' . $idAnimal) }}" role="tab"
            aria-controls="pills-profile" aria-selected="false">Transfer</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Investor' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/investor/' . $idAnimal) }}" role="tab"
        aria-controls="pills-profile" aria-selected="false">Investor</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Progres' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/progres/' . $idAnimal) }}" role="tab"
            aria-controls="pills-profile" aria-selected="false">Histori Progres</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Progres' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/pengeluaran/' . $idAnimal) }}" role="tab"
            aria-controls="pills-profile" aria-selected="false">Histori Pengeluaran</a>
    </li>
</ul>