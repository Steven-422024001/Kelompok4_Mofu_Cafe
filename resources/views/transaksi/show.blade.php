<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi #{{ $transaksi->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Detail Transaksi #{{ $transaksi->id }}</h3>
        </div>
        <div class="card-body">
            <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d F Y, H:i:s') }}</p>
            <p><strong>Nama Kasir:</strong> {{ $transaksi->nama_kasir }}</p>
            <p><strong>Nama Pembeli:</strong> {{ $transaksi->nama_pembeli ?? '-' }}</p>
            <hr>
            <h4>Item yang Dibeli:</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->details as $detail)
                    <tr>
                        <td>{{ $detail->product->product_name ?? 'N/A' }}</td>
                        <td>{{ $detail->jumlah_pembelian }}</td>
                        <td>Rp {{ number_format($detail->product->price ?? 0, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal_harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <h4 class="text-end">Grand Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</h4>
        </div>
        <div class="card-footer">
            <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kembali ke Daftar Transaksi</a>
        </div>
    </div>
</div>
</body>
</html>