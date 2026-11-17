@extends('layouts.app')

@section('title', 'Tambah Kendaraan')

@section('content')
<style>
    /* BACKGROUND FULL SCREEN */

    html,
    body {
        min-height: 100%;
        margin: 0 !important;
        background: #080c14 !important;
    }

    body {
        position: relative;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        background:
            linear-gradient(
                135deg,
                rgba(8, 12, 20, .72),
                rgba(8, 15, 28, .65),
                rgba(5, 10, 18, .78)
            ),
            url('/images/b-rossi.jfif') center center / cover no-repeat;
        pointer-events: none;
    }

    main,
    .content,
    .container-fluid {
        background: transparent !important;
    }

    /* PAGE */

    .garage-page {
        position: relative;
        isolation: isolate;
        min-height: 100vh;
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 25px;
        color: #f5f5f5;
        background: transparent !important;
    }

    /* HEADER */

    .garage-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        animation: fadeDown .7s ease both;
    }

    .garage-header h1 {
        font-size: 27px;
        font-weight: 800;
        font-style: italic;
        text-transform: uppercase;
        margin: 0;
    }

    .garage-header p {
        color: #b5c2ce;
        margin: 6px 0 0;
        font-size: 13px;
    }

    .back-button {
        text-decoration: none;
        color: #fff;
        background: rgba(20, 30, 43, .8);
        border: 1px solid rgba(0,225,255,.3);
        padding: 10px 16px;
        border-radius: 9px;
        font-size: 13px;
        transition: .3s;
    }

    .back-button:hover {
        background: #00bcd4;
        color: #101820;
        transform: translateY(-3px);
    }

    /* MAIN LAYOUT */

    .garage-layout {
        display: grid;
        grid-template-columns: .85fr 1.15fr;
        gap: 22px;
        align-items: stretch;
    }

    /* LEFT VISUAL PANEL */

    .garage-visual {
        background:
            linear-gradient(
                180deg,
                rgba(10,12,17,.12) 0%,
                rgba(10,12,17,.25) 35%,
                rgba(10,12,17,.65) 100%
            ),
            url('/images/Rossi-racing.jfif') center 35% / cover no-repeat;

        border: 1px solid rgba(255,255,255,.12);
        border-radius: 20px;
        padding: 24px;
        min-height: 680px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        position: relative;
        box-shadow: 0 15px 45px rgba(0,0,0,.3);
        animation: slideLeft .8s ease both;
    }

    .garage-visual::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                135deg,
                transparent 30%,
                rgba(0,225,255,.12),
                transparent 75%
            ),
            repeating-linear-gradient(
                0deg,
                transparent 0px,
                transparent 4px,
                rgba(0,225,255,.025) 5px
            );
        pointer-events: none;
    }

    .garage-visual::after {
        content: "46";
        position: absolute;
        right: -12px;
        top: 27%;
        font-size: 160px;
        font-weight: 1000;
        font-style: italic;
        color: rgba(255,255,255,.07);
        transform: skewX(-12deg);
        text-shadow: 0 0 35px rgba(0,225,255,.15);
        pointer-events: none;
    }

    .visual-top,
    .visual-bottom {
        position: relative;
        z-index: 2;
    }

    .visual-label {
        display: inline-block;
        padding: 7px 11px;
        background: rgba(0,225,255,.09);
        border-left: 3px solid #00e1ff;
        color: #b8f7ff;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .garage-heading {
        margin-top: 20px;
    }

    .garage-heading h2 {
        position: relative;
        text-transform: uppercase;
        font-style: italic;
        font-size: 32px;
        font-weight: 900;
        line-height: 1.1;
    }

    .garage-heading h2::before {
        content: "";
        display: inline-block;
        width: 5px;
        height: 24px;
        background: linear-gradient(180deg, #00e1ff, #d71920);
        margin-right: 11px;
        transform: skewX(-15deg);
        vertical-align: -3px;
    }

    .garage-heading p {
        color: rgba(255,255,255,.75);
        font-size: 12px;
        max-width: 260px;
        line-height: 1.7;
    }

    /* LIVE PREVIEW */

    .live-preview {
        position: relative;
        z-index: 2;
        margin-top: auto;
        margin-bottom: 25px;
        background: rgba(8,15,28,.38);
        border: 1px solid rgba(0,225,255,.35);
        border-radius: 16px;
        padding: 18px;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        box-shadow:
            0 0 20px rgba(0,225,255,.08),
            0 10px 35px rgba(0,0,0,.25),
            inset 0 0 20px rgba(0,225,255,.04);
        animation: floatCard 4s ease-in-out infinite;
    }

    .preview-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .preview-title h5 {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        margin: 0;
        color: #e8fbff;
    }

    .live-status {
        color: #00e1ff;
        font-size: 9px;
        font-weight: 700;
    }

    .live-dot {
        display: inline-block;
        width: 7px;
        height: 7px;
        background: #00e1ff;
        border-radius: 50%;
        margin-right: 5px;
        box-shadow: 0 0 12px #00e1ff;
        animation: pulse 1.5s infinite;
    }

    .preview-plate {
        background: rgba(230,245,255,.88);
        color: #111827;
        border: 1px solid rgba(0,225,255,.65);
        border-radius: 9px;
        padding: 12px 10px;
        text-align: center;
        box-shadow: 0 0 15px rgba(0,225,255,.15);
        margin-bottom: 15px;
    }

    .preview-plate small {
        display: block;
        font-size: 8px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .preview-plate h3 {
        font-size: 25px;
        font-weight: 900;
        letter-spacing: 4px;
        margin: 3px 0;
    }

    .preview-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 9px;
    }

    .preview-item {
        background: rgba(0,225,255,.045);
        border: 1px solid rgba(0,225,255,.13);
        padding: 10px;
        border-radius: 9px;
        transition: .3s;
    }

    .preview-item:hover {
        background: rgba(0,225,255,.1);
        border-color: rgba(0,225,255,.4);
        transform: translateY(-3px);
    }

    .preview-item small {
        display: block;
        color: #8bdce8;
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .preview-item strong {
        display: block;
        font-size: 11px;
        color: #fff;
        overflow-wrap: anywhere;
    }

    .visual-bottom {
        margin-top: 10px;
    }

    .visual-line {
        width: 65px;
        height: 4px;
        background: linear-gradient(90deg, #00e1ff, #d71920, transparent);
        margin-bottom: 12px;
    }

    .visual-bottom p {
        font-size: 9px;
        color: rgba(255,255,255,.7);
        letter-spacing: 2px;
        margin: 0;
    }

    /* RIGHT FORM PANEL */

    .garage-form-panel {
        background: rgba(25, 30, 40, .94);
        border: 1px solid rgba(0,225,255,.17);
        border-radius: 20px;
        padding: 28px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 15px 45px rgba(0,0,0,.3);
        animation: slideRight .8s ease both;
    }

    .form-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 18px;
        border-bottom: 1px solid #383b45;
    }

    .form-heading h3 {
        font-size: 19px;
        font-weight: 800;
        margin: 0;
    }

    .form-heading p {
        color: #999eaa;
        font-size: 12px;
        margin: 5px 0 0;
    }

    .form-number {
        padding: 8px 11px;
        background: rgba(0,225,255,.07);
        border: 1px solid rgba(0,225,255,.25);
        border-radius: 6px;
        color: #00e1ff;
        font-size: 11px;
        font-weight: 800;
    }

    .form-section-title {
        color: #00d5ed;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
        margin: 22px 0 13px;
        text-transform: uppercase;
    }

    .form-group {
        margin-bottom: 17px;
    }

    .form-group label {
        display: block;
        color: #d9dbe1;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        background: #171920;
        color: #fff;
        border: 1px solid #3a3d48;
        border-radius: 9px;
        padding: 12px 14px;
        font-size: 13px;
        outline: none;
        transition: .25s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #00cfe8;
        box-shadow: 0 0 0 3px rgba(0,207,232,.12);
    }

    .form-group input::placeholder {
        color: #777c87;
    }

    /* TRANSMISSION OPTIONS */

    .transmission-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .transmission-option {
        position: relative;
    }

    .transmission-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .transmission-option label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 8px;
        background: #171920;
        border: 1px solid #3a3d48;
        border-radius: 9px;
        cursor: pointer;
        color: #c5c7ce;
        transition: .25s;
        margin: 0;
    }

    .transmission-option input:checked + label {
        background: rgba(0,225,255,.09);
        border-color: #00cfe8;
        color: #fff;
        box-shadow: 0 0 12px rgba(0,225,255,.08);
    }

    .transmission-option label:hover {
        border-color: #00cfe8;
    }

    /* VALIDATION */

    .error-text {
        color: #ff7379;
        font-size: 11px;
        margin-top: 6px;
    }

    /* BUTTONS */

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 28px;
    }

    .btn-save {
        flex: 1;
        background: linear-gradient(110deg, #007f96, #00bcd4);
        border: none;
        color: #fff;
        border-radius: 9px;
        padding: 13px;
        font-size: 13px;
        font-weight: 800;
        transition: .3s;
    }

    .btn-save:hover {
        background: linear-gradient(110deg, #009bb3, #00d5ed);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,207,232,.2);
    }

    .btn-cancel {
        text-decoration: none;
        text-align: center;
        background: #343741;
        color: #ddd;
        border-radius: 9px;
        padding: 13px 18px;
        font-size: 13px;
        transition: .3s;
    }

    .btn-cancel:hover {
        background: #454955;
        color: white;
    }

    /* ANIMATIONS */

    @keyframes slideLeft {
        from {
            opacity: 0;
            transform: translateX(-35px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideRight {
        from {
            opacity: 0;
            transform: translateX(35px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes floatCard {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-6px);
        }
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: .35;
        }
    }

    /* RESPONSIVE */

    @media (max-width: 1000px) {
        .garage-layout {
            grid-template-columns: 1fr;
        }

        .garage-visual {
            min-height: 580px;
        }
    }

    @media (max-width: 576px) {
        .garage-page {
            padding: 15px;
        }

        .garage-header {
            align-items: flex-start;
            gap: 12px;
        }

        .garage-header h1 {
            font-size: 21px;
        }

        .garage-visual {
            min-height: 580px;
            padding: 20px;
        }

        .garage-form-panel {
            padding: 20px;
        }

        .garage-heading h2 {
            font-size: 27px;
        }

        .live-preview {
            margin-bottom: 15px;
        }
    }
    /* FIX BACKGROUND B-ROSSI */
html,
body {
    background-color: #080c14 !important;
    background-image:
        linear-gradient(
            rgba(5, 10, 18, .60),
            rgba(5, 10, 18, .70)
        ),
        url('/images/b-rossi.jfif') !important;
    background-position: center center !important;
    background-size: cover !important;
    background-repeat: no-repeat !important;
    background-attachment: fixed !important;
}

/* PASTIKAN PEMBUNGKUS TRANSPARAN */
main,
.content,
.container-fluid,
.main-content {
    background-color: transparent !important;
}

/* TULISAN MOTOCARE SERVICE KEMBALI PUTIH */
.sidebar .brand,
.sidebar .brand-name,
.sidebar .logo-text,
.sidebar a,
.sidebar h5,
.sidebar span {
    color: #ffffff !important;
}
</style>

<div class="garage-page">

    {{-- HEADER --}}
    <div class="garage-header">
        <div>
            <h1>Vehicle Registration</h1>
            <p>Tambahkan kendaraan baru ke dalam sistem MotoCare.</p>
        </div>

        <a href="{{ route('kendaraan.index') }}" class="back-button">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="garage-layout">

        {{-- PANEL KIRI --}}
        <div class="garage-visual">

            <div class="visual-top">
                <span class="visual-label">MOTOCARE // GARAGE SYSTEM</span>

                <div class="garage-heading">
                    <h2>RIDE<br>WITH STYLE.</h2>
                    <p>
                        Setiap kendaraan punya identitas.
                        Daftarkan kendaraan pelanggan dengan data yang tepat.
                    </p>
                </div>
            </div>

            {{-- LIVE PREVIEW --}}
            <div class="live-preview">

                <div class="preview-title">
                    <h5>VEHICLE LIVE DATA</h5>

                    <span class="live-status">
                        <span class="live-dot"></span> LIVE PREVIEW
                    </span>
                </div>

                <div class="preview-plate">
                    <small>INDONESIA</small>
                    <h3 id="preview-plate">BL 0000 XX</h3>
                </div>

                <div class="preview-info">

                    <div class="preview-item">
                        <small>Jenis Kendaraan</small>
                        <strong id="preview-type">Belum dipilih</strong>
                    </div>

                    <div class="preview-item">
                        <small>Tahun Produksi</small>
                        <strong id="preview-year">-</strong>
                    </div>

                    <div class="preview-item">
                        <small>Warna Kendaraan</small>
                        <strong id="preview-color">-</strong>
                    </div>

                    <div class="preview-item">
                        <small>Nama Pemilik</small>
                        <strong id="preview-owner">-</strong>
                    </div>

                </div>
            </div>

            <div class="visual-bottom">
                <div class="visual-line"></div>
                <p>PRECISION • PERFORMANCE • TRUST</p>
            </div>

        </div>

        {{-- PANEL KANAN --}}
        <div class="garage-form-panel">

            <div class="form-heading">
                <div>
                    <h3>Data Kendaraan</h3>
                    <p>Lengkapi informasi kendaraan pelanggan.</p>
                </div>

                <span class="form-number">FORM 02</span>
            </div>

            <form action="{{ route('kendaraan.store') }}" method="POST">
                @csrf

                {{-- IDENTITAS KENDARAAN --}}
                <div class="form-section-title">
                    <i class="bi bi-card-list"></i>
                    Identitas Kendaraan
                </div>

                <div class="form-group">
                    <label for="nomor_polisi">Nomor Plat Kendaraan</label>

                    <input
                        type="text"
                        id="nomor_polisi"
                        name="nomor_polisi"
                        value="{{ old('nomor_polisi') }}"
                        placeholder="Contoh: BL 1234 AB"
                        oninput="updatePreview()"
                        required
                    >

                    @error('nomor_polisi')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Jenis Kendaraan</label>

                    <div class="transmission-grid">

                        <div class="transmission-option">
                            <input
                                type="radio"
                                name="jenis_kendaraan"
                                id="matic"
                                value="Matic"
                                {{ old('jenis_kendaraan') == 'Matic' ? 'checked' : '' }}
                                onchange="updatePreview()"
                                required
                            >

                            <label for="matic">
                                <i class="bi bi-gear"></i>
                                Matic
                            </label>
                        </div>

                        <div class="transmission-option">
                            <input
                                type="radio"
                                name="jenis_kendaraan"
                                id="manual"
                                value="Manual Transmisi"
                                {{ old('jenis_kendaraan') == 'Manual Transmisi' ? 'checked' : '' }}
                                onchange="updatePreview()"
                            >

                            <label for="manual">
                                <i class="bi bi-tools"></i>
                                Manual
                            </label>
                        </div>

                    </div>

                    @error('jenis_kendaraan')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_stnk">Nomor STNK</label>

                    <input
                        type="text"
                        id="no_stnk"
                        name="no_stnk"
                        value="{{ old('no_stnk') }}"
                        placeholder="Masukkan nomor STNK"
                        required
                    >

                    @error('no_stnk')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DETAIL KENDARAAN --}}
                <div class="form-section-title">
                    <i class="bi bi-wrench-adjustable"></i>
                    Detail Kendaraan
                </div>

                <div class="form-group">
                    <label for="tahun_pembuatan">Tahun Pembuatan</label>

                    <input
                        type="number"
                        id="tahun_pembuatan"
                        name="tahun_pembuatan"
                        value="{{ old('tahun_pembuatan') }}"
                        placeholder="Contoh: 2022"
                        min="1900"
                        max="{{ date('Y') }}"
                        oninput="updatePreview()"
                        required
                    >

                    @error('tahun_pembuatan')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="warna">Warna Kendaraan</label>

                    <input
                        type="text"
                        id="warna"
                        name="warna"
                        value="{{ old('warna') }}"
                        placeholder="Contoh: Hitam, Merah, Putih"
                        oninput="updatePreview()"
                        required
                    >

                    @error('warna')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- INFORMASI PEMILIK --}}
                <div class="form-section-title">
                    <i class="bi bi-person-badge"></i>
                    Informasi Pemilik
                </div>

                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik Kendaraan</label>

                    <input
                        type="text"
                        id="nama_pemilik"
                        name="nama_pemilik"
                        value="{{ old('nama_pemilik') }}"
                        placeholder="Masukkan nama pemilik"
                        oninput="updatePreview()"
                        required
                    >

                    @error('nama_pemilik')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TOMBOL --}}
                <div class="form-actions">
                    <a href="{{ route('kendaraan.index') }}" class="btn-cancel">
                        Batal
                    </a>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-circle"></i>
                        Simpan Kendaraan
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

{{-- LIVE PREVIEW SCRIPT --}}
<script>
    function updatePreview() {
        const plate = document.getElementById('nomor_polisi').value;
        const year = document.getElementById('tahun_pembuatan').value;
        const color = document.getElementById('warna').value;
        const owner = document.getElementById('nama_pemilik').value;

        const selectedType = document.querySelector(
            'input[name="jenis_kendaraan"]:checked'
        );

        document.getElementById('preview-plate').textContent =
            plate.trim() || 'BL 0000 XX';

        document.getElementById('preview-type').textContent =
            selectedType ? selectedType.value : 'Belum dipilih';

        document.getElementById('preview-year').textContent =
            year || '-';

        document.getElementById('preview-color').textContent =
            color.trim() || '-';

        document.getElementById('preview-owner').textContent =
            owner.trim() || '-';
    }

    document.addEventListener('DOMContentLoaded', function () {
        updatePreview();
    });
</script>

@endsection
