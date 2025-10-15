@extends('layouts.app')

@section('title', 'Daftar Kategori - Mofu Cafe')

@push('styles')
<style>
    /* ==============================================
       STYLING KHUSUS HALAMAN INDEKS KATEGORI
    ============================================== */
    .category-card {
        background-color: #fff;
        border: 2px solid var(--mofu-light-border);
        border-radius: 40px;
        padding: 1.25rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .category-card__body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .category-card__icon {
        width: 40px;
        height: 40px;
        background-color: var(--mofu-blue-text);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .category-card__title {
        font-weight: 700;
        margin-bottom: 0.1rem;
        color: var(--mofu-dark-text);
    }

    .category-card__subtitle {
        color: var(--mofu-text-muted);
        font-size: 0.9rem;
    }

    .category-card__description {
        color: var(--mofu-text-muted);
        font-size: 0.875rem;
        margin-top: 0.75rem;
        flex-grow: 1;
    }

    .category-card__actions {
        margin-top: auto;
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }
</style>
@endpush

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Category Management</h5>
            <p class="text-muted mb-0">Atur semua kategori produk Mofu Cafe di sini 🏷️</p>
        </div>
        <a href="{{ route('category.create') }}" class="btn btn-add-new">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    {{-- Grid Kartu Kategori --}}
    <div class="row category-grid">
        @forelse ($categories as $category)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="category-card h-100">
                    <div class="category-card__body">
                        <div class="d-flex align-items-start">
                            <div class="category-card__icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div>
                                <h5 class="category-card__title">{{ $category->name }}</h5>
                                <h6 class="category-card__subtitle">{{ $category->products_count }} {{ Str::plural('Item', $category->products_count) }}</h6>
                            </div>
                        </div>
                        <p class="category-card__description">
                            {!! Str::limit($category->description, 60, '...') !!}
                        </p>
                        <div class="category-card__actions">
                            <a href="{{ route('category.show', $category->id) }}" class="btn btn-sm btn-dark" title="Show"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center">
                    Data Kategori belum tersedia.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Paginasi --}}
    <div class="d-flex justify-content-center mt-4">
        {!! $categories->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 🔔 Notifikasi dari session
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL",
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        // 🗑️ Konfirmasi Hapus
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const f = this;
                Swal.fire({
                    title: 'Yakin ingin menghapus kategori ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) f.submit();
                });
            });
        });
    });
</script>
@endsection
