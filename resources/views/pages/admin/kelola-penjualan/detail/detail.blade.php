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
                                        <label for="mitra">Mitra</label>
                                        <input type="text" id="mitra" class="form-control" value="Nurependi"
                                            name="mitra" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_investasi">Jenis Investasi</label>
                                        <input type="text" id="jenis_investasi" class="form-control" value="Fattening"
                                            name="jenis_investasi" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kambing">Jenis Kambing</label>
                                        <input type="text" id="jenis_kambing" class="form-control" value="Boer"
                                            name="jenis_kambing" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" readonly>Usia 15 bulan Tinggi 82cm Berat 16 Kg</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Gambar</label>
                                        <img src="/images/kambing2.jpg" alt="kambing2" id="gambar" class="form-control img-fluid"
                                            style="height: 200px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="tanggal_beli">Tanggal Beli</label>
                                        <input type="text" id="tanggal_beli" class="form-control" value="21 Februari 2022"
                                            name="tanggal_beli" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_jual">Tanggal Jual</label>
                                        <input type="text" id="tanggal_jual" class="form-control" value="27 Februari 2022"
                                            name="tanggal_jual" readonly>
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
@endsection

<script>
    $(document).ready(function() {
        $('#multi-filter-select').DataTable();
    });
</script>
