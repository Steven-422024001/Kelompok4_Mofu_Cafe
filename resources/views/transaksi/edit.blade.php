<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi #{{ $transaksi->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Edit Transaksi #{{ $transaksi->id }}</h1>
    <p class="text-muted">Catatan: Anda hanya dapat mengedit informasi header transaksi.</p>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_kasir" class="form-label">Nama Kasir</label>
            <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" value="{{ old('nama_kasir', $transaksi->nama_kasir) }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_pembeli" class="form-label">Nama Pembeli (Opsional)</label>
            <input type="nama" class="form-control" id="nama_pembeli" name="nama_pembeli" value="{{ old('nama_pembeli', $transaksi->nama_pembeli) }}">
        </div>
        <div class="mb-3">
        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
        <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
            <option value="Cash" @if($transaksi->metode_pembayaran == 'Cash') selected @endif>Cash</option>
            <option value="QRIS" @if($transaksi->metode_pembayaran == 'QRIS') selected @endif>QRIS</option>
            <option value="Card" @if($transaksi->metode_pembayaran == 'Card') selected @endif>Card</option>
        </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>