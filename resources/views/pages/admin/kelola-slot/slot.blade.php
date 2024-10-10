@extends('fragments.container-admin')
@section('css')
<style>
.card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    background-color: #f8f9fa; /* Ganti dengan warna yang diinginkan */
}
.cursor:hover {
    cursor: pointer;
}
</style>
@endsection
@section('content')
<ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="line-home-tab" data-bs-toggle="pill" href="#line-home" role="tab" aria-controls="pills-home" aria-selected="true">Slot Tersedia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="line-profile-tab" data-bs-toggle="pill" href="#line-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Slot Penuh</a>
    </li>
    
</ul>
<div class="tab-content mt-3 mb-3" id="line-tabContent">
    <div class="tab-pane fade show active" id="line-home" role="tabpanel" aria-labelledby="line-home-tab">
        <div class="row mt-0">
            @for ($i = 1; $i < 8; $i++)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card cursor m-0">
                        <div class="card-content">
                            <div class="card-body p-3">
                                <div class="position-relative">
                                    <img class="card-img-bottom img-fluid rounded-3" src="/images/kambing2.jpg"
                                        alt="Card image cap" style="height: 10rem; object-fit: cover;">
                                    <span class="badge bg-secondary position-absolute" style="bottom: 10px; left: 10px;">Kambing Boer</span>
                                    <small>
                                        <span class="badge bg-danger position-absolute fw-bold" style="top: 10px; right: 10px;">1/4 terisi</span>
                                    </small>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-end">
                                        <h5 class="card-text mt-0 pt-0 fw-bold"><small>Tekad Jaya Farm</small></h5>
                                    </div>
                                    <small id='deskripsi' class="card-text mt-0 pt-0">
                                        {{ Str::limit('Usia 15 bulan Tinggi 82cm Berat 16 Kg Kambing Hitam', 50) }}
                                    </small>
                                    <div class="d-flex justify-content-end mt-2">
                                        <h5 class="card-text"><small style="font-size: 0.6em">Dibuat: 2023-07-09 15:34:00</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div class="tab-pane fade" id="line-profile" role="tabpanel" aria-labelledby="line-profile-tab">
        <div class="row mt-0">
            @if(false)
            <p class="text-center mt-1">Tidak ada data slot penuh!</p>
            @else
            @for ($i = 1; $i < 8; $i++)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card m-0">
                        <div class="card-content">
                            <div class="card-body p-3">
                                <div class="position-relative">
                                    <img class="card-img-bottom img-fluid rounded-3" src="/images/kambing2.jpg"
                                        alt="Card image cap" style="height: 10rem; object-fit: cover;">
                                    <span class="badge bg-secondary position-absolute" style="bottom: 10px; left: 10px;">Kambing Boer</span>
                                    <small>
                                        <span class="badge bg-success position-absolute fw-bold" style="top: 10px; right: 10px;">4/4 terisi</span>
                                    </small>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-end">
                                        <h5 class="card-text mt-0 pt-0 fw-bold"><small>Tekad Jaya Farm</small></h5>
                                    </div>
                                    <small id='deskripsi' class="card-text mt-0 pt-0">
                                        {{ Str::limit('Usia 15 bulan Tinggi 82cm Berat 16 Kg Kambing Hitam', 50) }}
                                    </small>
                                    <div class="d-flex justify-content-end mt-2">
                                        <h5 class="card-text"><small style="font-size: 0.6em">Dibuat: 2023-07-09 15:34:00</small></h5>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <div style="margin-right: 5px" class="ml-auto">
                                        <a href="{{url('admin/pemeliharaan/detail/1')}}" class="btn btn-secondary btn-sm">Detail</a>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{url('admin/pemeliharaan/jual/1')}}" class="btn btn-danger btn-sm">Confirm Slot</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            @endif
        </div>
    </div>
</div>
    
@endsection
