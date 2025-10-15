@extends('layouts.app')
@section('title', 'Detail Transaksi #' . $transaksi->id)

@section('page-title', 'Detail Transaksi')

@push('styles')
<style>
    /*
    ==============================================
    STYLING KHUSUS HALAMAN DETAIL TRANSAKSI
    ==============================================
    */
    .detail-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--mofu-blue-text);
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }
    .detail-value {
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--mofu-dark-text);
    }
    .table tfoot td {
        border-color: transparent !important;
    }
</style>
@endpush

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Detail Transaksi #{{ $transaksi->id }}</h5>
            <p class="text-muted mb-0">Tanggal: {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d F Y, H:i') }}</p>
        </div>
        <div>
            {{-- Menggunakan class baru btn-app-primary --}}
            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-app-primary">
                <i class="fas fa-pencil-alt me-1"></i> Edit
            </a>
            {{-- Menggunakan class baru btn-app-secondary --}}
            <a href="{{ route('transaksi.index') }}" class="btn btn-app-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Info Header Transaksi --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <p class="detail-label">Kasir</p>
            <p class="detail-value">{{ $transaksi->nama_kasir }}</p>
        </div>
        <div class="col-md-4">
            <p class="detail-label">Pembeli</p>
            <p class="detail-value">{{ $transaksi->nama_pembeli ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="detail-label">Metode Pembayaran</p>
            <p class="detail-value">{{ $transaksi->metode_pembayaran }}</p>
        </div>
    </div>
    
    <hr class="my-4">

    {{-- Tabel Item yang Dibeli --}}
    <h5 class="fw-bold mb-3">Item yang Dibeli</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->details as $detail)
            <tr>
                <td>{{ $detail->product->title ?? 'N/A' }}</td>
                <td>{{ $detail->jumlah_pembelian }}</td>
                <td>Rp {{ number_format($detail->product->price ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($detail->subtotal_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="fw-bold">
                <td colspan="3" class="text-end fs-5">Grand Total:</td>
                <td class="text-end fs-4 text-success">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection