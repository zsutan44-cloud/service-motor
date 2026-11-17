
@extends('layouts.app')

@section('title', 'Edit Daftar Service')

@section('content')

<style>
    .service-edit {
        color: #f4f5f7;
        position: relative;
        isolation: isolate;
        min-height: calc(100vh - 80px);
    }

    .service-edit::before {
        content: "";
        position: fixed;
        inset: 0;
        left: 255px;
        background:
            linear-gradient(
                rgba(15, 17, 21, .78),
                rgba(15, 17, 21, .90)
            ),
            url('/images/motogp-k.jfif') center center / cover no-repeat;
        z-index: -1;
        pointer-events: none;
    }

    .edit-heading {
        margin-bottom: 25px;
    }

    .edit-heading h2 {
        font-weight: 900;
        letter-spacing: -1px;
    }

    .edit-heading h2 span {
        color: #95D600;
    }

    .edit-heading p {
        color: #b8bec8;
        font-size: 13px;
    }

    .edit-wrapper {
        display: grid;
        grid-template-columns: .85fr 1.5fr;
        gap: 22px;
        align-items: start;
    }

    /* PANEL KIRI */
    .edit-info {
        background:
            linear-gradient(
                180deg,
                rgba(15,18,20,.55),
                rgba(15,18,20,.90)
            ),
            url('/images/motogp-49.jfif') center center / cover no-repeat;
        border: 1px solid rgba(149,214,0,.45);
        border-radius: 18px;
        padding: 25px;
        min-height: 390px;
        position: relative;
        overflow: hidden;
    }

    .edit-info::after {
        content: "UPDATE";
        position: absolute;
        bottom: -12px;
        right: -8px;
        font-size: 55px;
        font-weight: 900;
        color: rgba(255,255,255,.06);
        transform: rotate(-10deg);
        pointer-events: none;
    }

    .monster-mark {
        color: #95D600;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 3px;
    }

    .edit-info h3 {
        font-size: 27px;
        font-weight: 900;
        line-height: 1.2;
        margin-top: 40px;
    }

    .edit-info h3 span {
        color: #95D600;
    }

    .edit-info p {
        color: #d7dbe1;
        font-size: 13px;
        line-height: 1.8;
        margin-top: 14px;
    }

    .info-line {
        width: 55px;
        height: 3px;
        background: #95D600;
        margin: 20px 0;
    }

    .info-item {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-top: 18px;
        font-size: 12px;
        color: #e0e3e8;
    }

    .info-item i {
        color: #95D600;
        font-size: 18px;
    }

    /* FORM */
    .edit-form {
        background: rgba(32,36,43,.92);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(149,214,0,.30);
        border-radius: 18px;
        padding: 27px;
        box-shadow: 0 15px 45px rgba(0,0,0,.25);
    }

    .form-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .form-title h4 {
        font-weight: 800;
        margin: 0;
    }

    .form-tag {
        color: #95D600;
        background: rgba(149,214,0,.10);
        border: 1px solid rgba(149,214,0,.25);
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .section-caption {
        color: #95D600;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin: 22px 0 15px;
    }

    .form-label {
        color: #e2e5e9;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .form-control,
    .form-select {
        background-color: #171a20;
        border: 1px solid #3a404a;
        color: #f4f5f7;
        border-radius: 9px;
        padding: 12px 14px;
        font-size: 13px;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #171a20;
        color: white;
        border-color: #95D600;
        box-shadow: 0 0 0 3px rgba(149,214,0,.12);
    }

    .form-control::placeholder {
        color: #747b87;
    }

    .form-select option {
        background: #20242b;
        color: white;
    }

    .form-control[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }

    .readonly-field {
        background: #252a32 !important;
        color: #95D600 !important;
        font-weight: 700;
    }

    .service-id-box {
        background: rgba(149,214,0,.07);
        border: 1px dashed rgba(149,214,0,.5);
        border-radius: 10px;
        padding: 14px;
    }

    .service-id-box small {
        display: block;
        color: #aeb5bf;
        font-size: 10px;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .service-id-box strong {
        color: #95D600;
        font-size: 20px;
        letter-spacing: 1px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #363c45;
    }

    .btn-back {
        color: #d0d4db;
        border: 1px solid #454c57;
        padding: 11px 18px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-back:hover {
        color: white;
        background: #343a42;
    }

    .btn-update {
        background: #95D600;
        color: #151a0b;
        border: none;
        padding: 11px 20px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 900;
        transition: .2s;
    }

    .btn-update:hover {
        background: #b0f21b;
        transform: translateY(-2px);
    }

    @media (max-width: 900px) {
        .edit-wrapper {
            grid-template-columns: 1fr;
        }

        .edit-info {
            min-height: auto;
        }

        .edit-info h3 {
            margin-top: 20px;
        }

        .service-edit::before {
            left: 0;
        }
    }

    @media (max-width: 500px) {
        .edit-form {
            padding: 18px;
        }

        .form-title {
            align-items: flex-start;
            flex-direction: column;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions a,
        .form-actions button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="service-edit">

    <!-- HEADING -->
    <div class="edit-heading">
        <h2>EDIT <span>WORK ORDER.</span></h2>
        <p>Perbarui informasi pelanggan dan kendaraan yang melakukan service.</p>
    </div>

    <div class="edit-wrapper">

        <!-- PANEL INFORMASI -->
        <div class="edit-info">

            <div class="monster-mark">
                <i class="bi bi-lightning-charge-fill"></i>
                MOTOCARE / SERVICE CENTER
            </div>

            <h3>UPDATE YOUR<br><span>RIDE RECORD.</span></h3>

            <div class="info-line"></div>

            <p>
                Pastikan informasi kendaraan dan pelanggan selalu akurat.
                Setiap perubahan data akan tersimpan ke dalam sistem MotoCare.
            </p>

            <div class="info-item">
                <i class="bi bi-pencil-square"></i>
                Perbarui informasi service
            </div>

            <div class="info-item">
                <i class="bi bi-person-check-fill"></i>
                Data pelanggan terhubung
            </div>

            <div class="info-item">
                <i class="bi bi-shield-check"></i>
                Perubahan data tersimpan
            </div>

        </div>

        <!-- FORM EDIT -->
        <div class="edit-form">

            <div class="form-title">
                <h4>Edit Data Service</h4>
                <span class="form-tag">UPDATE WORK ORDER</span>
            </div>

            <form
                action="{{ route('daftar-service.update', $daftar_service->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <!-- ID SERVIS -->
                <div class="section-caption">
                    <i class="bi bi-upc-scan"></i>
                    Identitas Servis
                </div>

                <div class="service-id-box mb-4">
                    <small>ID SERVIS PELANGGAN</small>
                    <strong>#{{ $daftar_service->id }}</strong>
                </div>

                <!-- KENDARAAN -->
                <div class="section-caption">
                    <i class="bi bi-bicycle"></i>
                    Informasi Kendaraan
                </div>

                <div class="mb-3">

                    <label class="form-label">Nomor Plat Kendaraan</label>

                    <select
                        name="kendaraan_id"
                        class="form-select @error('kendaraan_id') is-invalid @enderror"
                        required>

                        <option value="">-- Pilih nomor plat kendaraan --</option>

                        @foreach ($kendaraans as $kendaraan)

                            <option
                                value="{{ $kendaraan->id }}"
                                {{ old('kendaraan_id', $daftar_service->kendaraan_id) == $kendaraan->id ? 'selected' : '' }}>

                                {{ $kendaraan->nomor_polisi }}

                            </option>

                        @endforeach

                    </select>

                    @error('kendaraan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <!-- PELANGGAN -->
                <div class="section-caption">
                    <i class="bi bi-person-fill"></i>
                    Informasi Pelanggan
                </div>

                <div class="mb-3">

                    <label class="form-label">ID Pelanggan</label>

                    <select
                        name="pelanggan_id"
                        id="pelanggan_id"
                        class="form-select @error('pelanggan_id') is-invalid @enderror"
                        required>

                        <option value="">-- Pilih ID pelanggan --</option>

                        @foreach ($pelanggans as $pelanggan)

                            <option
                                value="{{ $pelanggan->id }}"
                                data-nama="{{ $pelanggan->nama_pelanggan }}"
                                {{ old('pelanggan_id', $daftar_service->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}>

                                {{ $pelanggan->id }}

                            </option>

                        @endforeach

                    </select>

                    @error('pelanggan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Nama Pelanggan</label>

                    <input
                        type="text"
                        id="nama_pelanggan"
                        class="form-control readonly-field"
                        placeholder="Nama pelanggan muncul otomatis"
                        value="{{ optional($pelanggans->firstWhere('id', old('pelanggan_id', $daftar_service->pelanggan_id)))->nama_pelanggan }}"
                        readonly>

                </div>

                <!-- DETAIL SERVICE -->
                <div class="section-caption">
                    <i class="bi bi-tools"></i>
                    Detail Service
                </div>

                <div class="mb-3">

                    <label class="form-label">Keluhan Kendaraan</label>

                    <textarea
                        name="keluhan"
                        rows="4"
                        class="form-control @error('keluhan') is-invalid @enderror"
                        placeholder="Tuliskan keluhan kendaraan pelanggan..."
                        required>{{ old('keluhan', $daftar_service->keluhan) }}</textarea>

                    @error('keluhan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Tanggal Servis</label>

                    <input
                        type="date"
                        name="tanggal_masuk"
                        value="{{ old('tanggal_masuk', $daftar_service->tanggal_masuk) }}"
                        class="form-control @error('tanggal_masuk') is-invalid @enderror"
                        required>

                    @error('tanggal_masuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <!-- TOMBOL -->
                <div class="form-actions">

                    <a
                        href="{{ route('daftar-service.index') }}"
                        class="btn-back">

                        <i class="bi bi-arrow-left"></i>
                        Kembali

                    </a>

                    <button type="submit" class="btn-update">

                        <i class="bi bi-save-fill"></i>
                        SIMPAN PERUBAHAN

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- NAMA PELANGGAN OTOMATIS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const pelangganSelect = document.getElementById('pelanggan_id');
        const namaPelanggan = document.getElementById('nama_pelanggan');

        function tampilkanNamaPelanggan() {

            const selectedOption =
                pelangganSelect.options[pelangganSelect.selectedIndex];

            if (selectedOption && selectedOption.value !== '') {

                namaPelanggan.value =
                    selectedOption.getAttribute('data-nama') || '';

            } else {

                namaPelanggan.value = '';

            }
        }

        pelangganSelect.addEventListener('change', tampilkanNamaPelanggan);

        tampilkanNamaPelanggan();

    });
</script>

@endsection