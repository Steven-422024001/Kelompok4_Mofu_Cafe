<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_product extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'c2ategory_product'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Mendefinisikan relasi 'satu Kategori punya banyak Produk'.
     * Ini WAJIB ada agar withCount('products') berfungsi.
     */
    public function products()
    {
        // Ganti 'category_id' dengan nama foreign key Anda di tabel 'products'
        return $this->hasMany(Product::class, 'product_category_id');
    }
}