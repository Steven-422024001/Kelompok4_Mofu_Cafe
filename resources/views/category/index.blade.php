@extends('layouts.app')

@section('title', 'Daftar Kategori - Mofu Cafe')

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Category Management</h5>
            <p class="text-muted mb-0">Atur semua kategori produk Mofu Cafe di sini 🏷️</p>
        </div>
        {{-- Menggunakan route 'category.create' --}}
        <a href="{{ route('category.create') }}" class="btn btn-success">ADD CATEGORY</a>
    </div>

    {{-- Tabel Data Kategori --}}
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col" style="width: 5%">ID</th>
                <th scope="col">CATEGORY NAME</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col" style="width: 20%">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            {{-- Variabel loop diubah menjadi $categories --}}
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ Str::limit(strip_tags($category->description), 50, '...') }}</td>
                    <td class="text-center">
                        {{-- Semua route di sini sudah menggunakan 'category' --}}
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline form-delete">
                            <a href="{{ route('category.show', $category->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete">DELETE</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Data Kategori belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Link Paginasi --}}
    <div class="d-flex justify-content-center">
        {!! $categories->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
{{-- Script SweetAlert tidak perlu diubah, hanya dirapikan --}}
<script src="https://cdn.jsdelivr-net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Notifikasi dari session
        @if(session('success'))
            Swal.fire({ icon: "success", title: "BERHASIL", text: "{{ session('success') }}", showConfirmButton: false, timer: 2000 });
        @elseif(session('error'))
            Swal.fire({ icon: "error", title: "GAGAL", text: "{{ session('error') }}", showConfirmButton: false, timer: 2000 });
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