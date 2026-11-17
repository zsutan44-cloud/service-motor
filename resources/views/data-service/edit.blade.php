@extends('layouts.app')

@section('title', 'Edit Data Service')

@section('content')

<style>
    .data-service-page {
        padding: 28px;
        color: #f8fafc;
    }

    .data-service-header {
        margin-bottom: 25px;
    }

    .data-service-header h2 {
        font-weight: 800;
        letter-spacing: -1px;
    }

    .data-service-header p {
        color: #9ca3af;
        margin-bottom: 0;
    }

    .service-form-card {
        background: rgba(30, 32, 39, 0.94);
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 15px 40px rgba(0,0,0,.2);
    }

    .form-label {
        color: #e5e7eb;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .form-control,
    .form-select {
        background: #17191f;
        color: #fff;
        border: 1px solid #41434b;
        border-radius: 10px;
        padding: 12px 14px;
    }

    .form-control:focus,
    .form-select:focus {
        background: #17191f;
        color: #fff;
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245,158,11,.13);
    }

    .form-select option {
        background: #17191f;
        color: #fff;
    }

    .form-control::placeholder {
        color: #777b85;
    }

    .complaint-box {
        background: rgba(245,158,11,.08);
        border: 1px solid rgba(245,158,11,.25);
        border-radius: 10px;
        padding: 14px;
        color: #fbbf24;
        min-height: 48px;
    }

    .form-hint {
        color: #858995;
        font-size: 12px;
        margin-top: 7px;
    }

    .btn-save-service {
        background: #f59e0b;
        color: #17191f;
        border: none;
        border-radius: 10px;
        padding: 12px 23px;
        font-weight: 800;
        transition: .25s;
    }

    .btn-save-service:hover {
        background: #fbbf24;
        color: #17191f;
        transform: translateY(-2px);
    }

    .btn-cancel-service {
        background: #343741;
        color: #fff;
        border-radius: 10px;
        padding: 12px 23px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-cancel-service:hover {
        background: #454955;
        color: #fff;
    }

    .section-caption {
        color: #f59e0b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.5px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .data-service-page {
            padding: 18px;
        }

        .service-form-card {
            padding: 20px;
        }
    }
</style>

<div class="data-service-page">

    <div class="data-service-header">
        <div class="section-caption">MOTOCARE WORKSHOP / SERVICE MANAGEMENT</div>
        <h2><i class="bi bi-pencil-square text-warning me-2"></i>Edit Data Service</h2>
        <p>Perbarui informasi pengerjaan service kendaraan pelanggan.</p>
    </div>

    <div class="service-form-card">

        <div class="section-caption">
            <i class="bi bi-clipboard2-check me-2"></i>INFORMASI PENGERJAAN
        </div>

        <form action="{{ route('data-service.update', $dataService->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">

                <div class="col-md-6">
                    <label for="daftar_service_id" class="form-label">
                        ID Servis Pelanggan
                    </label>

                    <select name="daftar_service_id"
                            id="daftar_service_id"
                            class="form-select"
                            required>

                        @foreach ($daftarServices as $service)
                            <option value="{{ $service->id }}"
                                data-keluhan="{{ $service->keluhan }}"
                                {{ old('daftar_service_id', $dataService->daftar_service_id) == $service->id ? 'selected' : '' }}>

                                #{{ $service->id }}
                                - {{ $service->pelanggan->nama_pelanggan ?? 'Pelanggan' }}
                                ({{ $service->kendaraan->no_plat ?? 'Tanpa Plat' }})

                            </option>
                        @endforeach

                    </select>

                    @error('daftar_service_id')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Keluhan Kendaraan</label>

                    <div class="complaint-box" id="keluhanPreview">
                        Memuat keluhan...
                    </div>

                    <div class="form-hint">
                        Keluhan mengikuti ID Daftar Service yang dipilih.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="estimasi_service" class="form-label">
                        Estimasi Service
                    </label>

                    <input type="text"
                           name="estimasi_service"
                           id="estimasi_service"
                           class="form-control"
                           placeholder="Contoh: 2 jam atau 1 hari"
                           value="{{ old('estimasi_service', $dataService->estimasi_service) }}"
                           required>

                    @error('estimasi_service')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror

                    <div class="form-hint">
                        Isi perkiraan durasi pengerjaan, bukan biaya service.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="nama_mekanik" class="form-label">
                        Nama Mekanik
                    </label>

                    <input type="text"
                           name="nama_mekanik"
                           id="nama_mekanik"
                           class="form-control"
                           placeholder="Masukkan nama mekanik"
                           value="{{ old('nama_mekanik', $dataService->nama_mekanik) }}"
                           required>

                    @error('nama_mekanik')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="sparepart_pengganti" class="form-label">
                        Sparepart Pengganti
                    </label>

                    <textarea name="sparepart_pengganti"
                              id="sparepart_pengganti"
                              class="form-control"
                              rows="4"
                              placeholder="Contoh: Oli mesin, busi, kampas rem...">{{ old('sparepart_pengganti', $dataService->sparepart_pengganti) }}</textarea>

                    @error('sparepart_pengganti')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror

                    <div class="form-hint">
                        Kosongkan jika tidak ada sparepart yang diganti.
                    </div>
                </div>

            </div>

            <hr class="border-secondary my-4">

            <div class="d-flex justify-content-end gap-2 flex-wrap">

                <a href="{{ route('data-service.index') }}"
                   class="btn-cancel-service">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>

                <button type="submit" class="btn-save-service">
                    <i class="bi bi-check-circle me-1"></i> Perbarui Data Service
                </button>

            </div>

        </form>
    </div>
</div>

<script>
    const serviceSelect = document.getElementById('daftar_service_id');
    const keluhanPreview = document.getElementById('keluhanPreview');

    function tampilkanKeluhan() {
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];

        if (!selectedOption || !selectedOption.value) {
            keluhanPreview.textContent = 'Keluhan belum tersedia.';
            return;
        }

        const keluhan = selectedOption.dataset.keluhan;

        keluhanPreview.textContent =
            keluhan || 'Tidak ada keluhan tercatat.';
    }

    serviceSelect.addEventListener('change', tampilkanKeluhan);

    tampilkanKeluhan();
</script>

@endsection
