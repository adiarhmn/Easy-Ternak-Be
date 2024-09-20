@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Profil Mitra EasyTernak</h3>


            <!-- Menampilkan pesan sukses -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Menampilkan pesan sukses -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form id="profileForm" action="{{ url('admin/pengguna/mitra/update/1') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Bagian Kiri: Informasi Utama --}}
                <div class="row mt-4">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $mitra->name) }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $mitra->address) }}">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $mitra->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. Handphone</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $mitra->telephone) }}">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slot_aktif" class="form-label">Slot Aktif</label>
                            <input type="number" class="form-control" id="slot_aktif" readonly name="slot_aktif" value="1">
                        </div>
                        <div class="mb-3">
                            <label for="slo" class="form-label">Slot Terjual</label>
                            <input type="number" class="form-control" id="terjual" name="terjual" readonly value="0">
                        </div>
                    </div>

                    {{-- Bagian Kanan Informasi Tambahan --}}
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="bank" class="form-label">Bank</label>
                            <input type="text" class="form-control @error('bank') is-invalid @enderror" id="bank" name="bank" value="{{ old('bank', $mitra->payment_name) }}">
                            @error('bank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="akun_bank" class="form-label">Akun Bank</label>
                            <input type="text" class="form-control @error('akun_bank') is-invalid @enderror" id="akun_bank" name="akun_bank" value="{{ old('akun_bank', $mitra->payment_account) }}">
                            @error('akun_bank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_rek" class="form-label">No. Rekening</label>
                            <input type="text" class="form-control @error('no_rek') is-invalid @enderror" id="no_rek" name="no_rek" value="{{ old('no_rek', $mitra->payment_number) }}">
                            @error('no_rek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ktp" class="form-label">KTP</label>
                            <input type="file" class="form-control @error('ktp') is-invalid @enderror" id="ktp" name="ktp">
                            @error('ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <a target="_blank" href="{{ url($ktpImage) }}">
                                <img src="{{ url($ktpImage) }}" alt="KTP Image" style="width: 100%; max-width: 200px; height: auto; margin-top: 10px;">
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <!-- Button untuk Memicu Modal Simpan -->
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#saveModal">Simpan</button>

                        <!-- Button untuk Memicu Modal Hapus -->
                        {{-- <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">Hapus</button> --}}
                        <a href="{{ url('admin/pengguna/mitra') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Simpan -->
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveModalLabel">Konfirmasi Simpan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menyimpan perubahan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-success" onclick="document.getElementById('profileForm').submit();">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus profil ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{ url('admin/mitra/delete/1') }}" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection
