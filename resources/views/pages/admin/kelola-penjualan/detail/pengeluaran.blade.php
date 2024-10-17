@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Topbar --}}
            @include('components.topbar.topbar-penjualan')
            {{-- End Topbar --}}

            <form action="{{ '/admin/penjualan/detail/pengeluaran/' . $idAnimal }}" method="GET" id="filterForm">
                <div class="row mb-3 mt-4">
                    <div class="col-md-6">
                        <label for="start-date" class="form-label">Dari Tanggal</label>
                        <input type="date" id="start-date" name="tanggal_awal" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-6">
                        <label for="end-date" class="form-label">Sampai Tanggal</label>
                        <input type="date" id="end-date" name="tanggal_akhir" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-12 mt-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary py-2">Filter</button>
                    </div>
                </div>
            </form>

            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody id="pengeluaranTableBody">
                                    @forelse($expenses as $expense)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d F Y') }}</td>
                                        <td>{{ $expense->description }}</td>
                                        <td>Rp {{ number_format($expense->price, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data pengeluaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="form-actions d-flex justify-content-end grid gap-1 mt-3">
                            <a href="{{ url('admin/pemeliharaan') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengeluaran -->
    <div class="modal fade" id="tambahPengeluaranModal" tabindex="-1" aria-labelledby="tambahPengeluaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('admin/pengeluaran/tambah') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPengeluaranModalLabel">Tambah Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Pengeluaran</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
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

    <!-- Modal Edit Pengeluaran (Opsional) -->
    <div class="modal fade" id="editPengeluaranModal" tabindex="-1" aria-labelledby="editPengeluaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('admin/pengeluaran/edit') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPengeluaranModalLabel">Edit Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editTanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="editTanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="editKeterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="editKeterangan" name="keterangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="editJumlah" class="form-label">Jumlah Pengeluaran</label>
                            <input type="number" class="form-control" id="editJumlah" name="jumlah" required>
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

@endsection
