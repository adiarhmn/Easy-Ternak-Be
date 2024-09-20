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
                        <h5>Data Pengeluaran</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah Pengeluaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contoh baris data, ganti dengan data dinamis -->
                                    <tr>
                                        <td>1 Agustus 2024</td>
                                        <td>Pembelian Pakan</td>
                                        <td>Rp 500.000</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPengeluaranModal">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>15 Agustus 2024</td>
                                        <td>Perawatan Kandang</td>
                                        <td>Rp 250.000</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPengeluaranModal">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Tambahkan lebih banyak baris data di sini jika diperlukan -->
                                </tbody>
                            </table>
                        </div>

                        <div class="form-actions d-flex justify-content-end grid gap-1 mt-3">
                            <!-- Tombol untuk memicu modal tambah pengeluaran -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPengeluaranModal">
                                Tambah Pengeluaran
                            </button>
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
                        <!-- Form fields for editing -->
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
