@extends('layouts.app')
@section('title', 'Edit Transaksi #' . $transaksi->id)
@section('page-title', 'Edit Transaksi')

@push('styles')
<style>
    .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 1rem; max-height: 60vh; overflow-y: auto; padding-right: 10px; }
    .product-card { cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; border: 1px solid var(--mofu-light-border); }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); }
    .product-card img { height: 100px; object-fit: cover; }
    .bill-item { border-bottom: 1px solid var(--mofu-light-border); }
    .bill-item:last-child { border-bottom: none; }
    .bill-details { background-color: var(--mofu-blue-bg); border-radius: 0.75rem; }
    .nav-pills .nav-link { color: var(--mofu-blue-text); font-weight: 600; }
    .nav-pills .nav-link.active { background-color: var(--mofu-sidebar-bg); color: white; }
</style>
@endpush

@section('content')
<form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" id="transaction-form">
    @csrf
    @method('PUT')
    <div class="row">
        {{-- Kolom Kiri: Pilihan Menu --}}
        <div class="col-lg-7 mb-4">
            <div class="content-card h-100">
                <h5 class="fw-bold">Pilih Menu</h5>
                <div class="nav nav-pills mb-3" id="category-filter">
                    <button class="nav-link active" type="button" data-category-id="all">Semua Menu</button>
                    @foreach($categories as $category)
                        <button class="nav-link" type="button" data-category-id="{{ $category->id }}">{{ $category->name }}</button>
                    @endforeach
                </div>
                <div class="product-grid">
                    @forelse($products as $product)
                        <div class="card product-card" data-category-id="{{ $product->product_category_id }}" onclick="addToBill({{ $product->id }}, '{{ $product->title }}', {{ $product->price }}, '{{ asset('storage/images/' . $product->image) }}')">
                            <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top">
                            <div class="card-body p-2">
                                <h6 class="card-title small fw-bold mb-1">{{ $product->title }}</h6>
                                <p class="card-text small text-muted mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada produk yang tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Detail Tagihan --}}
        <div class="col-lg-5 mb-4">
            <div class="content-card h-100 d-flex flex-column">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                        <div>
                            <h5 class="fw-bold mb-1">Detail tagihan</h5>
                        </div>
                        <div>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-app-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                <div class="mb-3">
                    <label for="nama_kasir" class="form-label fw-semibold small">NAMA KASIR</label>
                    <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" value="{{ old('nama_kasir', $transaksi->nama_kasir) }}" required>
                </div>
                <div class="mb-3">
                    <label for="nama_pembeli" class="form-label fw-semibold small">NAMA PEMBELI (OPSIONAL)</label>
                    <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" value="{{ old('nama_pembeli', $transaksi->nama_pembeli) }}">
                </div>
                <hr>
                
                <div id="bill-items" class="flex-grow-1" style="overflow-y: auto; max-height: 30vh;">
                    {{-- Item akan di-render oleh JavaScript --}}
                </div>

                <div class="bill-details p-3 mt-auto">
                    <div class="d-flex justify-content-between fw-bold mb-3">
                        <span>Total Harga:</span>
                        <span id="grand-total">Rp 0</span>
                    </div>
                    <div class="mb-2">
                        <label for="metode_pembayaran" class="form-label fw-semibold small">METODE PEMBAYARAN</label>
                        <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="Cash" {{ $transaksi->metode_pembayaran == 'Cash' ? 'selected' : '' }}>Tunai (Cash)</option>
                            <option value="QRIS" {{ $transaksi->metode_pembayaran == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            <option value="Card" {{ $transaksi->metode_pembayaran == 'Card' ? 'selected' : '' }}>Kartu (Card)</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold">PERBARUI TRANSAKSI</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let bill = {};
        const billItemsContainer = document.getElementById('bill-items');
        const grandTotalEl = document.getElementById('grand-total');

        @foreach($transaksi->details as $detail)
            bill[{{ $detail->product->id }}] = {
                id: {{ $detail->product->id }},
                title: '{{ addslashes($detail->product->title) }}',
                price: {{ $detail->product->price }},
                image: '{{ asset('storage/images/' . $detail->product->image) }}',
                jumlah: {{ $detail->jumlah_pembelian }}
            };
        @endforeach
        
        renderBill();
        
        window.addToBill = function(id, title, price, image) {
            if (bill[id]) {
                bill[id].jumlah++;
            } else {
                bill[id] = { id, title, price, image, jumlah: 1 };
            }
            renderBill();
        }
        window.updateQuantity = function(id, amount) {
            if (bill[id]) {
                bill[id].jumlah += amount;
                if (bill[id].jumlah <= 0) {
                    delete bill[id];
                }
            }
            renderBill();
        }
        function renderBill() {
            billItemsContainer.innerHTML = '';
            let grandTotal = 0;
            let formInputs = '';
            const productIds = Object.keys(bill);
            if (productIds.length === 0) {
                billItemsContainer.innerHTML = '<p class="text-center text-muted mt-5">Belum ada item dipilih.</p>';
            } else {
                productIds.forEach((id, index) => {
                    const item = bill[id];
                    grandTotal += item.price * item.jumlah;
                    const itemHtml = `<div class="d-flex align-items-center py-2 bill-item"><img src="${item.image}" width="50" height="50" class="rounded me-3" style="object-fit: cover;"><div class="flex-grow-1"><p class="fw-bold small mb-0">${item.title}</p><small class="text-muted">Rp ${item.price.toLocaleString('id-ID')}</small></div><div class="d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${id}, -1)">-</button><span class="mx-2 fw-bold">${item.jumlah}</span><button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${id}, 1)">+</button></div></div>`;
                    billItemsContainer.innerHTML += itemHtml;
                    formInputs += `<input type="hidden" name="products[${index}][id]" value="${item.id}"><input type="hidden" name="products[${index}][jumlah]" value="${item.jumlah}">`;
                });
                document.querySelectorAll('input[name*="products"]').forEach(el => el.remove());
                billItemsContainer.insertAdjacentHTML('afterend', formInputs);
            }
            grandTotalEl.textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
        }

        const filterButtons = document.querySelectorAll('#category-filter .nav-link');
        const productCards = document.querySelectorAll('.product-card');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                const categoryId = this.dataset.categoryId;
                productCards.forEach(card => {
                    if (categoryId === 'all' || card.dataset.categoryId === categoryId) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection