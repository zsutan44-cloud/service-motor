
@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')

<style>
    /* BACKGROUND */
    body {
        background-color: #090a0e !important;
        color: white !important;
    }

    .customer-page {
        color: white;
    }

    /* FOTO BACKGROUND */
    .customer-page::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background:
            linear-gradient(rgba(8,10,15,.58), rgba(8,10,15,.78)),
            url('/images/motor-racing.jfif') center / cover no-repeat;
    }

    /* TRANSPARANSI AREA */
    .customer-page .customer-card {
        background: rgba(12,14,20,.62) !important;
        border: 1px solid rgba(255,255,255,.17);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 15px;
        color: white !important;
        box-shadow: 0 8px 25px rgba(0,0,0,.25);
    }

    /* HEADER */
    .page-heading h4 {
        color: white;
        font-weight: 800;
        font-size: 27px;
    }

    .page-heading p {
        color: #d0d0d0;
    }

    .heading-label {
        color: #ff343b;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    /* BUTTON */
    .btn-add {
        background: #d71920;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 11px 17px;
        font-weight: 600;
    }

    .btn-add:hover {
        background: #a90f16;
        color: white;
        transform: translateY(-2px);
    }

    /* STATISTIK */
    .customer-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(215,25,32,.2);
        color: #ff454b;
        font-size: 22px;
    }

    .customer-card small {
        color: #c5c5c5;
    }

    .customer-card h3,
    .customer-card h6 {
        color: white;
    }

    /* SEARCH */
    .search-box {
        width: 270px;
        max-width: 100%;
        padding: 10px 14px 10px 40px;
        background: rgba(255,255,255,.07);
        color: white;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 9px;
        outline: none;
    }

    .search-box::placeholder {
        color: #bdbdbd;
    }

    .search-box:focus {
        border-color: #ed252c;
        box-shadow: 0 0 0 3px rgba(215,25,32,.15);
    }

    /* TABEL */
    .customer-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 6px;

        /* Override Bootstrap table */
        --bs-table-bg: transparent;
        --bs-table-color: white;
        --bs-table-hover-bg: rgba(215,25,32,.15);
        --bs-table-hover-color: white;
    }

    .customer-table thead th {
        background: rgba(190,15,23,.88) !important;
        color: white !important;
        padding: 15px;
        border: none !important;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .7px;
        white-space: nowrap;
    }

    .customer-table thead th:first-child {
        border-radius: 8px 0 0 8px;
    }

    .customer-table thead th:last-child {
        border-radius: 0 8px 8px 0;
    }

    .customer-table tbody tr {
        background: rgba(8,10,15,.48) !important;
    }

    .customer-table tbody td {
        background: transparent !important;
        color: #fff !important;
        padding: 15px;
        border-top: 1px solid rgba(255,255,255,.10) !important;
        border-bottom: 1px solid rgba(255,255,255,.10) !important;
        font-size: 13px;
        vertical-align: middle;
    }

    .customer-table tbody tr:hover {
        background: rgba(215,25,32,.17) !important;
    }

    .customer-table tbody tr:hover td {
        background: transparent !important;
        color: white !important;
    }

    /* ID BADGE */
    .id-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 6px;
        background: rgba(215,25,32,.2);
        color: #ff6268;
        font-weight: 700;
    }

    /* ACTION */
    .btn-edit {
        background: rgba(255,174,0,.17);
        color: #ffc04b;
        border: 1px solid rgba(255,174,0,.3);
    }

    .btn-edit:hover {
        background: #ffad00;
        color: #111;
    }

    .btn-delete {
        background: rgba(215,25,32,.17);
        color: #ff6268;
        border: 1px solid rgba(215,25,32,.3);
    }

    .btn-delete:hover {
        background: #d71920;
        color: white;
    }

    /* FOOTER */
    .table-footer {
        color: #c5c5c5;
        border-top: 1px solid rgba(255,255,255,.13);
    }

    /* ANIMATION */
    .customer-card,
    .page-heading {
        animation: fadeUp .6s ease;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media(max-width:768px) {
        .page-heading h4 {
            font-size: 22px;
        }

        .search-box {
            width: 100%;
        }
    }
</style>

<div class="customer-page">

    <!-- HEADER -->
    <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <div class="heading-label mb-2">
                <i class="bi bi-speedometer2 me-1"></i>
                CUSTOMER MANAGEMENT
            </div>

            <h4 class="mb-1">
                Data <span style="color:#ed252c;">Pelanggan</span>
            </h4>

            <p class="small mb-0">
                Kelola informasi pelanggan bengkel MotoCare.
            </p>
        </div>

        <a href="{{ route('pelanggan.create') }}" class="btn btn-add">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Pelanggan
        </a>

    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- STATISTIK -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="customer-card p-3 d-flex align-items-center gap-3">
                <div class="customer-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div>
                    <small>Total Pelanggan</small>
                    <h3 class="fw-bold mb-0">
                        {{ $pelanggans->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="customer-card p-3 d-flex align-items-center gap-3">
                <div class="customer-icon">
                    <i class="bi bi-person-check-fill"></i>
                </div>

                <div>
                    <small>Pelanggan Terdaftar</small>
                    <h3 class="fw-bold mb-0">
                        {{ $pelanggans->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="customer-card p-3 d-flex align-items-center gap-3">
                <div class="customer-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <div>
                    <small>Data Terbaru</small>
                    <h6 class="fw-bold mb-0">
                        {{ $pelanggans->isNotEmpty()
                            ? $pelanggans->first()->created_at->format('d M Y')
                            : 'Belum ada data' }}
                    </h6>
                </div>
            </div>
        </div>

    </div>

    <!-- DAFTAR PELANGGAN -->
    <div class="customer-card p-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h6 class="fw-bold text-white mb-1">
                    <i class="bi bi-card-list me-2" style="color:#ed252c;"></i>
                    Daftar Pelanggan
                </h6>

                <small>
                    Data lengkap pelanggan bengkel MotoCare.
                </small>
            </div>

            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3"
                   style="color:#aaa;"></i>

                <input
                    type="text"
                    id="searchCustomer"
                    class="search-box"
                    placeholder="Cari nama pelanggan..."
                >
            </div>

        </div>

        <div class="table-responsive">

            <table class="table customer-table align-middle mb-0">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>No. HP</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="customerTable">

                    @forelse($pelanggans as $pelanggan)

                        <tr>

                            <td>
                                <span class="id-badge">
                                    {{ $pelanggan->id }}
                                </span>
                            </td>

                            <td class="fw-bold">
                                {{ $pelanggan->nama_pelanggan }}
                            </td>

                            <td>
                                {{ $pelanggan->alamat }}
                            </td>

                            <td>
                                {{ $pelanggan->pekerjaan }}
                            </td>

                            <td>
                                {{ $pelanggan->no_hp }}
                            </td>

                            <td class="text-center">

                                <a
                                    href="{{ route('pelanggan.edit', $pelanggan->id) }}"
                                    class="btn btn-sm btn-edit me-1"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form
                                    action="{{ route('pelanggan.destroy', $pelanggan->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-delete"
                                        title="Hapus"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-people"
                                   style="font-size:40px;color:#ed252c;"></i>

                                <h6 class="text-white fw-bold mt-3">
                                    Belum Ada Pelanggan
                                </h6>

                                <p class="small">
                                    Silakan tambahkan data pelanggan terlebih dahulu.
                                </p>

                                <a href="{{ route('pelanggan.create') }}"
                                   class="btn btn-add btn-sm">
                                    <i class="bi bi-plus-lg me-1"></i>
                                    Tambah Pelanggan
                                </a>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- FOOTER -->
        <div class="table-footer d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3 pt-3">

            <small>
                Menampilkan
                <strong class="text-white">{{ $pelanggans->count() }}</strong>
                data pelanggan
            </small>

            <small>
                <i class="bi bi-shield-check me-1" style="color:#ed252c;"></i>
                MotoCare Management System
            </small>

        </div>

    </div>

</div>

<!-- PENCARIAN -->
<script>
    document.getElementById('searchCustomer').addEventListener('input', function () {

        const keyword = this.value.toLowerCase();

        const rows = document.querySelectorAll('#customerTable tr');

        rows.forEach(function (row) {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });

    });
</script>

@endsection
