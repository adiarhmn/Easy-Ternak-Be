@extends('fragments.container-admin')

@section('content')
    <div class="row ">
        @for ($i = 1; $i < 8; $i++)
        <div class="col-md-3 mt-0 col-sm-6 mb-4">
            <div class="card m-0">
                <div class="card-content">
                    <div class="card-body p-3">
                        <div class="position-relative">
                            <img class="card-img-bottom img-fluid rounded-3" src="/images/kambing2.jpg"
                                alt="Card image cap" style="height: 10rem; object-fit: cover;">
                            <span class="badge bg-secondary position-absolute" style="bottom: 10px; right: 10px;">Kambing Boer</span>
                        </div>
                        <div>
                            <div class="d-flex justify-content-end">
                                <h5 class="card-text mt-0 pt-0 fw-bold"><small>Tekad Jaya Farm</small></h5>
                            </div>
                            <small id='deskripsi' class="card-text mt-0 pt-0">
                                {{ Str::limit('Usia 15 bulan Tinggi 82cm Berat 16 Kg Kambing Hitam', 50) }}
                            </small>
                            <div class="d-flex justify-content-end mt-2">
                                <div>
                                    <a href="{{url('admin/penjualan/detail/keuangan/1')}}" class="btn btn-outline btn-secondary btn-sm">Lihat Profit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
    
    </div>

@endsection
