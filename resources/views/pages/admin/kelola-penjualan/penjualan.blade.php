@extends('fragments.container-admin')

@section('content')
    <div class="row">
        @for ($i = 1; $i < 5; $i++)
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-content">
                        <img class="card-img-bottom img-fluid" src="/images/kambing2.jpg"
                            alt="Card image cap" style="height: 20rem; object-fit: cover;">
                        <div class="card-body">
                            <h4 class="card-title">Boer</h4>
                            <p id='deskripsi' class="card-text">
                                {{ Str::limit('Usia 15 bulan Tinggi 82cm Berat 16 Kg Kambing Hitam', 50) }}
                            </p>
                            <h5 class="card-text"><small>Tekad Jaya Farm</small></h5>
                            <div class="d-flex">
                                <div class="ml-auto">
                                    <a href="{{url('admin/penjualan/detail/1')}}" class="btn btn-primary btn-sm">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

@endsection
