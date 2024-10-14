@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Topbar --}}
            @include('components.topbar.topbar-pemeliharaan')
            {{-- End Topbar --}}

            <!-- Date Range Filter -->
            <form action="{{ '/admin/pemeliharaan/progres/' . $idAnimal }}" method="GET" id="filterForm">
                <div class="row mb-3 mt-4">
                    <div class="col-md-6">
                        <label for="start-date" class="form-label">Dari Tanggal</label>
                        <input type="date" id="start-date" name="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-6">
                        <label for="end-date" class="form-label">Sampai Tanggal</label>
                        <input type="date" id="end-date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-12 mt-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
            
            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                    <div class="card-body">
                        {{-- Progress List --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="progress-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan Progress</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($progress as $item)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                            <td>{{ Str::limit($item->description, 30) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#progressModal{{ $item->id_animal_progress }}">
                                                    Lihat Detail
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal for viewing progress details -->
                                        <div class="modal fade" id="progressModal{{ $item->id_animal_progress }}" tabindex="-1" aria-labelledby="progressModalLabel{{ $item->id_animal_progress }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="progressModalLabel{{ $item->id_animal_progress }}">Detail Progress - {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Keterangan:</strong> {{ $item->description }}</p>
                                                        <div class="row">
                                                            @if($item->progressImage->isNotEmpty())
                                                                @foreach($item->progressImage as $image)
                                                                    <div class="col-md-4 mb-3">
                                                                        <a href="{{ asset('uploads/' . $image->image) }}" target="_blank">
                                                                            <img src="{{ asset('uploads/' . $image->image) }}" class="img-fluid img-thumbnail" alt="Bukti Progress">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <p>Tidak ada gambar progress</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Modal -->
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data progress</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="form-actions d-flex justify-content-end grid gap-1 mt-3">
                            <a href="{{ url('admin/penjualan') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
