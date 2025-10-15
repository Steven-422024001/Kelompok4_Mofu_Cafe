@extends('layouts.app')

@section('title', 'Dashboard - Mofu Cafe')

@section('content')
    {{-- Header Sambutan --}}
<div class="content-card">
    <div class="mb-4">
        <h5 class="fw-bold">Selamat Datang, Admin Mofu! 👋</h5>
        <p class="text-muted">Berikut adalah ringkasan aktivitas di Mofu Cafe hari ini.</p>
    </div>

    {{-- KPI Cards --}} 
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            {{-- Menggunakan style baru 'dashboard-kpi-card' dengan isi dari kode lama Anda --}}
            <div class="dashboard-kpi-card bg-red">
                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                <p class="title">Pendapatan Hari Ini</p>
                <h4 class="value">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="dashboard-kpi-card bg-purple">
                <div class="icon"><i class="fas fa-receipt"></i></div>
                <p class="title">Transaksi Hari Ini</p>
                <h4 class="value">{{ $jumlahTransaksiHariIni }} Transaksi</h4>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="dashboard-kpi-card bg-green">
                <div class="icon"><i class="fas fa-box-open"></i></div>
                <p class="title">Total Produk</p>
                <h4 class="value">{{ $totalProduk }} Jenis</h4>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="dashboard-kpi-card bg-blue">
                <div class="icon"><i class="fas fa-truck"></i></div>
                <p class="title">Total Supplier</p>
                <h4 class="value">{{ $totalSupplier }} Supplier</h4>
            </div>
        </div>
    </div>
</div>
    {{-- Konten Utama: Grafik dan Aktivitas Terbaru --}}
    <div class="row">
        {{-- Kolom Grafik --}}
        <div class="col-lg-8 mb-4">
            <div class="card content-card h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Pendapatan 7 Hari Terakhir</h5>
                    {{-- Bungkus canvas dengan div ini --}}
                    <div class="chart-container" style="position: relative; height:350px; max-height:350px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Aktivitas Terbaru --}}
        <div class="col-lg-4 mb-4">
            <div class="card content-card h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Aktivitas Terbaru</h5>
                    <ul class="list-group list-group-flush">
                        @forelse($aktivitasTerbaru as $aktivitas)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <p class="fw-semibold mb-0">Transaksi #{{ $aktivitas->id }}</p>
                                    <small class="text-muted">{{ count($aktivitas->details) }} item oleh {{ $aktivitas->nama_kasir }}</small>
                                </div>
                                <span class="badge bg-success-subtle text-success-emphasis rounded-pill">
                                    Rp {{ number_format($aktivitas->total_harga, 0, ',', '.') }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item px-0">Tidak ada aktivitas terbaru.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div> 
@endsection

@section('scripts')
{{-- Memuat library Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                // Data label (tanggal) dari controller
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Pendapatan',
                    // Data pendapatan dari controller
                    data: @json($chartData),
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection