
@extends('layouts.app')

@section('title', 'Pembayaran Service')

@section('content')

<style>
    .payment-page {
        padding: 10px 0 35px;
        color: #fff;
    }

    .payment-hero {
        background: linear-gradient(120deg, #20232b, #343943);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 25px;
    }

    .payment-hero h2 {
        font-weight: 800;
        margin-bottom: 8px;
    }

    .payment-hero p {
        color: #b9bec8;
        margin: 0;
    }

    .payment-add-btn {
        background: #ff7628;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
    }

    .payment-add-btn:hover {
        background: #e96317;
        color: white;
    }

    .payment-summary {
        background: #242832;
        border: 1px solid rgba(255,255,255,.07);
        padding: 22px;
        border-radius: 16px;
        margin-bottom: 25px;
    }

    .payment-summary small {
        color: #aeb4c0;
    }

    .payment-summary h3 {
        color: #ff873f;
        font-weight: 800;
        margin: 8px 0 0;
    }

    .payment-search {
        background: #242832;
        border: 1px solid rgba(255,255,255,.1);
        color: white;
        border-radius: 10px;
        padding: 13px 16px;
        width: 100%;
        outline: none;
        margin-bottom: 22px;
    }

    .payment-search:focus {
        border-color: #ff7628;
    }

    .payment-search::placeholder {
        color: #9299a5;
    }

    .payment-card {
        background: #242832;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 17px;
        padding: 22px;
        height: 100%;
        transition: .2s;
    }

    .payment-card:hover {
        transform: translateY(-4px);
        border-color: #ff7628;
    }

    .payment-card h5 {
        font-weight: 800;
        color: #fff;
    }

    .payment-card p {
        color: #c1c5ce;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .payment-id {
        color: #ff873f;
        font-weight: 800;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .payment-amount {
        font-size: 23px;
        color: #ff873f;
        font-weight: 800;
        margin: 15px 0;
    }

    .payment-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        background: rgba(255,118,40,.15);
        color: #ff9b65;
    }

    .payment-actions {
        display: flex;
        gap: 8px;
        margin-top: 18px;
    }

    .payment-actions a,
    .payment-actions button {
        flex: 1;
        border: none;
        border-radius: 8px;
        padding: 9px;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
    }

    .btn-payment-edit {
        background: #34445e;
        color: white;
    }

    .btn-payment-delete {
        background: #633333;
        color: #ffb0a8;
    }

    .payment-empty {
        background: #242832;
        padding: 45px 20px;
        border-radius: 16px;
        text-align: center;
        color: #b9bec8;
    }

    .payment-empty h5 {
        color: white;
    }

    .payment-alert {
        border-radius: 10px;
        margin-bottom: 20px;
    }
</style>

<div class="payment-page">

    <div class="payment-hero d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h2>PEMBAYARAN SERVICE</h2>
            <p>Kelola seluruh transaksi pembayaran pelanggan MotoCare.</p>
        </div>

        <a href="{{ route('pembayaran.create') }}" class="payment-add-btn">
            <i class="bi bi-plus-circle me-2"></i>
            Tambah Pembayaran
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success payment-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="payment-summary">
        <small>TOTAL TRANSAKSI PEMBAYARAN</small>
        <h3>{{ $pembayarans->count() }} Transaksi</h3>
    </div>

    <input
        type="text"
        id="paymentSearch"
        class="payment-search"
        placeholder="Cari ID pembayaran, ID service, pelanggan, atau metode pembayaran..."
    >

    <div class="row g-4" id="paymentList">

        @forelse($pembayarans as $pembayaran)

            @php
                $dataService = $pembayaran->dataService;
                $daftarService = $dataService?->daftarService;
                $pelanggan = $daftarService?->pelanggan;
                $kendaraan = $daftarService?->kendaraan;
            @endphp

            <div class="col-lg-6 col-xl-4 payment-item">
                <div class="payment-card">

                    <div class="payment-id">
                        PEMBAYARAN #{{ $pembayaran->id }}
                    </div>

                    <h5>
                        {{ $pelanggan->nama_pelanggan ?? 'Data pelanggan tidak tersedia' }}
                    </h5>

                    <p>
                        ID Data Service:
                        #{{ $pembayaran->data_service_id ?? '-' }}
                    </p>

                    <p>
                        Kendaraan:
                        {{ $kendaraan->nomor_polisi ?? '-' }}
                    </p>

                    <p>
                        Mekanik:
                        {{ $dataService->nama_mekanik ?? '-' }}
                    </p>

                    <div class="payment-amount">
                        Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <span class="payment-badge">
                            {{ $pembayaran->metode_pembayaran }}
                        </span>

                        <span class="payment-badge">
                            {{ $pembayaran->status_pembayaran }}
                        </span>
                    </div>

                    <hr style="border-color:rgba(255,255,255,.12)">

                    <p>
                        <i class="bi bi-calendar3 me-2"></i>
                        {{ $pembayaran->tanggal_pembayaran
                            ? \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y')
                            : 'Tanggal belum tersedia' }}
                    </p>

                    <p>
                        <i class="bi bi-chat-left-text me-2"></i>
                        {{ $pembayaran->keterangan ?: 'Tidak ada keterangan' }}
                    </p>

                    <div class="payment-actions">

                        <a
                            href="{{ route('pembayaran.edit', $pembayaran->id) }}"
                            class="btn-payment-edit"
                        >
                            <i class="bi bi-pencil-square me-1"></i>
                            Edit
                        </a>

                        <form
                            action="{{ route('pembayaran.destroy', $pembayaran->id) }}"
                            method="POST"
                            style="flex:1"
                            onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-payment-delete w-100">
                                <i class="bi bi-trash me-1"></i>
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="payment-empty">
                    <i class="bi bi-wallet2 fs-1"></i>
                    <h5 class="mt-3">Belum Ada Pembayaran</h5>
                    <p>Data pembayaran service akan muncul di sini.</p>
                </div>
            </div>

        @endforelse

    </div>

    <div id="paymentNotFound" class="payment-empty mt-3" style="display:none">
        <h5>Data Tidak Ditemukan</h5>
        <p>Coba gunakan kata kunci pencarian lainnya.</p>
    </div>

</div>

<script>
    document.getElementById('paymentSearch').addEventListener('input', function () {
        let keyword = this.value.toLowerCase();
        let cards = document.querySelectorAll('.payment-item');
        let visible = 0;

        cards.forEach(function (card) {
            let content = card.innerText.toLowerCase();
            let match = content.includes(keyword);

            card.style.display = match ? '' : 'none';

            if (match) visible++;
        });

        let notFound = document.getElementById('paymentNotFound');

        if (notFound) {
            notFound.style.display = visible === 0 ? 'block' : 'none';
        }
    });
</script>

@endsection
