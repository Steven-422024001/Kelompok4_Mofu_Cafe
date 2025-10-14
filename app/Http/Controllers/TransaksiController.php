<?php

// app/Http/Controllers/TransaksiController.php

namespace App\Http\Controllers;

use App\Models\Product; // <-- TAMBAHKAN
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar semua transaksi.
     */
    public function index()
    {
        // --- DATA BARU UNTUK DASHBOARD ---
        $pendapatanHariIni = TransaksiPenjualan::whereDate('created_at', today())->sum('total_harga');
        $jumlahTransaksiHariIni = TransaksiPenjualan::whereDate('created_at', today())->count();

        // Data utama tetap sama (daftar transaksi)
        $transaksis = TransaksiPenjualan::with('details.product')
            ->latest()
            ->paginate(8); // Kita kurangi paginasi agar pas di layout kartu

        // Kirim semua data ke view
        return view('transaksi.index', compact(
            'transaksis', 
            'pendapatanHariIni', 
            'jumlahTransaksiHariIni'
        ));
    }

    /**
     * Menampilkan form untuk membuat transaksi baru.
     */
    public function create()
    {
        $products = Product::orderBy('title')->get();
        return view('transaksi.create', compact('products'));
    }

    /**
     * Menyimpan transaksi baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kasir' => 'required|string|max:50',
            'metode_pembayaran' => 'required|in:Cash,QRIS,Card',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.jumlah' => 'required|integer|min:1',
        ]);

        // Menggunakan DB Transaction untuk memastikan semua query berhasil
        DB::transaction(function () use ($request) {
            // 1. Buat header transaksi
            $transaksi = new TransaksiPenjualan();
            $transaksi->nama_kasir = $request->nama_kasir;
            $transaksi->nama_pembeli = $request->nama_pembeli;
            $transaksi->metode_pembayaran = $request->metode_pembayaran;
            $transaksi->total_harga = 0;
            $transaksi->save();

            $grandTotal = 0;

            // 2. Loop dan simpan detail transaksi
            foreach ($request->products as $productData) {
                $product = Product::find($productData['id']);
                $subtotal = $product->price * $productData['jumlah'];

                $transaksi->details()->create([
                    'id_product' => $product->id,
                    'jumlah_pembelian' => $productData['jumlah'],
                    'subtotal_harga' => $subtotal,
                ]);

                $grandTotal += $subtotal;
            }

            // 3. Update total harga di header transaksi
            $transaksi->total_harga = $grandTotal;
            $transaksi->save();
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
    }


    /**
     * Menampilkan detail satu transaksi.
     */
    public function show(string $id)
    {
        $transaksi = TransaksiPenjualan::with('details.product')->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }


    /**
     * Menampilkan form untuk mengedit data. (Hanya untuk data header)
     */
    public function edit(string $id)
    {
        $transaksi = TransaksiPenjualan::findOrFail($id);
        // Mengedit detail item biasanya tidak dianjurkan, jadi kita hanya edit header
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Memperbarui data di database. (Hanya untuk data header)
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kasir'        => 'required|string|max:50',
            'metode_pembayaran' => 'required|in:Cash,QRIS,Card',
        ]);
        
        $transaksi = TransaksiPenjualan::findOrFail($id);
        $transaksi->nama_kasir = $request->nama_kasir;
        $transaksi->nama_pembeli = $request->nama_pembeli;
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->save();
        
        return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil diperbarui!');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(string $id)
    {
        $transaksi = TransaksiPenjualan::findOrFail($id);
        // Karena ada onDelete('cascade') di migration, detailnya akan ikut terhapus
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}