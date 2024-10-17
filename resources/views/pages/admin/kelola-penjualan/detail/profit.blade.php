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

                        {{-- Harga Jual --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga_jual" class="fw-bold">Harga Jual</label>
                                    <input type="text" id="harga_jual_display" value="Rp {{ number_format($animal->selling_price, 0, ',', '.') }}" class="form-control" readonly>
                                    <input type="hidden" id="harga_jual_value" value="{{ $animal->selling_price }}" name="harga_jual">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli (Modal)</label>
                                    <input type="text" id="harga_beli" value="Rp {{ number_format($animal->purchase_price, 0, ',', '.') }}" class="form-control" readonly>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keuntungan_kotor">Keuntungan Kotor</label>
                                    <input type="text" id="keuntungan_kotor" value="Rp {{ number_format($animal->selling_price - $animal->purchase_price, 0, ',', '.') }}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profit_platform">Profit Platform (5%)</label>
                                    <input type="text" id="profit_platform_display" class="form-control" readonly>
                                    <input type="hidden" id="profit_platform" name="profit_platform">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_modal">Total Modal</label>
                                    <input type="text" id="total_modal_display" class="form-control" readonly>
                                    <input type="hidden" id="total_modal" name="total_modal">
                                </div>
                            </div> --}}

                            <div class="col-12">
                                <div class="form-group">
                                <h6 class="fw-bold">Pembagian Mitra & Investor</h6>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengeluaran">Pengeluaran (Pemeliharaan)</label>
                                    <div class="input-group">
                                        <input type="text" id="pengeluaran" value="Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}" class="form-control" readonly>
                                        <a class="btn btn-secondary" href="/admin/pemeliharaan/pengeluaran/{{ $animal->id_animal }}">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Profit --}}
                                <div class="form-group">
                                    <label for="hasil_bersih">Keuntungan Bersih</label>
                                    <input type="text" id="hasil_bersih_display" class="form-control" readonly>
                                    <input type="hidden" id="hasil_bersih" name="hasil_bersih">
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                
                                <div class="form-group">
                                    <label for="profit_investor">Profit Investor (50%)</label>
                                    <input type="text" id="profit_investor_display" class="form-control" readonly>
                                    <input type="hidden" id="profit_investor" name="profit_investor">
                                    <span class="badge bg-success mt-1">50% dari Total Profit</span>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profit_mitra">Profit Mitra (50%)</label>
                                    <input type="text" id="profit_mitra_display" class="form-control" readonly>
                                    <input type="hidden" id="profit_mitra" name="profit_mitra">
                                    <span class="badge bg-warning mt-1">50% dari Total Profit</span>
                                </div>
                            </div>


                        </div>

                        {{-- Tombol Kembali --}}
                        <div class="form-actions d-flex justify-content-end mt-2">
                            <a href="{{ url('admin/penjualan') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk Mengupdate Profit dengan jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function formatRupiah(number) {
            return 'Rp ' + number.toFixed(0).replace(/\d(?=(\d{3})+(?!\d))/g, '$&,');
        }

        const hargaJual = parseFloat($("#harga_jual_value").val()) || 0;
        const hargaBeli = parseFloat("{{ $animal->purchase_price }}");
        const pengeluaran = parseFloat("{{ $totalPengeluaran }}") || 0;

        const totalModal = hargaBeli + pengeluaran;
        const profit = hargaJual - totalModal;

        $('#total_modal_display').val(formatRupiah(totalModal));
        $('#total_modal').val(totalModal);

        $('#hasil_bersih_display').val(formatRupiah(profit >= 0 ? profit : 0));
        $('#hasil_bersih').val(profit >= 0 ? profit : 0);

        const profitPlatform = (profit + pengeluaran) * 0.05;
        const profitInvestor = profit * 0.50;
        const profitMitra = profit * 0.50;

        $('#profit_platform_display').val(formatRupiah(profitPlatform >= 0 ? profitPlatform : 0));
        $('#profit_platform').val(profitPlatform);

        $('#profit_investor_display').val(formatRupiah(profitInvestor >= 0 ? profitInvestor : 0));
        $('#profit_investor').val(profitInvestor);

        $('#profit_mitra_display').val(formatRupiah(profitMitra >= 0 ? profitMitra : 0));
        $('#profit_mitra').val(profitMitra);
    });
</script>
@endsection
