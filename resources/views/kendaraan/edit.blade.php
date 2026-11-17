@extends('layouts.app')

@section('title', 'Edit Kendaraan')

@section('content')

<style>
    /* =====================================
       BACKGROUND UTAMA
    ===================================== */

    html,
    body {
        background:
            linear-gradient(
                135deg,
                rgba(8, 11, 18, .93),
                rgba(12, 17, 27, .88),
                rgba(8, 11, 18, .95)
            ),
            url('/images/b-rossi.jfif') center center / cover fixed !important;

        background-repeat: no-repeat !important;
        min-height: 100vh;
    }

    .main-content {
        background: transparent !important;
        min-height: 100vh;
    }

    .edit-vehicle-page {
        position: relative;
        isolation: isolate;
        color: #fff;
        animation: fadeIn .6s ease;
    }

    .edit-vehicle-page::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        pointer-events: none;

        background:
            linear-gradient(
                90deg,
                rgba(215, 25, 32, .07),
                transparent 35%,
                transparent 70%,
                rgba(0, 225, 255, .035)
            );
    }

    /* =====================================
       HEADER
    ===================================== */

    .edit-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .edit-header h2 {
        font-size: 25px;
        font-weight: 900;
        font-style: italic;
        text-transform: uppercase;
        margin: 0;
    }

    .edit-header p {
        color: #aeb8c5;
        font-size: 12px;
        margin: 6px 0 0;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 17px;
        background: rgba(20,27,39,.9);
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 7px;
        color: #dce7f2;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        transition: .3s;
    }

    .btn-back:hover {
        color: #00e1ff;
        border-color: #00e1ff;
        transform: translateY(-2px);
    }

    /* =====================================
       BANNER
    ===================================== */

    .edit-banner {
        position: relative;
        overflow: hidden;
        padding: 22px 25px;

        background:
            linear-gradient(
                100deg,
                rgba(10, 15, 24, .96),
                rgba(35, 20, 27, .91)
            );

        border: 1px solid rgba(0,225,255,.2);
        border-left: 4px solid #d71920;
        border-radius: 13px;
        margin-bottom: 22px;
        box-shadow: 0 10px 30px rgba(0,0,0,.2);
    }

    .edit-banner::after {
        content: "MOTOCARE";
        position: absolute;
        right: 25px;
        bottom: -15px;
        font-size: 65px;
        font-weight: 900;
        font-style: italic;
        color: rgba(255,255,255,.035);
        pointer-events: none;
    }

    .edit-banner small {
        position: relative;
        z-index: 1;
        color: #00e1ff;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .edit-banner h3 {
        position: relative;
        z-index: 1;
        font-size: 19px;
        font-weight: 900;
        margin: 8px 0 5px;
    }

    .edit-banner p {
        position: relative;
        z-index: 1;
        color: #aeb8c5;
        font-size: 11px;
        margin: 0;
    }

    /* =====================================
       LAYOUT
    ===================================== */

    .edit-layout {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 20px;
    }

    .vehicle-info-panel,
    .edit-form-panel {
        background: rgba(15,20,30,.94);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 15px;
        padding: 23px;
        backdrop-filter: blur(14px);
        box-shadow: 0 15px 35px rgba(0,0,0,.2);
    }

    /* =====================================
       VEHICLE INFORMATION PANEL
    ===================================== */

    .vehicle-info-panel {
        display: flex;
        flex-direction: column;
        min-height: 100%;

        background:
            linear-gradient(
                rgba(8,15,25,.88),
                rgba(8,15,25,.96)
            ),
            url('/images/Rossi-racing.jfif') center / cover;
    }

    .info-label {
        color: #00e1ff;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .vehicle-info-panel h4 {
        font-size: 18px;
        font-weight: 900;
        margin: 12px 0 5px;
    }

    .vehicle-info-panel p {
        color: #aeb8c5;
        font-size: 11px;
    }

    .plate-preview {
        margin: 35px 0 25px;
        padding: 20px 12px;
        text-align: center;
        background: #eef1f5;
        color: #111827;
        border: 5px solid #b8c0ca;
        border-radius: 9px;
        box-shadow: 0 10px 25px rgba(0,0,0,.3);
    }

    .plate-preview small {
        display: block;
        font-size: 8px;
        font-weight: 900;
        letter-spacing: 2px;
        margin-bottom: 7px;
    }

    .plate-preview strong {
        font-size: 25px;
        font-weight: 900;
        letter-spacing: 3px;
        overflow-wrap: anywhere;
    }

    .vehicle-detail {
        border-top: 1px solid rgba(255,255,255,.12);
        padding: 13px 0;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        font-size: 11px;
    }

    .vehicle-detail span {
        color: #9ca9b8;
    }

    .vehicle-detail strong {
        color: #fff;
        text-align: right;
    }

    /* =====================================
       FORM PANEL
    ===================================== */

    .edit-form-heading {
        margin-bottom: 22px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255,255,255,.1);
    }

    .edit-form-heading h4 {
        font-size: 15px;
        font-weight: 900;
        margin: 0 0 5px;
    }

    .edit-form-heading p {
        color: #929baa;
        font-size: 11px;
        margin: 0;
    }

    .form-group {
        margin-bottom: 17px;
    }

    .form-group label {
        display: block;
        color: #dce5ee;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .5px;
        margin-bottom: 8px;
    }

    .form-control-custom {
        width: 100%;
        padding: 12px 13px;
        background: #111722;
        color: #fff;
        border: 1px solid #343e4d;
        border-radius: 8px;
        outline: none;
        font-size: 11px;
        transition: .25s;
    }

    .form-control-custom:focus {
        border-color: #00d9f5;
        box-shadow: 0 0 0 3px rgba(0,217,245,.1);
    }

    .form-control-custom::placeholder {
        color: #778394;
    }

    .form-control-custom option {
        background: #111722;
        color: #fff;
    }

    /* =====================================
       RADIO BUTTON
    ===================================== */

    .radio-wrapper {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .radio-option {
        flex: 1;
        min-width: 120px;
        padding: 13px;
        background: #111722;
        border: 1px solid #343e4d;
        border-radius: 8px;
        cursor: pointer;
        transition: .25s;
    }

    .radio-option:has(input:checked) {
        border-color: #00d9f5;
        background: rgba(0,217,245,.09);
    }

    .radio-option input {
        accent-color: #00d9f5;
        margin-right: 7px;
    }

    .radio-option label {
        display: inline;
        cursor: pointer;
        font-size: 11px;
    }

    /* =====================================
       VALIDATION
    ===================================== */

    .invalid-feedback {
        display: block;
        color: #ff7077;
        font-size: 10px;
        margin-top: 5px;
    }

    /* =====================================
       FORM ACTIONS
    ===================================== */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
        padding-top: 18px;
        border-top: 1px solid rgba(255,255,255,.1);
        margin-top: 10px;
    }

    .btn-cancel,
    .btn-save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 19px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .7px;
        text-decoration: none;
        transition: .3s;
        cursor: pointer;
    }

    .btn-cancel {
        background: #252d3a;
        color: #dce5ee;
        border: 1px solid #424d5d;
    }

    .btn-cancel:hover {
        background: #343f50;
        color: #fff;
    }

    .btn-save {
        background: #d71920;
        color: #fff;
        border: 1px solid #ff3b42;
        box-shadow: 0 5px 15px rgba(215,25,32,.2);
    }

    .btn-save:hover {
        background: #f1262e;
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(215,25,32,.3);
    }

    /* =====================================
       ANIMATION
    ===================================== */

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =====================================
       RESPONSIVE
    ===================================== */

    @media (max-width: 850px) {
        .edit-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .vehicle-info-panel,
        .edit-form-panel {
            padding: 17px;
        }

        .edit-header h2 {
            font-size: 21px;
        }

        .edit-banner::after {
            font-size: 40px;
            right: 10px;
        }
    }
</style>

<div class="edit-vehicle-page">

    {{-- HEADER --}}
    <div class="edit-header">
        <div>
            <h2>
                <i class="bi bi-pencil-square text-danger"></i>
                Edit Kendaraan
            </h2>

            <p>Perbarui informasi kendaraan pelanggan MotoCare Service.</p>
        </div>

        <a href="{{ route('kendaraan.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- BANNER --}}
    <div class="edit-banner">
        <small>MOTOCARE // VEHICLE UPDATE SYSTEM</small>

        <h3>UPDATE VEHICLE INFORMATION.</h3>

        <p>
            Pastikan informasi kendaraan yang diperbarui sudah benar
            sebelum disimpan.
        </p>
    </div>

    <div class="edit-layout">

        {{-- PANEL INFORMASI KENDARAAN --}}
        <div class="vehicle-info-panel">

            <span class="info-label">VEHICLE IDENTIFICATION</span>

            <h4>Vehicle Profile</h4>

            <p>Informasi kendaraan yang sedang kamu perbarui.</p>

            <div class="plate-preview">
                <small>INDONESIA VEHICLE PLATE</small>

                <strong id="previewPlate">
                    {{ $kendaraan->nomor_polisi }}
                </strong>
            </div>

            <div class="vehicle-detail">
                <span>Jenis Kendaraan</span>

                <strong id="previewType">
                    {{ $kendaraan->jenis_kendaraan }}
                </strong>
            </div>

            <div class="vehicle-detail">
                <span>Tahun Pembuatan</span>

                <strong id="previewYear">
                    {{ $kendaraan->tahun_pembuatan }}
                </strong>
            </div>

            <div class="vehicle-detail">
                <span>Nama Pemilik</span>

                <strong id="previewOwner">
                    {{ $kendaraan->nama_pemilik }}
                </strong>
            </div>

            <div class="vehicle-detail">
                <span>Warna</span>

                <strong id="previewColor">
                    {{ $kendaraan->warna }}
                </strong>
            </div>

        </div>

        {{-- FORM EDIT --}}
        <div class="edit-form-panel">

            <div class="edit-form-heading">
                <h4>
                    <i class="bi bi-sliders text-info me-2"></i>
                    Form Pembaruan Data
                </h4>

                <p>Ubah kolom yang ingin diperbarui.</p>
            </div>

            <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- NOMOR PLAT --}}
                <div class="form-group">

                    <label for="nomor_polisi">
                        NOMOR PLAT KENDARAAN
                    </label>

                    <input
                        type="text"
                        name="nomor_polisi"
                        id="nomor_polisi"
                        class="form-control-custom"
                        value="{{ old('nomor_polisi', $kendaraan->nomor_polisi) }}"
                        placeholder="Contoh: BL 1234 AB"
                        required
                    >

                    @error('nomor_polisi')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                {{-- JENIS KENDARAAN --}}
                <div class="form-group">

                    <label>JENIS KENDARAAN</label>

                    <div class="radio-wrapper">

                        <div class="radio-option">

                            <input
                                type="radio"
                                name="jenis_kendaraan"
                                id="matic"
                                value="Matic"
                                {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Matic' ? 'checked' : '' }}
                                required
                            >

                            <label for="matic">Matic</label>

                        </div>

                        <div class="radio-option">

                            <input
                                type="radio"
                                name="jenis_kendaraan"
                                id="manual"
                                value="Manual Transmisi"
                                {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Manual Transmisi' ? 'checked' : '' }}
                            >

                            <label for="manual">Manual Transmisi</label>

                        </div>

                    </div>

                    @error('jenis_kendaraan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                {{-- NOMOR STNK --}}
                <div class="form-group">

                    <label for="no_stnk">NOMOR STNK</label>

                    <input
                        type="text"
                        name="no_stnk"
                        id="no_stnk"
                        class="form-control-custom"
                        value="{{ old('no_stnk', $kendaraan->no_stnk) }}"
                        placeholder="Masukkan nomor STNK"
                        required
                    >

                    @error('no_stnk')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                {{-- TAHUN --}}
                <div class="form-group">

                    <label for="tahun_pembuatan">
                        TAHUN PEMBUATAN KENDARAAN
                    </label>

                    <input
                        type="number"
                        name="tahun_pembuatan"
                        id="tahun_pembuatan"
                        class="form-control-custom"
                        value="{{ old('tahun_pembuatan', $kendaraan->tahun_pembuatan) }}"
                        min="1900"
                        max="{{ date('Y') }}"
                        placeholder="Contoh: 2022"
                        required
                    >

                    @error('tahun_pembuatan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                {{-- NAMA PEMILIK --}}
                <div class="form-group">

                    <label for="nama_pemilik">NAMA PEMILIK</label>

                    <input
                        type="text"
                        name="nama_pemilik"
                        id="nama_pemilik"
                        class="form-control-custom"
                        value="{{ old('nama_pemilik', $kendaraan->nama_pemilik) }}"
                        placeholder="Masukkan nama pemilik"
                        required
                    >

                    @error('nama_pemilik')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                {{-- WARNA --}}
                <div class="form-group">

                    <label for="warna">WARNA KENDARAAN</label>

                    <input
                        type="text"
                        name="warna"
                        id="warna"
                        class="form-control-custom"
                        value="{{ old('warna', $kendaraan->warna) }}"
                        placeholder="Contoh: Hitam"
                        required
                    >

                    @error('warna')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                {{-- ACTION --}}
                <div class="form-actions">

                    <a href="{{ route('kendaraan.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        BATAL
                    </a>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-circle"></i>
                        SIMPAN PERUBAHAN
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- LIVE PREVIEW --}}
<script>
    const plateInput = document.getElementById('nomor_polisi');
    const yearInput = document.getElementById('tahun_pembuatan');
    const ownerInput = document.getElementById('nama_pemilik');
    const colorInput = document.getElementById('warna');

    plateInput.addEventListener('input', function () {
        document.getElementById('previewPlate').textContent =
            this.value || '-';
    });

    yearInput.addEventListener('input', function () {
        document.getElementById('previewYear').textContent =
            this.value || '-';
    });

    ownerInput.addEventListener('input', function () {
        document.getElementById('previewOwner').textContent =
            this.value || '-';
    });

    colorInput.addEventListener('input', function () {
        document.getElementById('previewColor').textContent =
            this.value || '-';
    });

    document.querySelectorAll('input[name="jenis_kendaraan"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            document.getElementById('previewType').textContent = this.value;
        });
    });
</script>

@endsection
