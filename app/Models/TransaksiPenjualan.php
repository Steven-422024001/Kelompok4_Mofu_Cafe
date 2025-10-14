<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    /**
     * Mendefinisikan nama tabel secara eksplisit
     * (Sebenarnya tidak perlu jika nama model sudah sesuai konvensi)
     */
    protected $table = 'transaksi_penjualan';

    /**
     * Relasi "one-to-many": Satu Transaksi memiliki BANYAK Detail Transaksi.
     */
    public function details(): HasMany
    {
        // Parameter kedua adalah nama foreign key di tabel detail_transaksi_penjualan
        return $this->hasMany(DetailTransaksiPenjualan::class, 'id_transaksi_penjualan');
    }
}