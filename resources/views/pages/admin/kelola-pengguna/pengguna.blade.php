@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Topbar --}}
            @include('components.topbar.topbar-pengguna')
            {{-- End Topbar --}}
            <div class="row mt-4">
                @foreach ($dataMitra as $item)
                <div class="col-md-4 col-sm-12 mb-1">
                    <a href="{{ url('admin/pengguna/mitra/profil/' . $item->id_mitra) }}" class="text-decoration-none text-dark">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <div class="card-body d-flex align-items-center p-3">
                                <img src="/images/default.jpg" alt="User Image" class="rounded-circle"
                                    style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px;">
                                <div>
                                    <h6 class="card-title mb-1" style="font-size: 1rem;">{{ $item->name }}</h6>
                                    <p class="card-text mb-0" style="font-size: 0.9rem;">Alamat: {{ $item->address }}</p>
                                    <p class="card-text" style="font-size: 0.9rem;">No Handphone: {{ $item->telephone }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
