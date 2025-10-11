<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_product extends Model
{
    protected $table = 'category_product';
    protected $fillable = ['name', 'description'];

    public function get_category_product()
    {
        return $this->select('*');
    }

    public function storeCategory($request)
    {
        return $this->create([
            'name'        => $request->name,
            'description' => $request->description
        ]);
    }

    /**
     * Update data kategori
     */
    public function updateCategory($id, $request)
    {
        $category = $this->findOrFail($id);

        return $category->update([
            'name'        => $request->name,
            'description' => $request->description
        ]);
    }
}
