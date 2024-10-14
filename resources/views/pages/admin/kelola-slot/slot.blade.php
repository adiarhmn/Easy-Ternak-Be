@extends('fragments.container-admin')
@section('css')
<style>
.card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    background-color: #f8f9fa; /* Ganti dengan warna yang diinginkan */
}
.cursor:hover {
    cursor: pointer;
}
</style>
@endsection
@section('content')
<ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="line-home-tab" data-bs-toggle="pill" href="#line-home" role="tab" aria-controls="line-home" aria-selected="true">Slot Tersedia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="line-profile-tab" data-bs-toggle="pill" href="#line-profile" role="tab" aria-controls="line-profile" aria-selected="false">Slot Penuh</a>
    </li>
</ul>

<div class="tab-content mt-3 mb-3" id="line-tabContent">
    <div class="tab-pane fade show active" id="line-home" role="tabpanel" aria-labelledby="line-home-tab">
    <div class="row mt-0 gap-0">
        @if($availableSlots->isEmpty())
            <p class="text-center mt-1">Tidak ada data slot tersedia!</p>
        @else
            @foreach($availableSlots as $slot)
            
            @if($slot->hasPendingInvestor)
                <a class="col-md-3 col-sm-6 mb-4 m-0 p-2" href="/admin/slot/detail/investor/{{$slot->id_animal}}">
                @else
                <a class="col-md-3 col-sm-6 mb-4 m-0 p-2" href="/admin/slot/detail/{{$slot->id_animal}}">
            @endif
                <div >
                    <div class="card m-0 cursor m-1">
                        <div class="card-content">
                            <div class="card-body p-3">
                                <div class="position-relative">
                                    <img class="card-img-bottom img-fluid rounded-3" src="{{ url('uploads/' . $slot->animalImage->first()->image) }}" 
                                        alt="Card image cap" style="height: 10rem; object-fit: cover;">
                                    <span class="badge bg-secondary position-absolute" style="bottom: 10px; left: 10px;">{{ $slot->subAnimalType->name }}</span>
                                    <small>
                                        <span class="badge bg-danger position-absolute fw-bold" style="top: 10px; left: 10px;">
                                            {{ $slot->investmentSlot->where('status', 'success')->count() }}/{{ $slot->total_slots }} tersedia
                                        </span>
                                    </small>

                                    <!-- Marker for pending investors -->
                                    @if($slot->hasPendingInvestor)
                                        <span class="badge bg-warning position-absolute fw-bold" style="top: 10px; right: 10px; font-size: 0.7em;">Ada pendaftar!</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="d-flex justify-content-end">
                                        <h5 class="card-text mt-0 pt-0 fw-bold"><small>{{ $slot->mitra->name }}</small></h5>
                                    </div>
                                    <small id='deskripsi' class="card-text mt-0 pt-0">
                                        {{ Str::limit($slot->description, 50) }}
                                    </small>
                                    <div class="d-flex justify-content-end mt-2">
                                        <h5 class="card-text"><small style="font-size: 0.6em">Dibuat: {{ $slot->created_at }}</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        @endif
    </div>
</div>


    <div class="tab-pane fade" id="line-profile" role="tabpanel" aria-labelledby="line-profile-tab">
        <div class="row mt-0">
            @if($fullSlots->isEmpty())
                <p class="text-center mt-1">Tidak ada data slot penuh!</p>
            @else
                @foreach($fullSlots as $slot)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card m-0">
                            <div class="card-content">
                                <div class="card-body p-3">
                                    <div class="position-relative">
                                        <img class="card-img-bottom img-fluid rounded-3" src="{{ url('uploads/' . $slot->animalImage->first()->image) }}" 
                                            alt="Card image cap" style="height: 10rem; object-fit: cover;">
                                        <span class="badge bg-secondary position-absolute" style="bottom: 10px; left: 10px;">{{ $slot->subAnimalType->name }}</span>
                                        <small>
                                            <span class="badge bg-success position-absolute fw-bold" style="top: 10px; right: 10px;">
                                                {{ $slot->investmentSlot->where('status', 'filled')->count() }}/{{ $slot->total_slots }} terisi
                                            </span>
                                        </small>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <div style="margin-right: 5px">
                                            <a href="{{ url('admin/slot/detail/'.$slot->id_animal) }}" class="btn btn-secondary btn-sm">Detail</a>
                                        </div>
                                        <div>
                                            <div>
                                                <a href="#" class="btn btn-danger btn-sm confirm-slot" data-slot-id="{{ $slot->id_animal }}" data-bs-toggle="modal" data-bs-target="#confirmModal">Confirm Slot</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Slot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengubah status slot ini ke tahap "Pemeliharaan"?
            </div>
            <div class="modal-footer">
                <form id="confirmForm" action="{{ url('admin/slot/confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="slot_id" id="slotId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmButtons = document.querySelectorAll('.confirm-slot');

        confirmButtons.forEach(button => {
            button.addEventListener('click', function() {
                const slotId = this.getAttribute('data-slot-id');
                document.getElementById('slotId').value = slotId;
            });
        });
    });
</script>
@endsection
