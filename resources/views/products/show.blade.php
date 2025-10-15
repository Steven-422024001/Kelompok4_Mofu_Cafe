@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->title)
@section('page-title', 'Detail Produk')

@push('styles')
<style>
    /* Styling untuk preview gambar */
    .image-container {
        width: 100%;
        aspect-ratio: 1 / 1;
        border: 1px solid var(--mofu-light-border);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        padding: 1rem;
    }
    .image-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
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
</style>
@endpush

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Detail Produk</h5>
            <p class="text-muted mb-0">Melihat detail untuk: {{ $product->title }}</p>
        </div>
        <div>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-app-primary">
                <i class="fas fa-pencil-alt me-1"></i> Edit
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-app-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        {{-- Kolom Kiri: Gambar --}}
        <div class="col-md-4">
            <div class="image-container">
                @if ($product->image)
                    <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->title }}">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
            </div>
        </div>

        {{-- Kolom Kanan: Detail --}}
        <div class="col-md-8">
            <h4 class="fw-bold mb-3">{{ $product->title }}</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="detail-label">Kategori</p>
                    <p class="detail-value">{{ $product->product_category_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="detail-label">Supplier</p>
                    <p class="detail-value">{{ $product->supplier_name ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="detail-label">Harga</p>
                    <p class="detail-value fs-4 fw-bold text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="detail-label">Stok</p>
                    <p class="detail-value">{{ $product->stock }}</p>
                </div>
            </div>
            <hr class="my-3">
            <div>
                <p class="detail-label">Deskripsi</p>
                <div class="bg-light p-3 rounded border">
                    {!! $product->description ?: '<em>Tidak ada deskripsi.</em>' !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection