
@extends('layouts.app')

@section('title', 'Data Daftar Service')

@section('content')

<style>
    :root {
        --monster: #95D600;
        --dark: #17191f;
    }

    .service-page {
        min-height: calc(100vh - 90px);
        padding: 30px 38px;
        margin: -30px -38px;
        width: calc(100% + 76px);
        background:
            linear-gradient(
                rgba(15, 18, 23, .88),
                rgba(15, 18, 23, .94)
            ),
            url('/images/motogp-k.jfif') center center / cover no-repeat fixed;
        border-radius: 0;
        box-sizing: border-box;
    }

    .service-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .service-heading h2 {
        color: white;
        font-weight: 900;
        letter-spacing: 1px;
        margin: 0;
    }

    .service-heading p {
        color: #aeb5bf;
        margin: 5px 0 0;
        font-size: 13px;
    }

    .btn-add-service {
        background: var(--monster);
        color: #17191f;
        border: none;
        border-radius: 9px;
        padding: 12px 18px;
        font-weight: 800;
        text-decoration: none;
        transition: .3s;
    }

    .btn-add-service:hover {
        background: white;
        color: #17191f;
        transform: translateY(-3px);
    }

    .service-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .stat-box {
        padding: 18px;
        border: 1px solid rgba(255,255,255,.13);
        border-radius: 13px;
        background: rgba(255,255,255,.07);
        backdrop-filter: blur(10px);
    }

    .stat-box small {
        color: #aeb5bf;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .stat-box h3 {
        color: var(--monster);
        font-size: 27px;
        font-weight: 900;
        margin: 7px 0 0;
    }

    .search-panel {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 25px;
        backdrop-filter: blur(10px);
    }

    .search-panel i {
        color: var(--monster);
        font-size: 20px;
    }

    .search-panel input {
        background: transparent;
        border: none;
        outline: none;
        color: white;
        width: 100%;
        font-size: 14px;
    }

    .search-panel input::placeholder {
        color: #aeb5bf;
    }

    .service-card {
        position: relative;
        min-height: 310px;
        border-radius: 17px;
        overflow: hidden;
        background-size: cover;
        background-position: center;
        border: 1px solid rgba(255,255,255,.2);
        box-shadow: 0 8px 25px rgba(0,0,0,.35);
        transition: .35s;
        animation: cardAppear .5s ease both;
    }

    .service-card:hover {
        transform: translateY(-6px);
        border-color: var(--monster);
        box-shadow: 0 14px 30px rgba(149,214,0,.16);
    }

    .card-overlay {
        position: absolute;
        inset: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: linear-gradient(
            180deg,
            rgba(10,12,15,.70) 0%,
            rgba(10,12,15,.50) 45%,
            rgba(10,12,15,.94) 100%
        );
    }

    .card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
    }

    .service-number {
        background: var(--monster);
        color: #17191f;
        font-size: 11px;
        font-weight: 900;
        padding: 7px 11px;
        border-radius: 6px;
    }

    .service-date {
        color: white;
        font-size: 11px;
        font-weight: 700;
        background: rgba(0,0,0,.35);
        padding: 7px 10px;
        border-radius: 6px;
    }

    .card-middle {
        margin-top: 20px;
    }

    .card-plate {
        color: white;
        font-size: 25px;
        font-weight: 950;
        letter-spacing: 1px;
        margin-bottom: 5px;
        text-shadow: 0 3px 8px rgba(0,0,0,.5);
    }

    .card-customer {
        color: var(--monster);
        font-size: 14px;
        font-weight: 800;
    }

    .card-divider {
        height: 1px;
        background: rgba(255,255,255,.25);
        margin: 15px 0;
    }

    .complaint-label {
        color: var(--monster);
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 1.2px;
        margin-bottom: 6px;
    }

    .complaint-text {
        color: white;
        font-size: 13px;
        line-height: 1.5;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .btn-detail {
        background: transparent;
        border: none;
        padding: 7px 0 0;
        color: var(--monster);
        font-size: 11px;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-detail:hover {
        color: white;
    }

    .card-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top: 15px;
    }

    .customer-id {
        color: #d9dce1;
        font-size: 11px;
        font-weight: 700;
    }

    .card-actions {
        display: flex;
        gap: 7px;
    }

    .btn-card {
        border: none;
        padding: 7px 11px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-edit {
        color: #17191f;
        background: var(--monster);
    }

    .btn-delete {
        color: white;
        background: #dc3545;
    }

    .btn-card:hover {
        filter: brightness(1.15);
        color: white;
    }

    .empty-service {
        display: none;
        text-align: center;
        color: white;
        padding: 55px 15px;
        background: rgba(255,255,255,.06);
        border: 1px dashed rgba(255,255,255,.2);
        border-radius: 15px;
    }

    .empty-service i {
        color: var(--monster);
        font-size: 40px;
    }

    .empty-service h5 {
        margin-top: 12px;
        font-weight: 800;
    }

    .modal-content {
        background: #20242b;
        color: white;
        border: 1px solid rgba(149,214,0,.4);
        border-radius: 15px;
    }

    .modal-header {
        border-bottom: 1px solid rgba(255,255,255,.12);
    }

    .modal-title {
        color: var(--monster);
        font-weight: 900;
    }

    .modal-body {
        color: #e4e7eb;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .modal-footer {
        border-top: 1px solid rgba(255,255,255,.12);
    }

    .btn-close {
        filter: invert(1);
    }

    @keyframes cardAppear {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media(max-width: 768px) {
        .service-page {
            padding: 20px 15px;
            margin: -20px -14px;
            width: calc(100% + 28px);
        }

        .service-stats {
            grid-template-columns: 1fr;
        }

        .service-card {
            min-height: 300px;
        }

        .service-heading {
            align-items: flex-start;
        }

        .card-bottom {
            flex-wrap: wrap;
        }
    }
</style>

<div class="service-page">

    {{-- HEADER --}}
    <div class="service-heading">
        <div>
            <h2>DATA DAFTAR SERVICE</h2>
            <p>Kelola seluruh antrean dan permintaan service kendaraan.</p>
        </div>

        <a href="{{ route('daftar-service.create') }}"
           class="btn-add-service">
            <i class="bi bi-plus-circle-fill"></i>
            TAMBAH SERVICE
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="service-stats">

        <div class="stat-box">
            <small>TOTAL SERVICE</small>
            <h3>{{ $daftarServices->count() }}</h3>
        </div>

        <div class="stat-box">
            <small>TOTAL PELANGGAN</small>
            <h3>{{ $daftarServices->pluck('pelanggan_id')->unique()->count() }}</h3>
        </div>

        <div class="stat-box">
            <small>TOTAL KENDARAAN</small>
            <h3>{{ $daftarServices->pluck('kendaraan_id')->unique()->count() }}</h3>
        </div>

    </div>

    {{-- PENCARIAN --}}
    <div class="search-panel">
        <i class="bi bi-search"></i>
        <input
            type="text"
            id="searchService"
            placeholder="Cari ID service, plat nomor, ID pelanggan, nama, atau keluhan..."
            autocomplete="off"
        >
    </div>

    {{-- KARTU SERVICE --}}
    <div class="row g-4" id="serviceContainer">

        @forelse($daftarServices as $service)

            @php
                $backgrounds = [
                    'satu.jfif',
                    'dua.jfif',
                    'tiga.jfif',
                    'empat.jfif',
                    'lima.jfif'
                ];

                $background = $backgrounds[$loop->index % count($backgrounds)];

                $searchText = strtolower(
                    $service->id . ' ' .
                    $service->kendaraan->nomor_polisi . ' ' .
                    $service->pelanggan_id . ' ' .
                    $service->pelanggan->nama_pelanggan . ' ' .
                    $service->keluhan . ' ' .
                    $service->tanggal_masuk
                );
            @endphp

            <div class="col-12 col-md-6 col-xl-4 service-item"
                 data-search="{{ $searchText }}">

                <div class="service-card"
                     style="background-image: url('{{ asset('images/' . $background) }}');">

                    <div class="card-overlay">

                        {{-- BAGIAN ATAS --}}
                        <div class="card-top">
                            <span class="service-number">
                                SERVICE #{{ str_pad($service->id, 3, '0', STR_PAD_LEFT) }}
                            </span>

                            <span class="service-date">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($service->tanggal_masuk)->format('d/m/Y') }}
                            </span>
                        </div>

                        {{-- BAGIAN TENGAH --}}
                        <div class="card-middle">

                            <div class="card-plate">
                                {{ $service->kendaraan->nomor_polisi }}
                            </div>

                            <div class="card-customer">
                                <i class="bi bi-person-fill"></i>
                                {{ $service->pelanggan->nama_pelanggan }}
                            </div>

                            <div class="card-divider"></div>

                            <div class="complaint-label">
                                KELUHAN KENDARAAN
                            </div>

                            <p class="complaint-text">
                                {{ \Illuminate\Support\Str::limit($service->keluhan, 55, '...') }}
                            </p>

                            @if(strlen($service->keluhan) > 55)
                                <button
                                    type="button"
                                    class="btn-detail"
                                    data-bs-toggle="modal"
                                    data-bs-target="#keluhanModal{{ $service->id }}">
                                    LIHAT DETAIL <i class="bi bi-arrow-right"></i>
                                </button>
                            @endif

                        </div>

                        {{-- BAGIAN BAWAH --}}
                        <div class="card-bottom">

                            <span class="customer-id">
                                ID PELANGGAN: #{{ $service->pelanggan_id }}
                            </span>

                            <div class="card-actions">

                                <a href="{{ route('daftar-service.edit', $service->id) }}"
                                   class="btn-card btn-edit">
                                    <i class="bi bi-pencil-square"></i>
                                    EDIT
                                </a>

                                <form
                                    action="{{ route('daftar-service.destroy', $service->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data service ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-card btn-delete">
                                        <i class="bi bi-trash"></i>
                                        HAPUS
                                    </button>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="empty-service" style="display:block;">
                    <i class="bi bi-clipboard-x"></i>
                    <h5>Belum Ada Data Service</h5>
                    <p>Silakan tambahkan data service terlebih dahulu.</p>
                </div>
            </div>

        @endforelse

    </div>

    {{-- PESAN JIKA PENCARIAN TIDAK DITEMUKAN --}}
    <div class="empty-service mt-4" id="noSearchResult">
        <i class="bi bi-search"></i>
        <h5>Data Tidak Ditemukan</h5>
        <p>Coba gunakan kata kunci pencarian yang berbeda.</p>
    </div>

</div>

{{-- MODAL DETAIL KELUHAN --}}
@foreach($daftarServices as $service)

    @if(strlen($service->keluhan) > 55)

        <div class="modal fade"
             id="keluhanModal{{ $service->id }}"
             tabindex="-1"
             aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-wrench-adjustable-circle"></i>
                            DETAIL KELUHAN
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">

                        <p class="mb-2">
                            <strong>ID SERVICE:</strong>
                            #{{ $service->id }}
                        </p>

                        <p class="mb-2">
                            <strong>NO. PLAT:</strong>
                            {{ $service->kendaraan->nomor_polisi }}
                        </p>

                        <p class="mb-3">
                            <strong>NAMA PELANGGAN:</strong>
                            {{ $service->pelanggan->nama_pelanggan }}
                        </p>

                        <div class="complaint-label">
                            KELUHAN LENGKAP
                        </div>

                        <p style="white-space: pre-wrap; margin: 0;">{{ $service->keluhan }}</p>

                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-success"
                                data-bs-dismiss="modal">
                            TUTUP
                        </button>
                    </div>

                </div>
            </div>
        </div>

    @endif

@endforeach

{{-- SCRIPT PENCARIAN REAL-TIME --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchInput = document.getElementById('searchService');
        const serviceItems = document.querySelectorAll('.service-item');
        const noResult = document.getElementById('noSearchResult');

        searchInput.addEventListener('input', function () {

            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            serviceItems.forEach(function (item) {

                const searchData = item.dataset.search;

                if (searchData.includes(keyword)) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }

            });

            if (visibleCount === 0 && serviceItems.length > 0) {
                noResult.style.display = 'block';
            } else {
                noResult.style.display = 'none';
            }

        });

    });
</script>

@endsection
