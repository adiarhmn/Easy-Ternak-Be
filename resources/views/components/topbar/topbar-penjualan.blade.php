<ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Detail' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/1') }}" role="tab" >Detail</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Keuangan' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/keuangan/1') }}" role="tab">Profit</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Transfer' ? 'active' : '' }}"  href="{{ url('admin/penjualan/detail/transfer/1') }}" role="tab"
            aria-controls="pills-profile" aria-selected="false">Transfer</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Progres' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/progres/1') }}" role="tab"
            aria-controls="pills-profile" aria-selected="false">Progres</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Investor' ? 'active' : '' }}" href="{{ url('admin/penjualan/detail/investor/1') }}" role="tab"
            aria-controls="pills-profile" aria-selected="false">Investor</a>
    </li>
</ul>
