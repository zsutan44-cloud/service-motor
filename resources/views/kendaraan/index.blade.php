@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('content')

<style>
    /* BACKGROUND */
    html,
    body {
        min-height: 100%;
        background:
            linear-gradient(
                rgba(5, 10, 18, .72),
                rgba(5, 10, 18, .82)
            ),
            url('/images/b-rossi.jfif') center center / cover fixed no-repeat !important;
    }

    .main-content {
        background: transparent !important;
    }

    /* PAGE */
    .vehicle-page {
        color: #fff;
        min-height: 100vh;
        animation: fadeIn .7s ease;
    }

    /* HEADER */
    .vehicle-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .vehicle-header h2 {
        font-size: 25px;
        font-weight: 900;
        font-style: italic;
        text-transform: uppercase;
        margin: 0;
    }

    .vehicle-header p {
        color: #aeb8c5;
        font-size: 12px;
        margin: 6px 0 0;
    }

    /* RACING CONTROL BUTTON */
    .btn-add-vehicle {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 11px;
        padding: 12px 20px;
        background: rgba(8, 20, 32, .92);
        color: #eafaff;
        border: 1px solid rgba(0,225,255,.55);
        border-left: 4px solid #d71920;
        border-radius: 7px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        overflow: hidden;
        transition: .3s ease;
        box-shadow:
            0 0 15px rgba(0,225,255,.08),
            inset 0 0 15px rgba(0,225,255,.04);
    }

    .btn-add-vehicle i {
        font-size: 17px;
        color: #00e1ff;
        transition: .3s;
    }

    .btn-add-vehicle::after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 60%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(0,225,255,.15),
            transparent
        );
        transform: skewX(-25deg);
        transition: .5s;
    }

    .btn-add-vehicle:hover {
        color: #fff;
        background: rgba(0, 95, 115, .35);
        border-color: #00e1ff;
        transform: translateY(-3px);
        box-shadow:
            0 0 20px rgba(0,225,255,.2),
            0 8px 20px rgba(0,0,0,.25);
    }

    .btn-add-vehicle:hover i {
        color: #fff;
        transform: rotate(90deg);
    }

    .btn-add-vehicle:hover::after {
        left: 150%;
    }

    /* INTRO PANEL */
    .vehicle-banner {
        position: relative;
        overflow: hidden;
        padding: 25px;
        border: 1px solid rgba(0,225,255,.2);
        border-radius: 16px;
        background:
            linear-gradient(
                110deg,
                rgba(10,20,32,.94),
                rgba(15,35,48,.82)
            );
        margin-bottom: 22px;
    }

    .vehicle-banner::after {
        content: 'MOTOCARE';
        position: absolute;
        right: 15px;
        bottom: -22px;
        font-size: 65px;
        font-weight: 900;
        font-style: italic;
        color: rgba(255,255,255,.035);
        pointer-events: none;
    }

    .banner-content {
        position: relative;
        z-index: 2;
    }

    .banner-tag {
        color: #00e1ff;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .banner-content h3 {
        font-size: 20px;
        font-weight: 800;
        margin: 9px 0 5px;
    }

    .banner-content p {
        color: #aeb8c5;
        font-size: 12px;
        margin: 0;
    }

    /* SUMMARY */
    .vehicle-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 22px;
    }

    .summary-card {
        padding: 17px;
        background: rgba(20,27,39,.88);
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 13px;
        transition: .3s;
    }

    .summary-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0,225,255,.4);
    }

    .summary-card small {
        color: #9ca9b8;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .summary-card h3 {
        font-size: 25px;
        font-weight: 900;
        margin: 8px 0 0;
    }

    .summary-card i {
        color: #00d9f5;
        font-size: 19px;
        float: right;
    }

    /* TABLE PANEL */
    .vehicle-table-panel {
        background: rgba(20,25,35,.94);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 12px 35px rgba(0,0,0,.2);
        backdrop-filter: blur(12px);
    }

    .table-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .table-heading h4 {
        font-size: 15px;
        font-weight: 800;
        margin: 0;
    }

    .table-heading p {
        color: #929baa;
        font-size: 11px;
        margin: 5px 0 0;
    }

    /* SEARCH */
    .search-box {
        position: relative;
        width: 260px;
        max-width: 100%;
    }

    .search-box i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #8492a6;
    }

    .search-box input {
        width: 100%;
        padding: 10px 12px 10px 36px;
        background: #111722;
        color: #fff;
        border: 1px solid #343e4d;
        border-radius: 8px;
        outline: none;
        font-size: 11px;
    }

    .search-box input:focus {
        border-color: #00cfe8;
        box-shadow: 0 0 0 3px rgba(0,207,232,.1);
    }

    .search-box input::placeholder {
        color: #778394;
    }

    /* TABLE */
    .table-responsive {
        border-radius: 10px;
    }

    .vehicle-table {
        width: 100%;
        min-width: 850px;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
        color: #fff;
    }

    .vehicle-table thead th {
        background: #111722;
        color: #00d9f5;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .7px;
        text-transform: uppercase;
        padding: 15px 12px;
        border-bottom: 1px solid #34404f;
        white-space: nowrap;
    }

    .vehicle-table tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid rgba(255,255,255,.07);
        color: #d9e0e8;
        font-size: 11px;
        vertical-align: middle;
    }

    .vehicle-table tbody tr {
        transition: .25s;
    }

    .vehicle-table tbody tr:hover {
        background: rgba(0,225,255,.055);
    }

    .vehicle-table tbody tr:last-child td {
        border-bottom: none;
    }

    .vehicle-id {
        color: #00d9f5;
        font-weight: 800;
    }

    .plate-number {
        display: inline-block;
        background: #e9edf2;
        color: #111827;
        border: 2px solid #aab2bd;
        border-radius: 5px;
        padding: 5px 9px;
        font-weight: 900;
        letter-spacing: 1px;
        font-size: 10px;
        white-space: nowrap;
    }

    .type-badge {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 6px;
        background: rgba(0,225,255,.1);
        border: 1px solid rgba(0,225,255,.25);
        color: #62eaff;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .owner-name {
        color: #fff;
        font-weight: 700;
    }

    .color-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #00d9f5;
        border-radius: 50%;
        margin-right: 6px;
    }

    /* ACTION BUTTONS */
    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .btn-action {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        transition: .25s;
        font-size: 12px;
    }

    .btn-edit {
        background: rgba(0,225,255,.12);
        color: #00d9f5;
        border: 1px solid rgba(0,225,255,.2);
    }

    .btn-edit:hover {
        background: #00d9f5;
        color: #111;
    }

    .btn-delete {
        background: rgba(215,25,32,.12);
        color: #ff555d;
        border: 1px solid rgba(215,25,32,.2);
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #d71920;
        color: #fff;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 55px 15px !important;
    }

    .empty-state i {
        font-size: 42px;
        color: #00d9f5;
        display: block;
        margin-bottom: 13px;
    }

    .empty-state h5 {
        font-size: 14px;
        font-weight: 800;
        color: #fff;
    }

    .empty-state p {
        color: #929baa;
        font-size: 11px;
        margin: 5px 0 0;
    }

    /* ALERT */
    .custom-alert {
        background: rgba(15,130,90,.16);
        border: 1px solid rgba(35,210,145,.35);
        color: #8ff0c6;
        border-radius: 9px;
        padding: 12px 15px;
        font-size: 12px;
        margin-bottom: 18px;
    }

    /* FOOTER */
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top: 17px;
        color: #8793a3;
        font-size: 10px;
        flex-wrap: wrap;
    }

    /* ANIMATION */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .vehicle-summary {
            grid-template-columns: 1fr;
        }

        .vehicle-header h2 {
            font-size: 21px;
        }

        .vehicle-table-panel {
            padding: 15px;
        }

        .search-box {
            width: 100%;
        }
    }
</style>

<div class="vehicle-page">

    {{-- HEADER --}}
    <div class="vehicle-header">
        <div>
            <h2><i class="bi bi-bicycle text-danger"></i> Data Kendaraan</h2>
            <p>Kelola informasi kendaraan pelanggan MotoCare Service.</p>
        </div>

        <a href="{{ route('kendaraan.create') }}" class="btn-add-vehicle">
            <i class="bi bi-plus-circle"></i>
            Tambah Kendaraan
        </a>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="custom-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- BANNER --}}
    <div class="vehicle-banner">
        <div class="banner-content">
            <span class="banner-tag">MOTOCARE // VEHICLE MANAGEMENT</span>
            <h3>YOUR VEHICLES, OUR RESPONSIBILITY.</h3>
            <p>Pastikan seluruh data kendaraan pelanggan tercatat dengan benar.</p>
        </div>
    </div>

    {{-- RINGKASAN --}}
    <div class="vehicle-summary">

        <div class="summary-card">
            <i class="bi bi-car-front-fill"></i>
            <small>Total Kendaraan</small>
            <h3>{{ $kendaraans->count() }}</h3>
        </div>

        <div class="summary-card">
            <i class="bi bi-gear-fill"></i>
            <small>Kendaraan Matic</small>
            <h3>{{ $kendaraans->where('jenis_kendaraan', 'Matic')->count() }}</h3>
        </div>

        <div class="summary-card">
            <i class="bi bi-tools"></i>
            <small>Kendaraan Manual</small>
            <h3>{{ $kendaraans->where('jenis_kendaraan', 'Manual Transmisi')->count() }}</h3>
        </div>

    </div>

    {{-- TABEL DATA --}}
    <div class="vehicle-table-panel">

        <div class="table-heading">
            <div>
                <h4><i class="bi bi-list-ul text-info me-2"></i>Daftar Kendaraan</h4>
                <p>Informasi seluruh kendaraan yang terdaftar dalam sistem.</p>
            </div>

            <div class="search-box">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    id="searchVehicle"
                    placeholder="Cari plat, pemilik, jenis..."
                    onkeyup="searchVehicle()"
                >
            </div>
        </div>

        <div class="table-responsive">
            <table class="vehicle-table" id="vehicleTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nomor Plat</th>
                        <th>Jenis Kendaraan</th>
                        <th>Nomor STNK</th>
                        <th>Tahun</th>
                        <th>Nama Pemilik</th>
                        <th>Warna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($kendaraans as $kendaraan)
                        <tr>
                            <td>
                                <span class="vehicle-id">
                                    #{{ str_pad($kendaraan->id, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <td>
                                <span class="plate-number">
                                    {{ $kendaraan->nomor_polisi }}
                                </span>
                            </td>

                            <td>
                                <span class="type-badge">
                                    {{ $kendaraan->jenis_kendaraan }}
                                </span>
                            </td>

                            <td>{{ $kendaraan->no_stnk }}</td>

                            <td>{{ $kendaraan->tahun_pembuatan }}</td>

                            <td>
                                <span class="owner-name">
                                    {{ $kendaraan->nama_pemilik }}
                                </span>
                            </td>

                            <td>
                                <span class="color-dot"></span>
                                {{ $kendaraan->warna }}
                            </td>

                            <td>
                                <div class="action-buttons">

                                    <a
                                        href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                        class="btn-action btn-edit"
                                        title="Edit kendaraan"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form
                                        action="{{ route('kendaraan.destroy', $kendaraan->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data kendaraan ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action btn-delete"
                                            title="Hapus kendaraan"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="empty-state">
                                <i class="bi bi-bicycle"></i>
                                <h5>Belum Ada Data Kendaraan</h5>
                                <p>Data kendaraan yang ditambahkan akan muncul di halaman ini.</p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="noSearchResult" style="display:none;">
                        <td colspan="8" class="empty-state">
                            <i class="bi bi-search"></i>
                            <h5>Data Tidak Ditemukan</h5>
                            <p>Coba gunakan kata kunci pencarian lainnya.</p>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

        <div class="table-footer">
            <span>
                <i class="bi bi-database me-1"></i>
                Total {{ $kendaraans->count() }} kendaraan terdaftar
            </span>

            <span>MOTOCARE SERVICE &copy; {{ date('Y') }}</span>
        </div>

    </div>

</div>

{{-- SEARCH SCRIPT --}}
<script>
    function searchVehicle() {
        const input = document.getElementById('searchVehicle');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('vehicleTable');
        const rows = table.querySelectorAll('tbody tr:not(#noSearchResult)');
        const noResult = document.getElementById('noSearchResult');

        let found = 0;

        rows.forEach(function(row) {
            const text = row.textContent.toLowerCase();

            if (text.includes(filter)) {
                row.style.display = '';
                found++;
            } else {
                row.style.display = 'none';
            }
        });

        if (noResult) {
            noResult.style.display = found === 0 ? '' : 'none';
        }
    }
</script>

@endsection
