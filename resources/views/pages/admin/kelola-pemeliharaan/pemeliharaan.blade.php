@extends('fragments.container-admin')

@section('content')
    <div class="row mt-0">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($animals->isEmpty())
            <div class="col-12">
                <div class="alert alert-secondary" role="alert">
                    Tidak ada data hewan dalam proses pemeliharaan.
                </div>
            </div>
        @else
            @foreach ($animals as $animal)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card m-0">
                        <div class="card-content">
                            <div class="card-body p-3">
                                <div class="position-relative">
                                    <img class="card-img-bottom img-fluid rounded-3" src="{{ url('uploads/' . $animal->animalImage->first()->image) }}"
                                         alt="Card image cap" style="height: 10rem; object-fit: cover;">
                                    <span class="badge bg-secondary position-absolute" style="bottom: 10px; right: 10px;">{{ $animal->subAnimalType->name ?? 'Kambing Boer' }}</span>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-end">
                                        <h5 class="card-text mt-0 pt-0 fw-bold"><small>{{ $animal->mitra->name ?? 'Tekad Jaya Farm' }}</small></h5>
                                    </div>
                                    <small id='deskripsi' class="card-text mt-0 pt-0">
                                        {{ Str::limit($animal->description ?? 'Usia 15 bulan Tinggi 82cm Berat 16 Kg Kambing Hitam', 50) }}
                                    </small>
                                    <div class="d-flex justify-content-end mt-2">
                                        <h5 class="card-text text-danger"><small>Sisa {{ $animal->remainingDays }} hari</small></h5>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <div style="margin-right: 5px" class="ml-auto">
                                            <a href="{{url('admin/pemeliharaan/progres/'.$animal->id_animal)}}" class="btn btn-secondary btn-sm">Lihat Progress</a>
                                        </div>
                                        <div class="ml-auto">
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $animal->id_animal }}">Jual</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menjual hewan ini?
                </div>
                <div class="modal-footer">
                    <form id="confirmSaleForm" method="POST" action="{{ url('admin/pemeliharaan/jual') }}">
                        @csrf
                        <input type="hidden" name="animal_id" id="animal_id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Jual</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Set the animal ID to the hidden input in the form when the modal is shown
    var confirmModal = document.getElementById('confirmModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var animalId = button.getAttribute('data-id'); // Extract info from data-* attributes
        var modalBodyInput = confirmModal.querySelector('#animal_id');
        modalBodyInput.value = animalId; // Update the modal's content
    });
</script>
@endsection
