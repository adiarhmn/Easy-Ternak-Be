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
                        <!-- Konten halaman dapat ditambahkan di sini -->
                        <h5>Daftar Investor</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Investor</th>
                                        <th>Total Slot</th>
                                        <th>Jumlah Investasi</th>
                                        <th>Tanggal Investasi</th>
                                        {{-- <th>Detail</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contoh baris data, ganti dengan data dinamis -->
                                    <tr>
                                        <td>John Doe</td>
                                        <td>1</td>
                                        <td>Rp 10.000.000</td>
                                        <td>1 Januari 2024</td>
                                        {{-- <td>
                                            <a href="{{ url('admin/investor/detail/1') }}" class="btn btn-info btn-sm">Lihat Detail</a>
                                        </td> --}}
                                    </tr>
                                    <tr>
                                        <td>Jane Smith</td>
                                        <td>2</td>
                                        <td>Rp 5.000.000</td>
                                        <td>15 Februari 2024</td>
                                        {{-- <td>
                                            <a href="{{ url('admin/investor/detail/2') }}" class="btn btn-info btn-sm">Lihat Detail</a>
                                        </td> --}}
                                    </tr>
                                    <!-- Tambahkan baris lainnya sesuai data yang ada -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="form-actions d-flex justify-content-end grid gap-1">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#jualModal">
                                Jual
                            </button>
                        <a href="{{ url('admin/pemeliharaan') }}" class="btn btn-secondary">Kembali</a>
                    </div> --}}
                </div>
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
