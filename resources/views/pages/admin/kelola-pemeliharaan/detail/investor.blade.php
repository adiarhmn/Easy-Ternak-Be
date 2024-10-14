@extends('fragments.container-admin')

@section('content')
<div class="card">
    <div class="card-body">
        {{-- Topbar --}}
        @include('components.topbar.topbar-pemeliharaan')
        {{-- End Topbar --}}
        <div class="tab-content mt-3 mb-3" id="line-tabContent">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Investor</th>
                                    <th>Jumlah Investasi</th>
                                    <th>Batas Waktu</th>
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
                                    <td>{{ $investment->expired_at ? $investment->expired_at : "-" }}</td>
                                    <td>
                                        <span class="badge bg-{{ $investment->status === 'success' ? 'success' : ($investment->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst( $investment->status === 'success' ? 'Terdaftar' : ($investment->status === 'pending' ? 'Menunggu' : 'Ditolak')) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#paymentProofModal-{{ $investment->id_investment_slot }}">Lihat Bukti</a>
                                    </td>
                                    <td>
                                        @if($investment->status === 'pending')
                                        <a href="#" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal-{{ $investment->id_investment_slot }}">Konfirmasi</a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>

                                {{-- Modal untuk melihat bukti pembayaran --}}
                               <!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="paymentProofModal-{{ $investment->id_investment_slot }}" tabindex="-1" aria-labelledby="buktiPembayaranLabel_{{ $investment->id_investment_slot }}" aria-hidden="true">
    <div class="modal-dialog "> <!-- Ukuran modal lebih kecil -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiPembayaranLabel_{{ $investment->id_investment_slot }}">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($investment->transferProof->isNotEmpty())
                    @foreach($investment->transferProof as $index => $proof)
                        <div class="card mb-2 border border-secondary"> <!-- Card untuk setiap bukti pembayaran -->
                            <div class="card-body text-center">
                                <h5 class="card-title">Bukti Pembayaran {{ $index + 1 }}</h5> <!-- Penanda untuk setiap gambar -->
                                <img src="{{ url('uploads/' . $proof->proof_image) }}" alt="Bukti Pembayaran {{ $index + 1 }}" class="img-fluid rounded">
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">Tidak ada bukti pembayaran yang diunggah.</p>
                @endif
            </div>
            <div class="modal-footer justify-content-center">
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
                                                <h5 class="modal-title" id="approveModalLabel">Konfirmasi Setujui/Tolak</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menyetujui investasi ini?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ url('admin/slot/tolak/'.$investment->id_investment_slot) }}" class="btn btn-danger">Tolak</a>
                                                <a href="{{ url('admin/slot/setujui/'.$investment->id_investment_slot) }}" class="btn btn-success">Setujui</a>
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
