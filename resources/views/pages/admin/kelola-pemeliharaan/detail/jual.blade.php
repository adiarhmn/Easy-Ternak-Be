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
                    {{-- Notifikasi sukses atau error --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- Formulir Penjualan --}}
                    <form action="{{ url('admin/penjualan') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
                                <input type="number" id="harga_jual" class="form-control" name="harga_jual" min="0" value="1200000" required placeholder="Masukkan Harga Jual" onchange="updateProfit()">
                                <span class="badge bg-primary mt-1">Masukkan Harga Jual untuk Hitung Profit</span>
                                <small id="hargaJualHelp" class="form-text text-muted">Contoh: 1200000</small>
                            </div>

                            <div class="col">
                                <div class="form-body">
                                    {{-- Bagian Modal --}}
                                    <h6 class="fw-bold">Modal</h6>
                                    <div class="form-group">
                                        <label for="harga_beli">Harga Beli (Modal)</label>
                                        <input type="text" id="harga_beli" class="form-control" value="Rp 1.000.000" name="harga_beli" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="pengeluaran">Pengeluaran (Pemeliharaan)</label>
                                        <div class="input-group">
                                            <input type="text" id="pengeluaran" class="form-control" value="Rp 150.000" name="pengeluaran" readonly>
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetailPengeluaran">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total_modal">Total Modal</label>
                                        <input type="text" id="total_modal" class="form-control" value="Rp 1.150.000" name="total_modal" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-body">
                                    {{-- Profit --}}
                                    <h6 class="fw-bold">Keuntungan</h6>
                                    <div class="form-group">
                                        <label for="hasil_bersih">Hasil Bersih Setelah Modal</label>
                                        <input type="text" id="hasil_bersih" class="form-control" name="hasil_bersih" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="profit_platform">Profit Platform (5%)</label>
                                        <input type="text" id="profit_platform" class="form-control" name="profit_platform" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="profit_investor">Profit Investor (50%)</label>
                                        <input type="text" id="profit_investor" class="form-control" name="profit_investor" readonly>
                                        <span class="badge bg-success mt-1">50% dari Hasil Bersih</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="profit_mitra">Profit Mitra (45%)</label>
                                        <input type="text" id="profit_mitra" class="form-control" name="profit_mitra" readonly>
                                        <span class="badge bg-warning mt-1">45% dari Hasil Bersih</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Jual Sekarang --}}
                        <div class="form-actions d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-danger">Jual Sekarang!</button>
                        </div>

                        {{-- Tombol Kembali --}}
                        <div class="form-actions d-flex justify-content-end grid gap-1 mt-2">
                            <a href="{{ url('admin/penjualan') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail Pengeluaran --}}
<div class="modal fade" id="modalDetailPengeluaran" tabindex="-1" aria-labelledby="modalDetailPengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailPengeluaranLabel">Detail Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Rincian pengeluaran akan ditampilkan di sini.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function updateProfit() {
        const hargaJual = parseFloat(document.getElementById('harga_jual').value);
        const modalBeli = 1000000;
        const pengeluaran = 150000;

        // Total Modal
        const totalModal = modalBeli + pengeluaran;
        document.getElementById('total_modal').value = `Rp ${totalModal.toLocaleString()}`;

        // Hasil Bersih Setelah Modal
        const hasilBersih = hargaJual - totalModal;
        document.getElementById('hasil_bersih').value = `Rp ${hasilBersih.toLocaleString()}`;

        // Profit Platform 5%
        const profitPlatform = hasilBersih * 0.05;
        document.getElementById('profit_platform').value = `Rp ${profitPlatform.toLocaleString()}`;

        // Profit Investor (50%)
        const profitInvestor = (hasilBersih - profitPlatform) * 0.50;
        document.getElementById('profit_investor').value = `Rp ${profitInvestor.toLocaleString()}`;

        // Profit Mitra (45%)
        const profitMitra = (hasilBersih - profitPlatform) * 0.45;
        document.getElementById('profit_mitra').value = `Rp ${profitMitra.toLocaleString()}`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateProfit();
    });

    document.getElementById('harga_jual').addEventListener('input', updateProfit);
</script>
@endsection
