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
                                    <th>Pembayaran</th>
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
                                        <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#paymentProofModal-{{ $investment->id_investment_slot }}">Lihat Bukti</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal-{{ $investment->id_investment_slot }}">Setujui</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $investment->id_investment_slot }}">Tolak</a>
                                    </td>
                                </tr>

                                {{-- Modal untuk melihat bukti pembayaran --}}
                                <div class="modal fade" id="paymentProofModal-{{ $investment->id_investment_slot }}" tabindex="-1" aria-labelledby="paymentProofModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="paymentProofModalLabel">Bukti Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Menampilkan bukti pembayaran untuk investasi ID: {{ $investment->id_investment_slot }}</p>
                                                <img src="path_to_payment_proof_image" alt="Bukti Pembayaran" class="img-fluid">
                                                {{-- Ganti path_to_payment_proof_image dengan URL gambar bukti pembayaran yang sebenarnya --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal untuk menyetujui investasi --}}
                                <div class="modal fade" id="approveModal-{{ $investment->id_investment_slot }}" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approveModalLabel">Konfirmasi Setujui</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menyetujui investasi ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a href="{{ url('admin/slot/setujui/'.$investment->id_investment_slot) }}" class="btn btn-success">Setujui</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal untuk menolak investasi --}}
                                <div class="modal fade" id="rejectModal-{{ $investment->id_investment_slot }}" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Tolak</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menolak investasi ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a href="{{ url('admin/slot/tolak/'.$investment->id_investment_slot) }}" class="btn btn-danger">Tolak</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
