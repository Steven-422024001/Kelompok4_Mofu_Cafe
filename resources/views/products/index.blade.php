@extends('layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Product Management')

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Product Overview</h5>
        <a href="{{ route('products.create') }}" class="btn btn-add-new">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    {{-- Tabel Produk --}}
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>IMAGE</th>
                <th>TITLE</th>
                <th>SUPPLIER</th>
                <th>CATEGORY</th>
                <th>PRICE</th>
                <th>STOCK</th>
                <th style="width: 20%">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/images/' . $product->image) }}" width="100" class="rounded"></td>
                    <td>{{ $product->title }}</td>
                    {{-- Mengambil nama dari relasi --}}
                    <td>{{ $product->supplier_name ?? 'N/A' }}</td>
                    <td>{{ $product->product_category_name ?? 'N/A' }}</td>
                    <td>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="text-center">
                        <form onsubmit="return false;" action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline form-delete">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-dark btn-sm">SHOW</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">EDIT</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm btn-delete">HAPUS</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Data produk kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginasi --}}
    <div class="d-flex justify-content-center">
        {!! $products->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Notifikasi sukses atau gagal
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    // Konfirmasi hapus data
    document.addEventListener('DOMContentLoaded', function () {
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
