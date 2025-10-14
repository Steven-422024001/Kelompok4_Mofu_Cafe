<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Transaksi - Mofu Cafe</title>
    {{-- Menggunakan Bootstrap 5 dan Bootstrap Icons dari CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .kpi-card .card-body {
            display: flex;
            align-items: center;
        }
        .kpi-card .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
        }
        .transaction-card {
            transition: transform 0.2s ease-in-out;
        }
        .transaction-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
<div class="container py-4">

    {{-- Header dan Tombol Aksi --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Dashboard Transaksi</h1>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle-fill me-2"></i>Buat Transaksi Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Bagian KPI (Key Performance Indicator) Cards --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card kpi-card shadow-sm">
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
            <div class="card kpi-card shadow-sm">
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
    <h2 class="h4 mb-3">Riwayat Transaksi Terbaru</h2>
    <div class="row">
        @forelse ($transaksis as $trx)
        <div class="col-lg-6 mb-4">
            <div class="card transaction-card shadow-sm">
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
                                Bayar via: <span class="badge bg-info">{{ $trx->metode_pembayaran }}</span>
                            </p>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-1 text-success">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</h5>
                            <small class="text-muted">{{ count($trx->details) }} {{ Str::plural('item', count($trx->details)) }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-end">
                    <form onsubmit="return confirm('Apakah Anda Yakin ingin menghapus transaksi ini?');" action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" class="d-inline">
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
            <div class="card text-center py-5">
                <div class="card-body">
                    <h5 class="card-title">Belum Ada Transaksi</h5>
                    <p class="card-text">Silakan buat transaksi baru untuk memulai.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Link Paginasi --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $transaksis->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>