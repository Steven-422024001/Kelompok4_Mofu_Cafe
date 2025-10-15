@extends('layouts.app')

@section('title', 'Dashboard Transaksi - Mofu Cafe')

@section('content')
<div class="content-card">

    {{-- Header dan Tombol Aksi --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h5 fw-bold mb-0">Dashboard Transaksi</h1>
        <a href="{{ route('transaksi.create') }}" class="btn btn-add-new">
            <i class="fas fa-plus"></i> Add Transaction
        </a>
    </div>

    {{-- Bagian KPI (Key Performance Indicator) Cards --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card kpi-card shadow-sm border-0">
                <div class="card-body">
                    <div class="icon-circle bg-success text-white">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <div>
                        <h6 class="card-subtitle mb-1 text-muted">Pendapatan Hari Ini</h6>
                        <h4 class="card-title mb-0">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card kpi-card shadow-sm border-0">
                <div class="card-body">
                    <div class="icon-circle bg-primary text-white">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div>
                        <h6 class="card-subtitle mb-1 text-muted">Transaksi Hari Ini</h6>
                        <h4 class="card-title mb-0">{{ $jumlahTransaksiHariIni }} Transaksi</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian Daftar Transaksi (Card-based) --}}
    <h2 class="h5 fw-bold mb-3">Riwayat Transaksi Terbaru</h2>
    <div class="row">
        @forelse ($transaksis as $trx)
        <div class="col-lg-6 mb-4">
            <div class="card transaction-card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Transaksi #{{ $trx->id }}</span>
                    <span class="text-muted small">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y, H:i') }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1">
                                <i class="bi bi-person-fill me-2 text-muted"></i>
                                Kasir: <span class="fw-semibold">{{ $trx->nama_kasir }}</span>
                            </p>
                            <p class="mb-0">
                                <i class="bi bi-credit-card-fill me-2 text-muted"></i>
                                Bayar via: <span class="badge bg-info text-dark-emphasis">{{ $trx->metode_pembayaran }}</span>
                            </p>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-1 text-success fw-bold">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</h5>
                            <small class="text-muted">{{ count($trx->details) }} {{ Str::plural('item', count($trx->details)) }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-end">
                    {{-- 1. Menghapus onsubmit bawaan dan menambahkan class 'form-delete' --}}
                    <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" class="d-inline form-delete">
                        <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-sm btn-outline-dark">Detail</a>
                        <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card text-center py-5 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Belum Ada Transaksi</h5>
                    <p class="card-text text-muted">Silakan buat transaksi baru untuk memulai.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Link Paginasi --}}
    <div class="d-flex justify-content-center mt-4">
        {!! $transaksis->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
{{-- 2. Menambahkan script SweetAlert yang Anda berikan --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Notifikasi dari session (setelah create/update/delete)
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