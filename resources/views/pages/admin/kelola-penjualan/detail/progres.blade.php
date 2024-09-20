@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Topbar --}}
            @include('components.topbar.topbar-penjualan')
            {{-- End Topbar --}}
            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="line-home-tab">
                    <div class="card-body">
                        <h5>Progress Pemeliharaan Kambing</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan Progress</th>
                                        <th>Bukti Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contoh baris data, ganti dengan data dinamis -->
                                    <tr>
                                        <td>1 Januari 2024</td>
                                        <td>Proses vaksinasi kambing</td>
                                        <td>
                                            <a href="{{ asset('images/kambing2.jpeg') }}" target="_blank">
                                                <img src="{{ asset('images/kambing2.jpeg') }}" alt="Bukti Progress 1" class="img-thumbnail" style="max-width: 100px;">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1 Februari 2024</td>
                                        <td>Penambahan pakan kambing</td>
                                        <td>
                                            <a href="{{ asset('images/kambing3.jpeg') }}" target="_blank">
                                                <img src="{{ asset('images/kambing3.jpeg') }}" alt="Bukti Progress 2" class="img-thumbnail" style="max-width: 100px;">
                                            </a>
                                        </td>
                                    </tr>
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
