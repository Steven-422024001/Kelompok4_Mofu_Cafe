@extends('layouts.app')

@section('title', 'Tambah Kategori Baru')

@section('page-title', 'Tambah Kategori Baru')

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Tambah Kategori Baru</h5>
            <p class="text-muted mb-0">Buat kategori baru untuk produk Anda.</p>
        </div>
            <a href="{{ route('category.index') }}" class="btn btn-app-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
    </div>

    {{-- Form --}}
    <form id="categoryForm" action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">NAMA AKTEGORI</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Coffee, Non-Coffee, Pastry">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">DESKRIPSI</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="Masukkan deskripsi singkat mengenai kategori ini">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4 border-top pt-4 d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    CKEDITOR.replace('description');
</script>
@endsection