@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('page-title', 'Edit Kategori')

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Edit Category</h5>
            <p class="text-muted mb-0">Update data untuk kategori: {{ $category->name }}</p>
        </div>
            <a href="{{ route('category.index') }}" class="btn btn-app-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">NAMA KATEGORI</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="e.g., Coffee, Non-Coffee, Pastry">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">DESKRIPSI</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="Masukkan deskripsi singkat mengenai kategori ini">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4 border-top pt-4 d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">Perbarui Kategori</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    CKEDITOR.replace('description');
</script>
@endsection