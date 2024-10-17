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

                    {{-- Form Penjualan --}}
                    <form method="POST" action="{{ url('admin/pemeliharaan/jual') }}" id="saleForm">
                        @csrf
                        <input type="hidden" name="animal_id" value="{{ $animal->id_animal }}">
                        <div class="row">
                            {{-- Input Harga Jual --}}
                            <div class="form-group col-md-6">
                                <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
                                <input type="number" id="harga_jual" class="form-control" name="harga_jual" min="0" required placeholder="Masukkan Harga Jual">
                                <span class="badge bg-primary mt-1">Masukkan Harga Jual untuk Hitung Profit</span>
                                <small id="hargaJualHelp" class="form-text text-muted">Contoh: Rp {{ number_format($animal->purchase_price + $animal->purchase_price, 0, ',', '.') }}</small>
                            </div>

                            <div class="col-md-6">
                                <div class="form-body">
                                    {{-- Bagian Modal --}}
                                    <div class="form-group mb-0 pb-0">
                                        <h6 class="fw-bold">Modal</h6>
                                    </div>
                                    <div class="form-group mt-0 pt-0">
                                        <label for="harga_beli">Harga Beli (Modal)</label>
                                        <input type="text" id="harga_beli" class="form-control" value="Rp {{ number_format($animal->purchase_price, 0, ',', '.') }}" name="harga_beli" readonly>
                                    </div>

                                    

                                    <div class="form-group">
                                        <label for="keuntungan_kotor">Keuntungan Kotor</label>
                                        <input type="text" id="keuntungan_kotor" class="form-control" name="keuntungan_kotor" readonly>
                                        <input type="hidden" id="total_modal" class="form-control" value="{{$animal->purchase_price + $totalPengeluaran   }}" name="total_modal" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="profit_platform">Profit Platform (5%)</label>
                                        <input type="text" id="profit_platform_display" class="form-control" readonly>
                                        <input type="hidden" id="profit_platform" name="profit_platform" readonly>
                                    </div>
                                </div>
                            </div>

                                <div class="form-body">
                                    {{-- Profit --}}
                                    <div class="form-group mb-0 pb-0">
                                        <h6 class="fw-bold">Pembagian Mitra dan Investor</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pengeluaran">Pengeluaran (Pemeliharaan)</label>
                                                <div class="input-group">
                                                    <input type="text" id="pengeluaran" class="form-control" value="Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}" name="pengeluaran" readonly>
                                                    <a class="btn btn-secondary" href="/admin/pemeliharaan/pengeluaran/{{$animal->id_animal}}">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="hasil_bersih">Keuntungan Bersih</label>
                                                <input type="text" id="hasil_bersih_display" class="form-control" readonly>
                                                <input type="hidden" id="hasil_bersih" name="hasil_bersih" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="profit_investor">Profit Investor (50%)</label>
                                                <input type="text" id="profit_investor_display" class="form-control" readonly>
                                                <input type="hidden" id="profit_investor" name="profit_investor" readonly>
                                                <span class="badge bg-success mt-1">50% dari Total Profit</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="profit_mitra">Profit Mitra (50%)</label>
                                                <input type="text" id="profit_mitra_display" class="form-control" readonly>
                                                <input type="hidden" id="profit_mitra" name="profit_mitra" readonly>
                                                <span class="badge bg-warning mt-1">50% dari Total Profit</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                   
                                    
                            </div>
                        </div>

                        {{-- Tombol Jual Sekarang --}}
                        <div class="form-actions d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmModal">Jual Sekarang!</button>
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

{{-- Modal Konfirmasi Penjualan --}}
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menjual hewan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="saleForm" class="btn btn-primary">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk Mengupdate Profit dengan jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#harga_jual').on('input', function() {
        const hargaJual = parseFloat($(this).val()) || 0;
        const hargaBeli = parseFloat("{{ $animal->purchase_price }}");
        const pengeluaran = parseFloat("{{ $totalPengeluaran }}") || 0;

        const totalModal = hargaBeli + pengeluaran;
        const profit = hargaJual - totalModal;

        const keuntungan_kotor = hargaJual - hargaBeli;
        if(keuntungan_kotor >= 0){
            $('#keuntungan_kotor').val(`Rp ${keuntungan_kotor.toFixed(0).replace(/\d(?=(\d{3})+(?!\d))/g, '$&,')}`);
        } else{
            $('#keuntungan_kotor').val('Rp 0'); // Set nilai numerik ke input hidden
        }

        $('#total_modal_display').val(`Rp ${totalModal.toFixed(0).replace(/\d(?=(\d{3})+(?!\d))/g, '$&,')}`);
        $('#total_modal').val(totalModal >= 0 ? totalModal : 0);
        $('#hasil_bersih_display').val(`Rp ${profit >= 0 ? profit.toFixed(0).replace(/\d(?=(\d{3})+(?!\d))/g, '$&,') : 0}`);
        $('#hasil_bersih').val(profit >= 0 ? profit : 0); // Set nilai numerik ke input hidden

        const profitPlatform = Math.max((hargaJual - hargaBeli) * 0.05, 0);
        $('#profit_platform_display').val(`Rp ${profitPlatform.toFixed(0).replace(/\d(?=(\d{3})+(?!\d))/g, '$&,')}`);
        $('#profit_platform').val(profitPlatform); // Set nilai numerik ke input hidden

        const profitInvestor = Math.max((profit * 0.50), 0);
        $('#profit_investor_display').val(`Rp ${profitInvestor.toFixed(0).replace(/\d(?=(\d{3})+(?!\d))/g, '$&,')}`);
        $('#profit_investor').val(profitInvestor); // Set nilai numerik ke input hidden

        const profitMitra = Math.max((profit * 0.50), 0);
        $('#profit_mitra_display').val(`Rp ${profitMitra.toFixed(0).replace(/\d(?=(\d{3})+(?!\d))/g, '$&,')}`);
        $('#profit_mitra').val(profitMitra); // Set nilai numerik ke input hidden
    });
});

</script>

@endsection
