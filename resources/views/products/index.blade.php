@extends('layouts.app')

@section('title', 'Daftar Produk - Mofu Cafe')
@section('page-title', 'Manajemen Produk')

@push('styles')
<style>
    /* Styling untuk Grid Kartu Produk */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1.5rem; 
    }
    .product-card {
        border: 1px solid var(--mofu-light-border);
        border-radius: 0.75rem;
        box-shadow: var(--mofu-shadow-soft);
        overflow: hidden;
        display: flex;
        flex-direction: column; 
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }
    .product-image-container {
        aspect-ratio: 4 / 3; 
        overflow: hidden; 
    }
    .product-image-container img {
        width: 100%; height: 100%; object-fit: cover;
    }
    .product-info {
        padding: 1rem;
        flex-grow: 1; 
        display: flex;
        flex-direction: column;
    }
    .product-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: var(--mofu-dark-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--status-green);
        margin-bottom: 0.75rem;
    }
    .product-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: auto; 
    }
    .product-actions {
        padding: 0 1rem 1rem 1rem;
    }
</style>
@endpush

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Daftar Produk</h5>
            <p class="text-muted mb-0">Atur semua produk, harga, dan stok Mofu Cafe di sini ☕</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-app-primary">
            <i class="fas fa-plus me-1"></i> Tambah Produk
        </a>
    </div>

    {{-- Grid Kartu Produk --}}
    <div class="product-grid">
        @forelse ($products as $product)
            <div class="product-card">
                <div class="product-image-container">
                    <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->title }}">
                </div>
                <div class="product-info">
                    <h5 class="product-title" title="{{ $product->title }}">{{ $product->title }}</h5>
                    <p class="product-price">{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</p>
                    <div class="product-meta">
                        <span><strong>Stok:</strong> {{ $product->stock }}</span>
                        <span class="badge bg-light text-dark">{{ $product->product_category_name ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="product-actions">
                    <div class="action-buttons justify-content-center d-flex">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-dark" title="Lihat"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-secondary text-center" style="grid-column: 1 / -1;">
                Data produk belum tersedia.
            </div>
        @endforelse
    </div>

    @if ($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {!! $products->links('pagination::bootstrap-5') !!}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Notifikasi sukses atau gagal
        @if(session('success'))
            Swal.fire({
                icon: "success", title: "BERHASIL", text: "{{ session('success') }}",
                showConfirmButton: false, timer: 2000
            });
        @endif

        // Konfirmasi hapus data
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning', showCancelButton: true,
                    confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) { this.submit(); }
                });
            });
        });
    });
</script>
@endsection