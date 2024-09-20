@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Topbar --}}
            @include('components.topbar.topbar-pemeliharaan')
            {{-- End Topbar --}}

            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                    <div class="card-body">
                        <!-- List Progress Pemeliharaan (Statik) -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Deskripsi Progress</th>
                                    <th>Bukti Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-08-15</td>
                                    <td>Pemberian Pakan Tambahan</td>
                                    <td><img src="{{ url('images/kambing2.jpeg') }}" alt="Bukti Gambar 1" width="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-08-10</td>
                                    <td>Pembersihan Kandang</td>
                                    <td><img src="{{ url('images/kambing2.jpeg') }}" alt="Bukti Gambar 2" width="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-08-05</td>
                                    <td>Vaksinasi Kambing</td>
                                    <td><img src="{{ url('images/kambing2.jpeg') }}" alt="Bukti Gambar 3" width="100">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End List Progress Pemeliharaan (Statik) -->
                    </div>

                    <div class="form-actions d-flex justify-content-end grid gap-1">
                        <!-- Tombol untuk memicu modal tambah progress -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahProgressModal">
                            Tambah Progress
                        </button>
                        {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#jualModal">
                            Jual
                        </button> --}}
                        <a href="{{ url('admin/pemeliharaan') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Progress -->
    <div class="modal fade" id="tambahProgressModal" tabindex="-1" aria-labelledby="tambahProgressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('admin/pemeliharaan/progress/tambah') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahProgressModalLabel">Tambah Progress Pemeliharaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Progress</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Bukti Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Jual -->
    {{-- <div class="modal fade" id="jualModal" tabindex="-1" aria-labelledby="jualModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jualModalLabel">Konfirmasi Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menjual kambing ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="{{ url('admin/pemeliharaan/jual/1') }}" class="btn btn-danger">Jual</a>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
