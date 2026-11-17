
@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')

<style>
    .customer-create {
        color: #f8fafc;
        padding: 28px;
        position: relative;
        isolation: isolate;
        min-height: 100vh;
    }

    /* BACKGROUND SAMA DENGAN INDEX */
    .customer-create::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        background:

            url('/images/motor-racing.jfif') center center / cover no-repeat;
    }

    /* HEADER */
    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        gap: 15px;
    }

    .page-heading h2 {
        font-size: 27px;
        font-weight: 800;
        margin-bottom: 7px;
        letter-spacing: -.7px;
    }

    .page-heading p {
        color: #c0c6d0;
        margin: 0;
        font-size: 13px;
    }

    .back-btn {
        color: #e2e8f0;
        border: 1px solid #3b414c;
        background: rgba(36, 40, 50, .9);
        padding: 10px 17px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 13px;
        transition: .2s;
    }

    .back-btn:hover {
        background: #d71920;
        color: white;
        border-color: #d71920;
    }

    /* MAIN LAYOUT */
    .form-wrapper {
        display: grid;
        grid-template-columns: 1fr 290px;
        gap: 22px;
        align-items: stretch;
    }

    /* FORM CARD */
    .form-card {
        background: rgba(25, 28, 35, .88);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,.13);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,.3);
    }

    .form-card-header {
        padding: 23px 26px;
        border-bottom: 1px solid rgba(255,255,255,.12);
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .header-icon {
        width: 43px;
        height: 43px;
        background: rgba(215, 25, 32, .17);
        color: #ed252d;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        font-size: 20px;
    }

    .form-card-header h5 {
        font-size: 16px;
        font-weight: 750;
        margin: 0 0 4px;
        color: #fff;
    }

    .form-card-header p {
        font-size: 12px;
        color: #aeb7c5;
        margin: 0;
    }

    .form-body {
        padding: 27px;
    }

    /* INPUT GRID */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label-custom {
        display: block;
        font-size: 13px;
        font-weight: 650;
        color: #e2e8f0;
        margin-bottom: 9px;
    }

    .form-label-custom span {
        color: #ef4444;
    }

    .input-custom {
        width: 100%;
        background: rgba(18, 21, 27, .9);
        border: 1px solid #454b57;
        color: #f8fafc;
        padding: 13px 15px;
        border-radius: 9px;
        font-size: 13px;
        outline: none;
        transition: .2s;
    }

    .input-custom::placeholder {
        color: #8993a3;
    }

    .input-custom:focus {
        border-color: #ed252d;
        box-shadow: 0 0 0 3px rgba(237,37,45,.13);
        background: rgba(25, 29, 37, .98);
        color: white;
    }

    textarea.input-custom {
        resize: vertical;
        min-height: 105px;
    }

    /* FOOTER */
    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(255,255,255,.12);
        padding-top: 23px;
        gap: 12px;
    }

    .required-note {
        font-size: 11px;
        color: #aeb7c5;
    }

    .btn-cancel {
        background: #343945;
        color: #e2e8f0;
        border: 0;
        border-radius: 8px;
        padding: 11px 19px;
        text-decoration: none;
        font-size: 13px;
        transition: .2s;
    }

    .btn-cancel:hover {
        background: #454b58;
        color: white;
    }

    .btn-save {
        background: #d71920;
        color: white;
        border: 0;
        border-radius: 8px;
        padding: 11px 20px;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-save:hover {
        background: #f02b33;
        transform: translateY(-2px);
    }

    /* SIDE INFORMATION */
    .side-card {
        background: linear-gradient(
            155deg,
            rgba(41, 45, 55, .94),
            rgba(27, 30, 38, .94)
        );
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,.13);
        border-radius: 15px;
        padding: 24px;
        position: relative;
        overflow: hidden;
    }

    .side-card::after {
        content: '';
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(215,25,32,.12);
        right: -90px;
        top: 90px;
        pointer-events: none;
    }

    .side-label {
        color: #ed252d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .side-card h4 {
        font-weight: 800;
        font-size: 22px;
        margin-top: 12px;
        line-height: 1.3;
        color: white;
    }

    .side-card p {
        color: #b5bdca;
        font-size: 12px;
        line-height: 1.8;
        margin-top: 12px;
    }

    .side-divider {
        height: 1px;
        background: rgba(255,255,255,.13);
        margin: 22px 0;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 17px;
    }

    .info-item i {
        color: #ed252d;
        font-size: 18px;
    }

    .info-item div {
        font-size: 12px;
        color: #e2e8f0;
    }

    .info-item small {
        display: block;
        color: #9ba5b5;
        margin-top: 3px;
    }

    /* VALIDATION */
    .validation-box {
        background: rgba(220,38,38,.14);
        border: 1px solid rgba(220,38,38,.4);
        color: #fecaca;
        border-radius: 9px;
        padding: 14px 18px;
        font-size: 13px;
        margin-bottom: 22px;
    }

    /* RESPONSIVE */
    @media (max-width: 1000px) {
        .form-wrapper {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .customer-create {
            padding: 18px 12px;
        }

        .page-heading {
            align-items: flex-start;
        }

        .page-heading h2 {
            font-size: 21px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .form-body {
            padding: 19px;
        }

        .form-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .form-footer > div:last-child {
            display: flex;
            justify-content: flex-end;
        }
    }
</style>

<div class="customer-create">

    <!-- PAGE HEADER -->
    <div class="page-heading">
        <div>
            <h2>Tambah Pelanggan</h2>
            <p>Dashboard / Data Pelanggan / Tambah Pelanggan</p>
        </div>

        <a href="{{ route('pelanggan.index') }}" class="back-btn">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <!-- FORM CONTENT -->
    <div class="form-wrapper">

        <div class="form-card">

            <div class="form-card-header">
                <div class="header-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>

                <div>
                    <h5>Informasi Pelanggan</h5>
                    <p>Lengkapi informasi pelanggan di bawah ini.</p>
                </div>
            </div>

            <div class="form-body">

                @if ($errors->any())
                    <div class="validation-box">
                        <strong>Periksa kembali data kamu:</strong>

                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf

                    <div class="form-grid">

                        <!-- NAMA -->
                        <div class="form-group">
                            <label class="form-label-custom">
                                Nama Lengkap <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_pelanggan"
                                class="input-custom"
                                placeholder="Contoh: Ahmad Rizki"
                                value="{{ old('nama_pelanggan') }}"
                                required
                            >
                        </div>

                        <!-- PEKERJAAN -->
                        <div class="form-group">
                            <label class="form-label-custom">
                                Pekerjaan <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="pekerjaan"
                                class="input-custom"
                                placeholder="Contoh: Mahasiswa"
                                value="{{ old('pekerjaan') }}"
                                required
                            >
                        </div>

                        <!-- ALAMAT -->
                        <div class="form-group full">
                            <label class="form-label-custom">
                                Alamat Lengkap <span>*</span>
                            </label>

                            <textarea
                                name="alamat"
                                class="input-custom"
                                placeholder="Masukkan alamat lengkap pelanggan..."
                                required
                            >{{ old('alamat') }}</textarea>
                        </div>

                        <!-- NO HP -->
                        <div class="form-group full">
                            <label class="form-label-custom">
                                Nomor Handphone <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="no_hp"
                                class="input-custom"
                                placeholder="Contoh: 081234567890"
                                value="{{ old('no_hp') }}"
                                maxlength="15"
                                required
                            >
                        </div>

                    </div>

                    <!-- BUTTONS -->
                    <div class="form-footer">

                        <div class="required-note">
                            <span class="text-danger">*</span>
                            Wajib diisi
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('pelanggan.index') }}"
                               class="btn-cancel">
                                Batal
                            </a>

                            <button type="submit" class="btn-save">
                                <i class="bi bi-check2-circle me-1"></i>
                                Simpan Pelanggan
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

        <!-- SIDE INFORMATION -->
        <div class="side-card">

            <span class="side-label">MOTOCARE SERVICE</span>

            <h4>Customer<br>Registration</h4>

            <p>
                Kelola informasi pelanggan dengan mudah.
                Pastikan seluruh data yang dimasukkan sudah benar
                sebelum disimpan ke sistem.
            </p>

            <div class="side-divider"></div>

            <div class="info-item">
                <i class="bi bi-person-vcard"></i>

                <div>
                    Data Identitas
                    <small>Informasi pelanggan</small>
                </div>
            </div>

            <div class="info-item">
                <i class="bi bi-geo-alt"></i>

                <div>
                    Alamat Pelanggan
                    <small>Lokasi tempat tinggal</small>
                </div>
            </div>

            <div class="info-item">
                <i class="bi bi-telephone"></i>

                <div>
                    Kontak Pelanggan
                    <small>Nomor handphone aktif</small>
                </div>
            </div>

            <div class="side-divider"></div>

            <span class="side-label">
                SERVICE MANAGEMENT SYSTEM
            </span>

        </div>

    </div>

</div>

@endsection
