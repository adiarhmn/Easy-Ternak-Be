@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Topbar --}}
            @include('components.topbar.topbar-penjualan')
            {{-- End Topbar --}}
            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="harga_beli">Harga Beli</label>
                                        <input type="text" id="harga_beli" class="form-control" value="Rp 1.000.000"
                                            name="harga_beli" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual</label>
                                        <input type="text" id="harga_jual" class="form-control" value="Rp 1.200.000"
                                            name="harga_jual" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="aplikasi_5">Aplikasi 5%</label>
                                        <input type="text" id="aplikasi_5" class="form-control" value="Rp 60.000"
                                            name="aplikasi_5" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="pengeluaran">Pengeluaran</label>
                                        <div class="input-group">
                                            <input type="text" id="pengeluaran" class="form-control" value="Rp 150.000"
                                                name="pengeluaran" readonly>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetailPengeluaran">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hasil_bersih">Hasil Bersih</label>
                                        <input type="text" id="hasil_bersih" class="form-control" value="Rp 890.000"
                                            name="hasil_bersih" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="profit_investor">Profit Investor</label>
                                        <input type="text" id="profit_investor" class="form-control" value="Rp 100.000"
                                            name="profit_investor" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="profit_mitra">Profit Mitra</label>
                                        <input type="text" id="profit_mitra" class="form-control" value="Rp 90.000"
                                            name="profit_mitra" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions d-flex justify-content-end grid gap-1">
                            <a href="{{ url('admin/penjualan') }}" class="btn btn-secondary">Kembali</a>
                        </div>
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
                    <p>Detail detail pengeluaran di sini.</p>
                    <!-- Tambahkan detail pengeluaran yang lebih spesifik di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
