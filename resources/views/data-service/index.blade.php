
@extends('layouts.app')

@section('title', 'Data Service')

@section('content')

<style>
    .workshop-page {
        position: relative;
        min-height: 100vh;
        padding: 30px;
        color: #fff;
        background:
            linear-gradient(115deg, rgba(12,14,19,.94), rgba(12,14,19,.78)),
            url('{{ asset("images/mekanik.jfif") }}') center/cover fixed;
    }

    .workshop-content {
        max-width: 1500px;
        margin: auto;
    }

    .workshop-topline {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 35px;
        flex-wrap: wrap;
    }

    .workshop-brand {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 3px;
        color: #f59e0b;
    }

    .workshop-date {
        font-size: 12px;
        color: #c3c6ce;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.12);
        padding: 9px 14px;
        border-radius: 30px;
    }

    .hero-section {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .hero-section h1 {
        font-size: clamp(30px, 4vw, 48px);
        font-weight: 900;
        letter-spacing: -2px;
        margin: 8px 0;
    }

    .hero-section h1 span {
        color: #f59e0b;
    }

    .hero-section p {
        color: #c1c3ca;
        max-width: 550px;
        font-size: 14px;
        margin: 0;
    }

    .hero-icon {
        width: 105px;
        height: 105px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 55px;
        color: #fbbf24;
        background: rgba(245,158,11,.1);
        border: 1px solid rgba(245,158,11,.3);
        border-radius: 25px;
        transform: rotate(4deg);
    }

    .add-job-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: #f59e0b;
        color: #17191f;
        text-decoration: none;
        font-weight: 800;
        padding: 13px 19px;
        border-radius: 10px;
        margin-top: 22px;
        transition: .25s;
    }

    .add-job-btn:hover {
        background: #fbbf24;
        color: #17191f;
        transform: translateY(-3px);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 35px;
    }

    .stat-card {
        background: rgba(25,28,35,.78);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 15px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .stat-label {
        font-size: 11px;
        letter-spacing: 1px;
        color: #a6a9b2;
        font-weight: 700;
    }

    .stat-value {
        font-size: 29px;
        font-weight: 900;
        margin-top: 5px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        font-size: 23px;
        color: #fbbf24;
        background: rgba(245,158,11,.13);
    }

    .stat-card:nth-child(2) .stat-icon {
        color: #60a5fa;
        background: rgba(59,130,246,.13);
    }

    .stat-card:nth-child(3) .stat-icon {
        color: #4ade80;
        background: rgba(34,197,94,.13);
    }

    .section-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .section-heading h4 {
        font-size: 19px;
        font-weight: 800;
        margin: 0;
    }

    .section-heading p {
        color: #9ca3af;
        font-size: 12px;
        margin: 5px 0 0;
    }

    .search-box {
        position: relative;
        width: 320px;
        max-width: 100%;
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #a1a1aa;
    }

    .search-box input {
        width: 100%;
        background: rgba(25,28,35,.9);
        color: #fff;
        border: 1px solid rgba(255,255,255,.15);
        padding: 12px 14px 12px 40px;
        border-radius: 10px;
        outline: none;
    }

    .search-box input:focus {
        border-color: #f59e0b;
    }

    .search-box input::placeholder {
        color: #858995;
    }

    .job-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .job-card {
        position: relative;
        overflow: hidden;
        background: rgba(25,28,35,.91);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 16px;
        transition: .25s;
    }

    .job-card:hover {
        transform: translateY(-4px);
        border-color: rgba(245,158,11,.5);
        box-shadow: 0 15px 35px rgba(0,0,0,.25);
    }

    .job-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: #f59e0b;
    }

    .job-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 18px 20px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .job-number {
        font-size: 13px;
        font-weight: 900;
        color: #fbbf24;
        letter-spacing: .5px;
    }

    .job-type {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        padding: 6px 10px;
        border-radius: 20px;
        background: rgba(34,197,94,.12);
        color: #86efac;
    }

    .job-card-body {
        padding: 20px;
    }

    .customer-block {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 22px;
    }

    .customer-avatar {
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: rgba(245,158,11,.13);
        color: #fbbf24;
        font-size: 20px;
    }

    .customer-block h5 {
        font-size: 15px;
        font-weight: 800;
        margin: 0 0 4px;
    }

    .customer-block small {
        color: #9ca3af;
        font-size: 11px;
    }

    .vehicle-tag {
        margin-left: auto;
        background: #343741;
        border: 1px solid #555963;
        color: #fff;
        padding: 7px 10px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .job-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 17px;
        margin-bottom: 18px;
    }

    .info-label {
        display: block;
        color: #858995;
        font-size: 10px;
        letter-spacing: 1px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .info-value {
        color: #e5e7eb;
        font-size: 13px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .mechanic-row {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,.045);
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 17px;
    }

    .mechanic-row i {
        color: #fbbf24;
        font-size: 19px;
    }

    .mechanic-row small {
        display: block;
        color: #858995;
        font-size: 10px;
    }

    .mechanic-row strong {
        font-size: 12px;
    }

    .job-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .detail-btn {
        border: 1px solid rgba(245,158,11,.4);
        background: rgba(245,158,11,.1);
        color: #fbbf24;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 800;
    }

    .detail-btn:hover {
        background: #f59e0b;
        color: #17191f;
    }

    .action-buttons {
        display: flex;
        gap: 7px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        text-decoration: none;
        border: none;
    }

    .edit-btn {
        color: #60a5fa;
        background: rgba(59,130,246,.13);
    }

    .delete-btn {
        color: #f87171;
        background: rgba(239,68,68,.13);
    }

    .edit-btn:hover {
        background: #2563eb;
        color: #fff;
    }

    .delete-btn:hover {
        background: #dc2626;
        color: #fff;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 55px 20px;
        background: rgba(25,28,35,.9);
        border: 1px dashed rgba(255,255,255,.2);
        border-radius: 15px;
        color: #9ca3af;
    }

    .empty-state i {
        display: block;
        font-size: 45px;
        color: #f59e0b;
        margin-bottom: 15px;
    }

    .no-result {
        display: none;
        text-align: center;
        padding: 35px;
        color: #a1a1aa;
        background: rgba(25,28,35,.9);
        border-radius: 14px;
        margin-top: 15px;
    }

    .modal-content {
        background: #22252d;
        color: #fff;
        border: 1px solid rgba(245,158,11,.3);
        border-radius: 15px;
    }

    .modal-header,
    .modal-footer {
        border-color: rgba(255,255,255,.1);
    }

    .modal-detail {
        padding: 17px;
        background: #17191f;
        border-radius: 10px;
        color: #e5e7eb;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        line-height: 1.7;
    }

    .btn-close {
        filter: invert(1);
    }

    @media(max-width: 900px) {
        .job-grid {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 600px) {
        .workshop-page {
            padding: 18px;
            background-attachment: scroll;
        }

        .hero-section {
            grid-template-columns: 1fr;
        }

        .hero-icon {
            display: none;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .search-box {
            width: 100%;
        }

        .job-info-grid {
            gap: 13px;
        }
    }
</style>

<div class="workshop-page">
    <div class="workshop-content">

        <div class="workshop-topline">
            <div class="workshop-brand">
                <i class="bi bi-speedometer2 me-2"></i>
                MOTOCARE / WORKSHOP CONTROL CENTER
            </div>

            <div class="workshop-date">
                <i class="bi bi-gear-wide-connected me-2"></i>
                SERVICE MANAGEMENT SYSTEM
            </div>
        </div>

        <div class="hero-section">
            <div>
                <div class="workshop-brand">WORKSHOP OPERATIONS</div>

                <h1>
                    MANAGE YOUR<br>
                    <span>SERVICE JOBS.</span>
                </h1>

                <p>
                    Pantau pengerjaan kendaraan, mekanik yang bertugas,
                    estimasi waktu, dan sparepart dalam satu tempat.
                </p>

                <a href="{{ route('data-service.create') }}" class="add-job-btn">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Pengerjaan
                </a>
            </div>

            <div class="hero-icon">
                <i class="bi bi-tools"></i>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="stats-grid">

            <div class="stat-card">
                <div>
                    <div class="stat-label">TOTAL PENGERJAAN</div>
                    <div class="stat-value">{{ $dataServices->count() }}</div>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-clipboard2-check"></i>
                </div>
            </div>

            <div class="stat-card">
                <div>
                    <div class="stat-label">MEKANIK TERLIBAT</div>
                    <div class="stat-value">
                        {{ $dataServices->pluck('nama_mekanik')->filter()->unique()->count() }}
                    </div>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-person-gear"></i>
                </div>
            </div>

            <div class="stat-card">
                <div>
                    <div class="stat-label">SPAREPART TERCATAT</div>
                    <div class="stat-value">
                        {{ $dataServices->filter(fn($item) => !empty($item->sparepart_pengganti))->count() }}
                    </div>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-nut"></i>
                </div>
            </div>

        </div>

        <div class="section-heading">
            <div>
                <h4>
                    <i class="bi bi-grid-1x2-fill text-warning me-2"></i>
                    Service Job Overview
                </h4>

                <p>Daftar seluruh pengerjaan kendaraan yang telah dicatat.</p>
            </div>

            <div class="search-box">
                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchService"
                    placeholder="Cari pelanggan, plat, mekanik..."
                >
            </div>
        </div>

        <div class="job-grid" id="jobGrid">

            @forelse ($dataServices as $data)

                <div class="job-card">

                    <div class="job-card-header">
                        <div class="job-number">
                            <i class="bi bi-hash me-1"></i>
                            DS-{{ str_pad($data->id, 3, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="job-type">
                            <i class="bi bi-check-circle me-1"></i>
                            TERCATAT
                        </div>
                    </div>

                    <div class="job-card-body">

                        <div class="customer-block">
                            <div class="customer-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>

                            <div>
                                <h5>
                                    {{ $data->daftarService->pelanggan->nama_pelanggan ?? 'Pelanggan tidak tersedia' }}
                                </h5>

                                <small>
                                    ID Daftar Service #{{ $data->daftar_service_id }}
                                </small>
                            </div>

                            <div class="vehicle-tag">
                                <i class="bi bi-car-front me-1"></i>
                                {{ $data->daftarService->kendaraan->no_plat ?? '-' }}
                            </div>
                        </div>

                        <div class="job-info-grid">

                            <div>
                                <span class="info-label">ESTIMASI PENGERJAAN</span>

                                <div class="info-value">
                                    <i class="bi bi-clock text-warning me-1"></i>
                                    {{ $data->estimasi_service }}
                                </div>
                            </div>

                            <div>
                                <span class="info-label">SPAREPART PENGGANTI</span>

                                <div class="info-value">
                                    {{ $data->sparepart_pengganti ?: 'Tidak ada' }}
                                </div>
                            </div>

                        </div>

                        <div class="mechanic-row">
                            <i class="bi bi-person-workspace"></i>

                            <div>
                                <small>MEKANIK BERTUGAS</small>
                                <strong>{{ $data->nama_mekanik }}</strong>
                            </div>
                        </div>

                        <div class="job-footer">

                            <button
                                type="button"
                                class="detail-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $data->id }}"
                            >
                                <i class="bi bi-eye me-1"></i>
                                Lihat Keluhan
                            </button>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('data-service.edit', $data->id) }}"
                                    class="action-btn edit-btn"
                                    title="Edit Data"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form
                                    action="{{ route('data-service.destroy', $data->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data service ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn"
                                        title="Hapus Data"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL DETAIL KELUHAN --}}
                <div
                    class="modal fade"
                    id="detailModal{{ $data->id }}"
                    tabindex="-1"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">
                                    <i class="bi bi-clipboard2-pulse text-warning me-2"></i>
                                    Detail Keluhan
                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <span class="info-label">ID DATA SERVICE</span>

                                    <div class="fw-bold text-warning">
                                        DS-{{ str_pad($data->id, 3, '0', STR_PAD_LEFT) }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <span class="info-label">PELANGGAN</span>

                                    <div class="fw-semibold">
                                        {{ $data->daftarService->pelanggan->nama_pelanggan ?? '-' }}
                                    </div>
                                </div>

                                <div>
                                    <span class="info-label">KELUHAN KENDARAAN</span>

                                    <div class="modal-detail mt-2">
                                        {{ $data->daftarService->keluhan ?? 'Tidak ada keluhan tercatat.' }}
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Tutup
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            @empty

                <div class="empty-state">
                    <i class="bi bi-tools"></i>

                    <h5 class="text-white fw-bold">Belum Ada Pengerjaan</h5>

                    <p class="small mb-3">
                        Belum ada data service yang tercatat di sistem.
                    </p>

                    <a href="{{ route('data-service.create') }}" class="add-job-btn">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Data Pertama
                    </a>
                </div>

            @endforelse

        </div>

        <div class="no-result" id="noResult">
            <i class="bi bi-search fs-3 d-block mb-2"></i>
            Data pengerjaan yang kamu cari tidak ditemukan.
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchInput = document.getElementById('searchService');
        const jobCards = document.querySelectorAll('.job-card');
        const noResult = document.getElementById('noResult');

        if (searchInput) {
            searchInput.addEventListener('input', function () {

                const keyword = this.value.toLowerCase().trim();
                let visible = 0;

                jobCards.forEach(function (card) {

                    const match = card.textContent
                        .toLowerCase()
                        .includes(keyword);

                    card.style.display = match ? '' : 'none';

                    if (match) {
                        visible++;
                    }
                });

                if (noResult) {
                    noResult.style.display =
                        visible === 0 && jobCards.length > 0
                            ? 'block'
                            : 'none';
                }
            });
        }

    });
</script>

@endsection
