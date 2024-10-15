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
                                <h4 class="card-title">2,500</h4> <!-- Ini jumlah total slot -->
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
                                <h4 class="card-title">1,200</h4> <!-- Ini jumlah slot tersedia -->
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
                                <h4 class="card-title">150</h4> <!-- Ini jumlah slot dalam pemeliharaan -->
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
                                <h4 class="card-title">1,150</h4> <!-- Ini jumlah slot terjual -->
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
                                <p class="card-category">Total Profit</p>
                                <h4 class="card-title">$ 50,000</h4> <!-- Ini jumlah total profit -->
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
                                <h4 class="card-title">$ 2,500</h4> <!-- Ini jumlah total profit aplikasi -->
                                <span class="badge bg-secondary">Aplikasi 5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
