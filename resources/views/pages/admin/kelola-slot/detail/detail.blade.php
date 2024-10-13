@extends('fragments.container-admin')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            {{-- Topbar --}}
            @include('components.topbar.topbar-slot')
            {{-- End Topbar --}}
            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-body">
                                    <div class="form-group mb-3">
                                        <label for="mitra" class="form-label">Mitra</label>
                                        <input type="text" id="mitra" class="form-control" value="Nurependi" name="mitra" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="jenis_investasi" class="form-label">Jenis Investasi</label>
                                        <input type="text" id="jenis_investasi" class="form-control" value="Fattening" name="jenis_investasi" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="jenis_kambing" class="form-label">Jenis Kambing</label>
                                        <input type="text" id="jenis_kambing" class="form-control" value="Boer" name="jenis_kambing" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" readonly>Usia 15 bulan, Tinggi 82cm, Berat 16 Kg</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-body">
                                    {{-- Carousel Gambar --}}
                                    <div id="carouselGambar" class="carousel slide mb-4" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="/images/kambing1.jpg" class="d-block w-100 rounded" alt="Kambing 1" style="height: 250px; object-fit: cover;">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>Gambar 1</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <img src="/images/kambing2.jpg" class="d-block w-100 rounded" alt="Kambing 2" style="height: 250px; object-fit: cover;">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>Gambar 2</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <img src="/images/kambing3.jpg" class="d-block w-100 rounded" alt="Kambing 3" style="height: 250px; object-fit: cover;">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>Gambar 3</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGambar" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselGambar" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    {{-- Akhir Carousel Gambar --}}
                                    <div class="form-group mb-3">
                                        <label for="tanggal_beli" class="form-label">Tanggal Beli</label>
                                        <input type="text" id="tanggal_beli" class="form-control" value="21 Februari 2022" name="tanggal_beli" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tanggal_jual" class="form-label">Tanggal Jual</label>
                                        <input type="text" id="tanggal_jual" class="form-control" value="27 Februari 2022" name="tanggal_jual" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="form-actions d-flex justify-content-end mt-4">
                            <a href="{{ url('admin/penjualan') }}" class="btn btn-secondary me-2">Kembali</a>
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
