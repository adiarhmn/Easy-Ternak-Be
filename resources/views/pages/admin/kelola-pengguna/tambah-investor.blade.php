@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Investor</h4>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('admin/pengguna/investor/simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" class="form-control" required>{{ old('address') }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ktp">KTP (Opsional)</label>
                            <input type="file" name="ktp" id="ktp" class="form-control" accept="image/*" onchange="previewKtp(event)">
                            @error('ktp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <img id="ktp-preview" src="#" alt="KTP Preview" style="display:none; margin-top:10px; max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 8px;">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_name">Nama Bank</label>
                            <input type="text" name="payment_name" id="payment_name" class="form-control" value="{{ old('payment_name') }}" required>
                            @error('payment_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payment_account">Nama Rekening</label>
                            <input type="text" name="payment_account" id="payment_account" class="form-control" value="{{ old('payment_account') }}" required>
                            @error('payment_account')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payment_number">Nomor Rekening</label>
                            <input type="text" name="payment_number" id="payment_number" class="form-control" value="{{ old('payment_number') }}" required>
                            @error('payment_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telephone">No Handphone</label>
                            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}" required>
                            @error('telephone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewKtp(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var preview = document.getElementById('ktp-preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
