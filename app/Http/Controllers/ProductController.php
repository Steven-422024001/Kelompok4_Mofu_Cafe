<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use App\Models\Category_product;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get all products
        $product = new Product;
        $products = $product->get_product()->latest()->paginate(10);

        //render view with products
        return view('products.index', compact('products'));
    }

    // ------------------------------------------------------------------
    // CRUD
    // ------------------------------------------------------------------

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        // Mengambil semua kategori
        $categoryModel = new Category_product;
        $data['categories'] = $categoryModel->get_category_product()->get(); 

        // Mengambil semua supplier
        $supplierModel = new Supplier;
        $data['suppliers'] = $supplierModel->get_supplier()->get();

        return view('products.create', compact('data')); 
    }

    /**
     * store
     * digunakan untuk insert data ke dalam database dan melakukan upload gambar
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data input dari form
        $validatedData = $request->validate([
            'image'               => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title'               => 'required|min:5',
            'product_category_id' => 'required|integer', 
            'supplier_id'         => 'required|integer',
            'description'         => 'required|min:10', 
            'price'               => 'required|numeric', 
            'stock'               => 'required|numeric', 
        ]);

        // Handle upload file gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $store_image = $image->store('images', 'public');

            $product = new Product;
            $insertProduct = $product->storeProduct($request, $image);
            
            if ($insertProduct) {
                return redirect()->route('products.index')
                                 ->with('success', 'Data Berhasil Disimpan!');
            }
            
            return redirect()->route('products.index')
                             ->with('error', 'Gagal menyimpan data produk ke database. Silakan coba lagi.');
        }
        
        // Jika gagal upload
        return redirect()->route('products.index')
                         ->with('error', 'Failed to upload image (request).');
    }

    /**
     * show
     * 
     * @param string $id
     * @return View
     */
    public function show(string $id): View
    {
        $product_model = new Product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        return view('products.show', compact('product'));
    }

    /**
     * edit
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $productModel = new Product;
        $data['product'] = $productModel->get_product()->where("products.id", $id)->firstOrFail();

        $categoryModel = new Category_product;
        $data['categories'] = $categoryModel->get_category_product()->get();

        $supplierModel = new Supplier; 
        $data['suppliers'] = $supplierModel->get_supplier()->get();

        return view('products.edit', compact('data'));
    }

    /**
     * update
     *
     * @param Request $request
     * @param mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'image'         => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        $product_model = new Product;

        // Jika upload gambar baru
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $store_image = $image->store('images', 'public'); 
            $name_image = $image->hashName();

            $data_product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

            // Hapus gambar lama
            Storage::disk('public')->delete('images/' . $data_product->image);

            // Update dengan gambar baru
            $update_product = $product_model->updateProduct($id, $request, $name_image);
        } else {
            $request_data = [
                'title'                 => $request->title,
                'product_category_id'   => $request->product_category_id,
                'supplier_id'           => $request->supplier_id,
                'description'           => $request->description,
                'price'                 => $request->price,
                'stock'                 => $request->stock
            ];
            $update_product = $product_model->updateProduct($id, $request_data);
        }

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     * 
     * @param mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $product_model = new Product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        // Hapus gambar lama
        Storage::disk('public')->delete('images/' . $product->image);

        // Hapus produk dari database
        $product->delete();

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
