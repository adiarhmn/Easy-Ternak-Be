<!-- resources/views/investasi/create.blade.php -->
@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Data Investasi</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('admin/slot/simpan') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="jenis_investasi">Jenis Investasi</label>
                    <input type="text" class="form-control" id="jenis_investasi" name="jenis_investasi" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kambing">Jenis Kambing</label>
                    <input type="text" class="form-control" id="jenis_kambing" name="jenis_kambing" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" required>
                </div>
                <div class="form-group">
                    <label for="mitra">Mitra</label>
                    <input type="text" class="form-control" id="mitra" name="mitra" required>
                </div>
                <div class="form-group">
                    <label for="investor">Investor</label>
                    <input type="text" class="form-control" id="investor" name="investor" required>
                </div>
                <div class="form-group">
                    <label for="transfer">Transfer</label>
                    <input type="text" class="form-control" id="transfer" name="transfer" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('admin/slot') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
