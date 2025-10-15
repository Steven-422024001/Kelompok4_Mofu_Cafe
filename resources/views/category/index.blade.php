@extends('layouts.app')

@section('title', 'Daftar Kategori - Mofu Cafe')
@section('page-title', 'Category Management')

@push('styles')
    <style>
        /* Styling untuk setiap Kartu Kategori */
        .category-card {
            background-color: var(--mofu-blue-bg); 
            border: 1px solid var(--mofu-light-border); 
            border-radius: 0.75rem;
            box-shadow: none; 
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            display: flex;
            flex-direction: column;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-title {
            font-weight: 700;
            color: var(--mofu-dark-text);
        }
        
        .card-icon {
            font-size: 1.5rem;
            color: var(--mofu-blue-text);
        }

        .card-description {
            color: var(--mofu-blue-text);
            font-size: 0.875rem;
            margin-top: 0.75rem;
            flex-grow: 1; 
        }
        
        .card-actions {
            margin-top: auto; 
            padding-top: 1rem;
            border-top: 1px solid var(--mofu-light-border);
        }
    </style>
@endpush

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Semua Kategori</h5>
            <p class="text-muted mb-0">Kelola semua kategori produk Mofu Cafe di sini 🏷️</p>
        </div>
        <a href="{{ route('category.create') }}" class="btn btn-app-primary">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    {{-- Grid Kartu Kategori --}}
    <div class="row">
        @forelse ($categories as $category)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card category-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title">{{ $category->name }}</h5>
                            </div>
                            <i class="fas fa-tag card-icon"></i>
                        </div>

                        <p class="card-description">
                            {!! Str::limit($category->description, 100, '...') !!}
                        </p>

                        <div class="action-buttons justify-content-end d-flex gap-2 card-actions">
                           <a href="{{ route('category.show', $category->id) }}" class="btn btn-dark" title="Lihat"><i class="fas fa-eye"></i></a>
                           <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                           <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="form-delete">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-danger btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></button>
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
    
    {{-- Link Paginasi --}}
    <div class="d-flex justify-content-center mt-4">
        {!! $categories->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Notifikasi dari session
        @if(session('success'))
            Swal.fire({
                icon: "success", title: "BERHASIL", text: "{{ session('success') }}",
                showConfirmButton: false, timer: 2000
            });
        @endif

        // Konfirmasi hapus
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
</script>
@endsection