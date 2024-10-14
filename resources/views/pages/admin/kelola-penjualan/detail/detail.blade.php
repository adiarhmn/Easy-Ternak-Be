@extends('fragments.container-admin')

@section('css')
<style>
    /* Border ungu pada card */
    .card {
        border: 2px solid #800080; /* Ungu */
        border-radius: 10px;
        padding: 10px;
    }

    /* Badge untuk slot terisi */
    .badge-slot {
        background-color: #800080; /* Warna ungu untuk badge */
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 14px;
    }

    /* Carousel button modifications */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        filter: brightness(1000%);
        border-radius: 50%;
        padding: 10px;
    }

    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .carousel-control-prev,
    .carousel-control-next {
        filter: drop-shadow(2px 2px 3px rgba(0, 0, 0, 0.5));
    }

    /* Optional: Untuk memperbesar teks pada caption carousel */
    .carousel-caption h5 {
        color: white;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 5px;
        border-radius: 5px;
    }

    /* Tambahkan border pada gambar di dalam carousel */
    .carousel-item img {
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 5px;
    }
</style>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            {{-- Topbar --}}
            @include('components.topbar.topbar-penjualan')

            {{-- Badge Slot --}}
            
            {{-- End Topbar --}}
            <div class="tab-content mt-3 mb-3" >
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="">
                                <span class="badge-slot badeg badge-secondary fw-bold">{{$animal->total_slots}} Total Slot</span>
                            </div>
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
                                <div class="form-body mt-3">
                                    {{-- Carousel Gambar --}}
                                    <div id="carouselGambar" class="carousel slide mb-4" data-bs-ride="carousel">
                                        <div class="carousel-inner">
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
