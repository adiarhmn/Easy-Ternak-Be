@extends('fragments.container-admin')

@section('css')
<style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5); /* Menambahkan latar belakang semi transparan */
        filter: brightness(1000%); /* Meningkatkan kecerahan ikon panah */
        border-radius: 50%; /* Membuat latar belakang berbentuk bulat */
        padding: 10px; /* Memberikan jarak antara ikon dan tepi */
    }

    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: rgba(0, 0, 0, 0.7); /* Warna lebih gelap saat hover */
    }

    .carousel-control-prev,
    .carousel-control-next {
        filter: drop-shadow(2px 2px 3px rgba(0, 0, 0, 0.5)); /* Tambahkan bayangan untuk meningkatkan visibilitas */
    }

    /* Optional: Untuk memperbesar teks pada caption carousel */
    .carousel-caption h5 {
        color: white;
        background-color: rgba(0, 0, 0, 0.6); /* Latar belakang semi transparan pada teks */
        padding: 5px;
        border-radius: 5px;
    }
</style>
@endsection

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
                                    {{-- Menampilkan Mitra --}}
                                    <div class="form-group mb-3">
                                        <label for="mitra" class="form-label">Mitra</label>
                                        <input type="text" id="mitra" class="form-control" value="{{ $animal->mitra->name }}" name="mitra" readonly>
                                    </div>

                                    {{-- Menampilkan Jenis Investasi --}}
                                    <div class="form-group mb-3">
                                        <label for="jenis_investasi" class="form-label">Jenis Investasi</label>
                                        <input type="text" id="jenis_investasi" class="form-control" value="{{ $animal->investmentType->name }}" name="jenis_investasi" readonly>
                                    </div>

                                    {{-- Menampilkan Jenis Kambing (Sub Animal Type) --}}
                                    <div class="form-group mb-3">
                                        <label for="jenis_kambing" class="form-label">Jenis Kambing</label>
                                        <input type="text" id="jenis_kambing" class="form-control" value="{{ $animal->subAnimalType->name }}" name="jenis_kambing" readonly>
                                    </div>

                                    {{-- Menampilkan Deskripsi --}}
                                    <div class="form-group mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" readonly>{{ $animal->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-body">
                                    {{-- Carousel Gambar --}}
                                    <div id="carouselGambar" class="carousel slide mb-4" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            {{-- Menampilkan gambar-gambar dari relasi animalImage --}}
                                            @foreach($animal->animalImage as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ url('uploads/' . $image->image) }}" class="d-block w-100 rounded" alt="Gambar Utama" style="height: 250px; object-fit: cover;">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h5>Gambar {{ $key + 1 }}</h5>
                                                    </div>
                                                </div>
                                            @endforeach
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
                                    
                                    {{-- Menampilkan Tanggal Beli --}}
                                    <div class="form-group mb-3">
                                        <label for="tanggal_beli" class="form-label">Tanggal Beli</label>
                                        <input type="text" id="tanggal_beli" class="form-control" value="{{ $animal->purchase_date ? $animal->purchase_date : "-" }}" name="tanggal_beli" readonly>
                                    </div>

                                    {{-- Menampilkan Tanggal Jual --}}
                                    <div class="form-group mb-3">
                                        <label for="tanggal_jual" class="form-label">Tanggal Jual</label>
                                        <input type="text" id="tanggal_jual" class="form-control" value="{{ $animal->selling_date ? $animal->selling_date  : "-" }}" name="tanggal_jual" readonly>
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
