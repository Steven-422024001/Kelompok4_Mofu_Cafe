@extends('layouts.app')

@section('title', 'Tambah Produk Baru - Mofu Cafe')
@section('page-title', 'Tambah Produk Baru')

@push('styles')
<style>
    /* Styling untuk preview gambar */
    .image-preview-container {
        width: 100%;
        aspect-ratio: 1 / 1;
        border: 2px dashed var(--mofu-light-border);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--mofu-blue-bg);
        overflow: hidden;
    }
    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .image-preview-container .preview-text {
        color: var(--mofu-blue-text);
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Tambah Produk Baru</h5>
            <p class="text-muted mb-0">Isi detail produk yang akan dijual di Mofu Cafe.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-app-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- Kolom Kiri: Gambar --}}
            <div class="col-md-4">
                <div class="image-preview-container mb-3">
                    <img id="image-preview" src="" alt="Pratinjau Gambar" style="display: none;">
                    <span id="preview-text" class="preview-text">Pratinjau Gambar</span>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label fw-semibold">UNGGAH GAMBAR</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Kolom Kanan: Detail Produk --}}
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">NAMA PRODUK</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Contoh: Es Kopi Susu Gula Aren">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="product_category_id" class="form-label fw-semibold">KATEGORI</label>
                        <select class="form-select @error('product_category_id') is-invalid @enderror" id="product_category_id" name="product_category_id">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($data['categories'] as $category)
                                <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('product_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="supplier_id" class="form-label fw-semibold">SUPPLIER</label>
                        <select class="form-select @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($data ['suppliers'] as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label fw-semibold">HARGA</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Contoh: 25000">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label fw-semibold">STOK</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" placeholder="Contoh: 100">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">DESKRIPSI</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="mt-4 border-top pt-4 d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    CKEDITOR.replace('description');

    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        if (CKEDITOR.instances.description) {
            CKEDITOR.instances.description.setData('');
        }
    });

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const previewText = document.getElementById('preview-text');
    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            previewText.style.display = 'none';
            imagePreview.style.display = 'block';
            reader.onload = function(event) {
                imagePreview.setAttribute('src', event.target.result);
            }
            reader.readAsDataURL(file);
        } else {
            previewText.style.display = 'block';
            imagePreview.style.display = 'none';
            imagePreview.setAttribute('src', '');
        }
    });
</script>
@endsection