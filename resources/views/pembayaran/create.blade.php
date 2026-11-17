
@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')

<style>
    .payment-form-page {
        color: white;
        padding: 10px 0 35px;
    }

    .payment-form-header {
        margin-bottom: 25px;
    }

    .payment-form-header h2 {
        font-weight: 800;
    }

    .payment-form-header p {
        color: #aeb4c0;
    }

    .payment-form-card {
        background: #242832;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 18px;
        padding: 30px;
        max-width: 850px;
    }

    .payment-form-card label {
        color: #e5e7eb;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .payment-form-card .form-control,
    .payment-form-card .form-select {
        background-color: #191c23;
        border: 1px solid #414651;
        color: white;
        padding: 12px 14px;
        border-radius: 9px;
    }

    .payment-form-card .form-control:focus,
    .payment-form-card .form-select:focus {
        border-color: #ff7628;
        box-shadow: 0 0 0 .2rem rgba(255,118,40,.15);
    }

    .payment-form-card .form-select option {
        background: #242832;
        color: white;
    }

    .payment-info {
        background: #191c23;
        border: 1px solid #414651;
        border-radius: 12px;
        padding: 18px;
        margin-top: 15px;
    }

    .payment-info h6 {
        color: #ff873f;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .payment-info p {
        color: #c5cad3;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .payment-radio {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .payment-radio label {
        background: #191c23;
        border: 1px solid #414651;
        border-radius: 10px;
        padding: 13px 18px;
        cursor: pointer;
        margin: 0;
    }

    .payment-radio input {
        accent-color: #ff7628;
        margin-right: 7px;
    }

    .payment-save-btn {
        background: #ff7628;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 9px;
        font-weight: 700;
    }

    .payment-save-btn:hover {
        background: #e96317;
    }

    .payment-back-btn {
        background: #414651;
        color: white;
        padding: 12px 22px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
    }

    .payment-back-btn:hover {
        background: #535966;
        color: white;
    }
</style>

<div class="payment-form-page">

    <div class="payment-form-header">
        <h2>TAMBAH PEMBAYARAN</h2>
        <p>Masukkan informasi transaksi pembayaran service pelanggan.</p>
    </div>

    <div class="payment-form-card">

        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="data_service_id">
                    ID Servis Pelanggan
                </label>

                <select
                    name="data_service_id"
                    id="data_service_id"
                    class="form-select"
                    required
                >
                    <option value="">-- Pilih ID Data Service --</option>

                    @foreach($dataServices as $dataService)
                        <option
                            value="{{ $dataService->id }}"
                            data-pelanggan="{{ $dataService->daftarService->pelanggan->nama_pelanggan ?? '-' }}"
                            data-plat="{{ $dataService->daftarService->kendaraan->nomor_polisi ?? '-' }}"
                            data-mekanik="{{ $dataService->nama_mekanik }}"
                            data-estimasi="{{ $dataService->estimasi_service }}"
                            data-keluhan="{{ $dataService->daftarService->keluhan ?? '-' }}"
                            {{ old('data_service_id') == $dataService->id ? 'selected' : '' }}
                        >
                            Data Service #{{ $dataService->id }}
                            - {{ $dataService->daftarService->pelanggan->nama_pelanggan ?? 'Pelanggan' }}
                        </option>
                    @endforeach
                </select>

                @error('data_service_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="payment-info" id="serviceInfo" style="display:none">
                    <h6>INFORMASI DATA SERVICE</h6>

                    <p>ID Data Service: <strong id="infoId">-</strong></p>
                    <p>Nama Pelanggan: <strong id="infoPelanggan">-</strong></p>
                    <p>No. Plat Kendaraan: <strong id="infoPlat">-</strong></p>
                    <p>Nama Mekanik: <strong id="infoMekanik">-</strong></p>
                    <p>Estimasi Service: <strong id="infoEstimasi">-</strong></p>
                    <p>Keluhan: <strong id="infoKeluhan">-</strong></p>
                </div>
            </div>

            <div class="mb-4">
                <label for="total_bayar">
                    Jumlah Biaya Servis (Rp)
                </label>

                <input
                    type="number"
                    name="total_bayar"
                    id="total_bayar"
                    class="form-control"
                    placeholder="Contoh: 150000"
                    min="0"
                    step="1000"
                    value="{{ old('total_bayar') }}"
                    required
                >

                @error('total_bayar')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label>Jenis Pembayaran</label>

                <div class="payment-radio">
                    <label>
                        <input
                            type="radio"
                            name="metode_pembayaran"
                            value="Tunai"
                            {{ old('metode_pembayaran', 'Tunai') == 'Tunai' ? 'checked' : '' }}
                        >
                        Cash / Tunai
                    </label>

                    <label>
                        <input
                            type="radio"
                            name="metode_pembayaran"
                            value="Non Tunai"
                            {{ old('metode_pembayaran') == 'Non Tunai' ? 'checked' : '' }}
                        >
                        Non Tunai
                    </label>
                </div>

                @error('metode_pembayaran')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="keterangan">
                    Keterangan
                </label>

                <textarea
                    name="keterangan"
                    id="keterangan"
                    class="form-control"
                    rows="4"
                    placeholder="Masukkan keterangan pembayaran..."
                >{{ old('keterangan') }}</textarea>

                @error('keterangan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <hr style="border-color:rgba(255,255,255,.12)">

            <div class="d-flex justify-content-end gap-2 flex-wrap">
                <a href="{{ route('pembayaran.index') }}" class="payment-back-btn">
                    Kembali
                </a>

                <button type="submit" class="payment-save-btn">
                    <i class="bi bi-save me-2"></i>
                    Simpan Pembayaran
                </button>
            </div>

        </form>

    </div>

</div>

<script>
    const serviceSelect = document.getElementById('data_service_id');
    const serviceInfo = document.getElementById('serviceInfo');

    function tampilkanInfoService() {
        const option = serviceSelect.options[serviceSelect.selectedIndex];

        if (!option.value) {
            serviceInfo.style.display = 'none';
            return;
        }

        document.getElementById('infoId').textContent = option.value;
        document.getElementById('infoPelanggan').textContent = option.dataset.pelanggan;
        document.getElementById('infoPlat').textContent = option.dataset.plat;
        document.getElementById('infoMekanik').textContent = option.dataset.mekanik;
        document.getElementById('infoEstimasi').textContent = option.dataset.estimasi;
        document.getElementById('infoKeluhan').textContent = option.dataset.keluhan;

        serviceInfo.style.display = 'block';
    }

    serviceSelect.addEventListener('change', tampilkanInfoService);

    tampilkanInfoService();
</script>

@endsection
