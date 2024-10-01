@extends('fragments.container-admin')

@section('content')
    <div class="row">
        @for ($i = 1; $i < 5; $i++)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-2">
                            <img class="card-img-bottom img-fluid rounded-2" src="/images/kambing2.jpg"
                                alt="Card image cap" style="height: 10rem; object-fit: cover;">
                            <div>
                                <h5 class="fw-bold mb-0 pb-0 mt-1">Kambing Boer</h5>
                            <p id='deskripsi' class="card-text mt-0 pt-0">
                                {{ Str::limit('Usia 15 bulan Tinggi 82cm Berat 16 Kg Kambing Hitam', 50) }}
                            </p>
                                <h5 class="card-text mt-0 pt-0"><small>Tekad Jaya Farm</small></h5>
                            <div class="d-flex justify-content-end">
                                <div>
                                    <a href="{{url('admin/penjualan/detail/1')}}" class="btn btn-secondary btn-sm">Detail</a>
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
