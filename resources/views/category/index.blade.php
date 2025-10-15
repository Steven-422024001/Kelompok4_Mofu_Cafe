@extends('layouts.app')

@section('title', 'Daftar Kategori - Mofu Cafe')
@section('page-title', 'Category Management')

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

    /* Tambahan style action buttons */
    .action-buttons a, .action-buttons button {
        width: 32px; height: 32px; display: inline-flex;
        align-items: center; justify-content: center;
        border-radius: 0.375rem;
    }
    .action-buttons .btn-dark { background-color: #e2e8f0; color: #4a5568; border: none; }
    .action-buttons .btn-dark:hover { background-color: #cbd5e1; }
    .action-buttons .btn-primary { background-color: #e0e7ff; color: #4338ca; border: none; }
    .action-buttons .btn-primary:hover { background-color: #c7d2fe; }
    .action-buttons .btn-danger { background-color: #fee2e2; color: #b91c1c; border: none; }
    .action-buttons .btn-danger:hover { background-color: #fecaca; }
</style>
@endpush

@section('content')

{{-- Header Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-1">Selamat Datang, Admin Mofu! 👋</h5>
        <p class="text-muted mb-0">Atur semua kategori produk Mofu Cafe di sini</p>
    </div>
    <a href="{{ route('category.create') }}" class="btn btn-add-new">
        <i class="fas fa-plus"></i> Add Category
    </a>
</div>

{{-- Grid Kartu Kategori --}}
<div class="row">
    @forelse ($categories as $category)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card category-card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    {{-- Bagian Atas: Judul dan Ikon --}}
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title fw-bold">{{ $category->name }}</h5>
                        </div>
                        <i class="fas fa-tag fa-2x text-light"></i>
                    </div>

                    {{-- Deskripsi --}}
                    <p class="text-muted mt-3 small flex-grow-1">
                        {!! Str::limit($category->description, 100, '...') !!}
                    </p>

                    {{-- Bagian Bawah: Tombol Aksi --}}
                    <div class="mt-auto d-flex gap-2 action-buttons justify-content-end pt-3 border-top">
                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-sm btn-dark" title="Show">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
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
