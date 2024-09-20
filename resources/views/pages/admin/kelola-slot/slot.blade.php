@extends('fragments.container-admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Investasi</th>
                            <th>Jenis Kambing</th>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            <th>Mitra</th>
                            <th>Investor</th>
                            <th>Transfer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for ($i = 1; $i < 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>System Architect</td>
                            <td>Kambing Hitam</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>2011/04/25</td>
                            <td>2011/04/25</td>
                            <td>2011/04/25</td>
                            <td>2011/04/25</td>
                            <td class="col-4">
                                <button type="button" class="btn btn-sm btn-icon btn-round btn-info d-inline-block">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-round btn-danger d-inline-block">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-round btn-success d-inline-block">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
<script>
    $(document).ready(function() {
        $('#multi-filter-select').DataTable();
    });
</script>
