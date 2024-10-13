@extends('fragments.container-admin')

@section('content')
<div class="card">
    <div class="card-body">
        {{-- Topbar --}}
        @include('components.topbar.topbar-slot')
        {{-- End Topbar --}}
        <div class="tab-content mt-3 mb-3" id="line-tabContent">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Investor</th>
                                    <th>Jumlah Investasi</th>
                                    <th>Tanggal Investasi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($investmentSlots as $investment)
                                <tr>
                                    <td>{{ $investment->investor ? $investment->investor->name : 'Investor tidak ditemukan' }}</td>

                                    <td>Rp {{ number_format($investment->slot_price, 0, ',', '.') }}</td>
                                    <td>{{ $investment->created_at->format('d F Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $investment->status === 'filled' ? 'success' : ($investment->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($investment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/slot/detail/'.$investment->id_investment_slot) }}" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data investor.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="form-actions d-flex justify-content-end grid gap-1 mt-3">
                        <a href="{{ url('admin/penjualan') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
