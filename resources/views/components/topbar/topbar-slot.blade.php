<ul class="nav nav-tabs nav-line nav-color-secondary mt-0 pt-0" id="line-tab" role="tablist">
    <li class="nav-item mt-0 pt-0"">
        <a class="nav-link mt-0 pt-0" {{ $topbar == 'Detail' ? 'active' : '' }}" href="{{ url('admin/slot/detail/1') }}" role="tab" >Detail</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $topbar == 'Investor' ? 'active' : '' }}" href="{{ url('admin/slot/detail/investor/1') }}" role="tab"
            aria-controls="pills-profile" aria-selected="false">Investor</a>
    </li>
</ul>
