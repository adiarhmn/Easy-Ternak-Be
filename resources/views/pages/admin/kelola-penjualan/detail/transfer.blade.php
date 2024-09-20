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
                        <div class="form-group">
                            <label for="bukti_transfer">Bukti Transfer</label>
                            <div class="form-control-plaintext" id="bukti_transfer">
                                <!-- Ganti dengan path atau nama file bukti transfer yang sesuai -->
                                <a href="{{ url('images/bukti-transfer.jpg') }}" target="_blank">Lihat Bukti Transfer</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_transfer">Jumlah Transfer</label>
                            <input type="text" id="jumlah_transfer" class="form-control-plaintext" value="Rp 500.000" readonly>
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
