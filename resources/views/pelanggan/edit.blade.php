
@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')

<style>
    .customer-edit {
        color: #f8fafc;
        padding: 28px;
        position: relative;
        isolation: isolate;
        min-height: 100vh;
    }

    .customer-edit::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        background:
            linear-gradient(rgba(15,17,22,.82), rgba(15,17,22,.88)),
            url('/images/motor-racing.jfif') center center / cover no-repeat;
    }

    .edit-header {
        margin-bottom: 25px;
    }

    .edit-header h2 {
        font-weight: 800;
        margin-bottom: 7px;
    }

    .edit-header p {
        color: #aeb4c0;
        margin: 0;
    }

    .edit-wrapper {
        display: grid;
        grid-template-columns: 1.7fr 1fr;
        gap: 22px;
        align-items: start;
    }

    .edit-card,
    .edit-info {
        background: rgba(30, 33, 42, .88);
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 18px;
        padding: 26px;
        backdrop-filter: blur(12px);
        box-shadow: 0 12px 35px rgba(0,0,0,.2);
    }

    .edit-card h5,
    .edit-info h5 {
        font-weight: 700;
        margin-bottom: 22px;
    }

    .edit-card .form-label {
        color: #e5e7eb;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 9px;
    }

    .edit-card .form-control {
        background: #252832;
        border: 1px solid #3b3f4b;
        color: #fff;
        border-radius: 10px;
        padding: 12px 14px;
    }

    .edit-card .form-control:focus {
        background: #252832;
        color: #fff;
        border-color: #D71920;
        box-shadow: 0 0 0 3px rgba(215,25,32,.15);
    }

    .edit-card .form-control::placeholder {
        color: #858b98;
    }

    .edit-card textarea {
        min-height: 110px;
        resize: vertical;
    }

    .edit-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-update {
        background: #D71920;
        color: #fff;
        border: none;
        border-radius: 9px;
        padding: 11px 20px;
        font-weight: 600;
    }

    .btn-update:hover {
        background: #b9151b;
        color: #fff;
    }

    .btn-cancel {
        background: #383c47;
        color: #fff;
        border-radius: 9px;
        padding: 11px 20px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #484d5a;
        color: #fff;
    }

    .info-icon {
        width: 45px;
        height: 45px;
        background: rgba(215,25,32,.15);
        color: #ff4249;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-bottom: 17px;
    }

    .edit-info p {
        color: #aeb4c0;
        font-size: 14px;
        line-height: 1.7;
    }

    .edit-info hr {
        border-color: #454955;
        margin: 20px 0;
    }

    .edit-info .customer-id {
        color: #ff555b;
        font-weight: 700;
    }

    @media (max-width: 900px) {
        .edit-wrapper {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .customer-edit {
            padding: 18px;
        }

        .edit-card,
        .edit-info {
            padding: 20px;
        }

        .edit-actions {
            flex-direction: column;
        }

        .edit-actions a,
        .edit-actions button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="customer-edit">

    <div class="edit-header">
        <h2>Edit Data Pelanggan</h2>
        <p>Perbarui informasi pelanggan MotoCare Service.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum berhasil diperbarui!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="edit-wrapper">

        <div class="edit-card">
            <h5><i class="bi bi-pencil-square me-2 text-danger"></i>Form Edit Pelanggan</h5>

            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        name="nama_pelanggan"
                        class="form-control"
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Pekerjaan</label>
                    <input
                        type="text"
                        name="pekerjaan"
                        class="form-control"
                        placeholder="Masukkan pekerjaan"
                        value="{{ old('pekerjaan', $pelanggan->pekerjaan) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea
                        name="alamat"
                        class="form-control"
                        placeholder="Masukkan alamat lengkap"
                        required
                    >{{ old('alamat', $pelanggan->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        placeholder="Masukkan nomor HP"
                        value="{{ old('no_hp', $pelanggan->no_hp) }}"
                        required
                    >
                </div>

                <div class="edit-actions">
                    <a href="{{ route('pelanggan.index') }}" class="btn-cancel">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>

                    <button type="submit" class="btn-update">
                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="edit-info">
            <div class="info-icon">
                <i class="bi bi-person-gear"></i>
            </div>

            <h5>Informasi Pelanggan</h5>

            <p>
                Pastikan informasi pelanggan yang diperbarui sudah benar
                sebelum menyimpan perubahan.
            </p>

            <hr>

            <p class="mb-2">ID Pelanggan</p>
            <div class="customer-id">
                #{{ $pelanggan->id }}
            </div>

            <hr>

            <p class="mb-0">
                <i class="bi bi-shield-check text-danger me-2"></i>
                Perubahan data akan langsung tersimpan ke database setelah
                tombol Simpan Perubahan ditekan.
            </p>
        </div>

    </div>
</div>

@endsection
