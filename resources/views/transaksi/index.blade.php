@extends('layouts.app')

@section('title', 'Manajemen Transaksi - Mofu Cafe')

@section('page-title', 'Manajemen Transaksi')

@push('styles')
<style>
    /*
    ==============================================
    STYLING KHUSUS HALAMAN INDEKS TRANSAKSI
    ==============================================
    */
    .transaction-card {
        background: var(--card-bg);
        border: 2px solid var(--mofu-light-border);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: transform 0.2s ease-in-out;
    }
    .transaction-card:hover {
        transform: translateY(-5px);
    }
    .transaction-card .card-header {
        background-color: white;
    }
    .transaction-card .card-footer {
        background-color: #f8f9fa; /* bg-light */
    }
    .transaction-empty-card {
        text-align: center;
        padding-top: 3rem;
        padding-bottom: 3rem;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .badge.bg-info {
        background-color: #0dcaf0 !important;
        color: #000 !important;
    }
</style>
@endpush

@section('content')
<div class="content-card">
    <div class="mb-2">
        <h1 class="h5 fw-bold mb-0">Data Hari Ini</h1>
        <p class="text-muted">Berikut adalah ringkasan Transaksi hari ini.</p>
    </div>

    {{-- KPI Cards --}}
    <div class="row mb-2">
        <div class="col-md-6 mb-3">
            <div class="dashboard-kpi-card bg-red">
                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                <p class="title">Pendapatan Hari Ini</p>
                <h4 class="value">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="dashboard-kpi-card bg-purple">
                <div class="icon"><i class="fas fa-receipt"></i></div>
                <p class="title">Transaksi Hari Ini</p>
                <h4 class="value">{{ $jumlahTransaksiHariIni }} Transaksi</h4>
            </div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Riwayat Transaksi</h5>
            <p class="text-muted mb-0">Lihat dan kelola semua riwayat transaksi penjualan di sini 🧾</p>
        </div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-app-primary">
            <i class="fas fa-plus me-1"></i> Tambah Transaksi
        </a>
    </div>

    <div class="row">
        @forelse ($transaksis as $trx)
        <div class="col-lg-6 mb-4">
            <div class="card transaction-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Transaksi #{{ $trx->id }}</span>
                    <span class="text-muted small">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y, H:i') }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1">
                                <i class="fas fa-user me-2 text-muted"></i>
                                Kasir: <span class="fw-semibold">{{ $trx->nama_kasir }}</span>
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-credit-card me-2 text-muted"></i>
                                Bayar via: <span class="badge bg-info">{{ $trx->metode_pembayaran }}</span>
                            </p>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-1 text-success fw-bold">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</h5>
                            <small class="text-muted">{{ count($trx->details) }} {{ Str::plural('item', count($trx->details)) }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="action-buttons justify-content-end">
                       <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-dark" title="Show"><i class="fas fa-eye"></i></a>
                       <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                       <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" class="form-delete">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger btn-delete" title="Delete"><i class="fas fa-trash-alt"></i></button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card transaction-empty-card">
                <div class="card-body">
                    <h5 class="card-title">Belum Ada Transaksi</h5>
                    <p class="card-text text-muted">Silakan buat transaksi baru untuk memulai.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $transaksis->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: "success", title: "BERHASIL", text: "{{ session('success') }}",
                showConfirmButton: false, timer: 2000
            });
        @endif
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning', showCancelButton: true,
                    confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) { this.submit(); }
                });
            });
        });
    });
</script>
@endsection