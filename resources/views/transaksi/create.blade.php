<!DOCTYPE html>
<html>
<head>
    <title>Buat Transaksi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Buat Transaksi Baru</h1>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_kasir" class="form-label">Nama Kasir</label>
            <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" value="Mofu" required>
        </div>
        <div class="mb-3">
            <label for="nama_pembeli" class="form-label">Nama Pembeli (Opsional)</label>
            <input type="nama" class="form-control" id="nama_pembeli" name="nama_pembeli">
        </div>
        <div class="mb-3">
        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
        <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
            <option value="Cash">Cash</option>
            <option value="QRIS">QRIS</option>
            <option value="Card">Card</option>
        </select>
        </div>

        <hr>
        <h3>Detail Pembelian</h3>
        <div id="product-list">
            </div>
        <button type="button" class="btn btn-secondary mt-2" id="add-product-btn">Tambah Produk</button>
        <hr>

        <h3 class="text-end">Grand Total: Rp <span id="grand-total">0</span></h3>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-warning">Batal</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addProductBtn = document.getElementById('add-product-btn');
        const productList = document.getElementById('product-list');
        const grandTotalEl = document.getElementById('grand-total');
        const products = @json($products);
        let productCounter = 0;

        addProductBtn.addEventListener('click', addProductRow);

        function addProductRow() {
            const row = document.createElement('div');
            row.classList.add('row', 'mb-2', 'product-row');
            row.innerHTML = `
                <div class="col-md-5">
                    <select name="products[${productCounter}][id]" class="form-select product-select" required>
                        <option value="">Pilih Produk</option>
                        ${products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.product_name}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="products[${productCounter}][jumlah]" class="form-control quantity-input" value="1" min="1" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control subtotal-display" readonly>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-product-btn">Hapus</button>
                </div>
            `;
            productList.appendChild(row);
            productCounter++;
        }

        productList.addEventListener('change', function (e) {
            if (e.target.classList.contains('product-select') || e.target.classList.contains('quantity-input')) {
                updateRowSubtotal(e.target.closest('.product-row'));
            }
        });

        productList.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-product-btn')) {
                e.target.closest('.product-row').remove();
                updateGrandTotal();
            }
        });
        
        function updateRowSubtotal(row) {
            const productSelect = row.querySelector('.product-select');
            const quantityInput = row.querySelector('.quantity-input');
            const subtotalDisplay = row.querySelector('.subtotal-display');

            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price) || 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const subtotal = price * quantity;

            subtotalDisplay.value = 'Rp ' + subtotal.toLocaleString('id-ID');
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let total = 0;
            document.querySelectorAll('.product-row').forEach(row => {
                const productSelect = row.querySelector('.product-select');
                const quantityInput = row.querySelector('.quantity-input');
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const price = parseFloat(selectedOption.dataset.price) || 0;
                const quantity = parseInt(quantityInput.value) || 0;
                total += price * quantity;
            });
            grandTotalEl.textContent = total.toLocaleString('id-ID');
        }
        
        // Add one product row by default
        addProductRow();
    });
</script>
</body>
</html>