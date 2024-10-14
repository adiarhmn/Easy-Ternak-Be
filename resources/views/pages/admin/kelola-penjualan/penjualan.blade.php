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
</style>
@endsection
@section('content')
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($animals->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    {{-- Tidak ada hewan dalam tahap penjualan. --}}
                    Belum ada hewan yang terjual.
                </div>
            </div>
        @else
            @foreach ($animals as $animal)
                <div class="col-md-3 mt-0 col-sm-6 mb-4">
                    <div class="card m-0">
                        <div class="card-content">
                            <div class="card-body p-3">
                                <div class="position-relative">
                                    <img class="card-img-bottom img-fluid rounded-3" src="{{ url('uploads/' . $animal->animalImage->first()->image) }}"
                                         alt="Card image cap" style="height: 10rem; object-fit: cover;">
                                    <span class="badge bg-secondary position-absolute" style="bottom: 10px; right: 10px;">{{ $animal->subAnimalType->name ?? 'Kambing Boer' }}</span>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-end">
                                        <h5 class="card-text mt-0 pt-0 fw-bold"><small>{{ $animal->mitra->name ?? 'Tekad Jaya Farm' }}</small></h5>
                                    </div>
                                    <small id='deskripsi' class="card-text mt-0 pt-0">
                                        {{ Str::limit($animal->description ?? 'Usia 15 bulan Tinggi 82cm Berat 16 Kg Kambing Hitam', 50) }}
                                    </small>
                                    <div class="d-flex justify-content-end mt-2">
                                        <div>
                                            <a href="{{url('admin/penjualan/detail/keuangan/' . $animal->id_animal)}}" class="btn btn-outline btn-secondary btn-sm">Lihat Profit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
