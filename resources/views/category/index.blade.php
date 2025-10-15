@extends('layouts.app')

@section('title', 'Daftar Kategori - Mofu Cafe')

@section('page-title', 'Category Management')

@push('styles')
    {{-- Kita tambahkan sedikit style untuk action buttons di dalam kartu --}}
    <style>
        .category-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border: 1px solid var(--mofu-light-border);
            border-radius: 0.75rem; 
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
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
        
        .card-title {
            font-size: 25px;
            font-family: 
        }
    
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
                        {{-- Bagian Atas: Judul dan Jumlah --}}
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
    
    {{-- Link Paginasi --}}
    <div class="d-flex justify-content-center mt-4">
        {!! $categories->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
{{-- Script SweetAlert Anda akan bekerja dengan baik di sini --}}
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