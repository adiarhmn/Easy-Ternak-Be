@extends('fragments.container-admin')

@section('content')
    <div class="row">
        <!-- Total Slot -->
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-list"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Slot</p>
                                <h4 class="card-title">{{ $totalSlot }}</h4> <!-- Data dari controller -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slot Tersedia -->
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-archive"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Slot Tersedia</p>
                                <h4 class="card-title">{{ $slotTersedia }}</h4> <!-- Data dari controller -->
                                <span class="badge bg-success">Tersedia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slot Dalam Pemeliharaan -->
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-warehouse"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Slot Pemeliharaan</p>
                                <h4 class="card-title">{{ $slotPemeliharaan }}</h4> <!-- Data dari controller -->
                                <span class="badge bg-warning">Pemeliharaan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slot Terjual -->
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-danger bubble-shadow-small">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Slot Terjual</p>
                                <h4 class="card-title">{{ $slotTerjual }}</h4> <!-- Data dari controller -->
                                <span class="badge bg-danger">Terjual</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Profit -->
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Profit <sup>(kotor)</sup></p>
                                <h4 class="card-title">Rp {{ number_format($totalProfit, 0, ',', '.') }}</h4> <!-- Data dari controller -->
                                <span class="badge bg-success">Profit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Total Profit Aplikasi (5%) -->
         <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-percentage"></i>                                                                                                                                                                                                                     
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Profit Aplikasi (5%)</p>
                                <h4 class="card-title">Rp {{ number_format($totalProfit * 0.05, 0, ',', '.') }}</h4> <!-- Ini jumlah total profit aplikasi dalam Rupiah -->
                                <span class="badge bg-secondary">Aplikasi 5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
