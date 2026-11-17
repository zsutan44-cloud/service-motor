
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="hero">
    <div class="hero-content">
        <span class="badge bg-danger mb-3">MOTOCARE SERVICE CENTER</span>

        <h1>
            KEEP YOUR BIKE<br>
            <span>IN PERFECT CONDITION.</span>
        </h1>

        <p>
            Kelola perawatan kendaraan, data pelanggan,
            dan pelayanan bengkel dalam satu sistem
            yang mudah dan modern.
        </p>

        <a href="/daftar-service" class="btn-service">
            <i class="bi bi-plus-circle me-2"></i>
            Daftarkan Service
        </a>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="section-title mb-1">Ringkasan Bengkel</h5>
        <small class="text-muted">Informasi aktivitas bengkel</small>
    </div>

    <span class="badge bg-light text-dark border">
        <i class="bi bi-activity text-danger me-1"></i>
        Dashboard
    </span>
</div>

<div class="row g-3">

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                <i class="bi bi-people"></i>
            </div>
            <h6>Total Pelanggan</h6>
            <h2>{{ $totalPelanggan }}</h2>
            <small class="text-muted">Pelanggan terdaftar</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-bicycle"></i>
            </div>
            <h6>Total Kendaraan</h6>
            <h2>{{ $totalKendaraan }}</h2>
            <small class="text-muted">Kendaraan terdaftar</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-tools"></i>
            </div>
            <h6>Daftar Service</h6>
            <h2>{{ $totalDaftarService }}</h2>
            <small class="text-muted">Total pendaftaran</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i class="bi bi-wallet2"></i>
            </div>
            <h6>Pembayaran</h6>
            <h2>{{ $totalPembayaran }}</h2>
            <small class="text-muted">Total transaksi</small>
        </div>
    </div>

</div>

<div class="row g-3 mt-2">

    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon bg-info bg-opacity-10 text-info">
                <i class="bi bi-clipboard-check"></i>
            </div>
            <h6>Total Data Service</h6>
            <h2>{{ $totalDataService }}</h2>
            <small class="text-muted">Pengerjaan service kendaraan</small>
        </div>
    </div>

    <div class="col-md-6">
        <div class="content-card h-100 d-flex align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-danger bg-opacity-10 text-danger mb-0">
                    <i class="bi bi-wrench-adjustable"></i>
                </div>

                <div>
                    <h6 class="fw-bold mb-1">Pelayanan Bengkel MotoCare</h6>
                    <small class="text-muted">
                        Sistem siap membantu pengelolaan aktivitas
                        service kendaraan secara terorganisir.
                    </small>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
