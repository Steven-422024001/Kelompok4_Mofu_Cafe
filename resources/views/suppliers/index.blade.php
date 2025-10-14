@extends('layouts.app')

@section('title', 'Daftar Supplier - Mofu Cafe')

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Supplier Management</h5>
            <p class="text-muted mb-0">Manage all your Mofu Cafe suppliers here 🚚</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn btn-success">ADD SUPPLIER</a>
    </div>

    {{-- Tabel Data Supplier --}}
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">SUPPLIER NAME</th>
                <th scope="col">CONTACT NAME</th>
                <th scope="col">PHONE</th>
                <th scope="col">ADDRESS</th>
                <th scope="col" style="width: 20%">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->contact_name ?? '-' }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address ?? '-' }}</td>
                    <td class="text-center">
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline form-delete">
                            <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete">HAPUS</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="alert alert-secondary text-center mb-0">
                            Data Suppliers belum tersedia.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Link Paginasi dengan style Bootstrap 5 --}}
    <div class="d-flex justify-content-center">
        {!! $suppliers->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Notifikasi dari session (setelah create/update)
        @if(session('success'))
            Swal.fire({
                icon: "success", title: "BERHASIL", text: "{{ session('success') }}",
                showConfirmButton: false, timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error", title: "GAGAL", text: "{{ session('error') }}",
                showConfirmButton: false, timer: 2000
            });
        @endif

        // Konfirmasi hapus untuk setiap form dengan class '.form-delete'
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