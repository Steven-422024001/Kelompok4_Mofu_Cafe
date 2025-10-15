<?php

namespace App\Http\Controllers;

use App\Models\Category_product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index(): View
    {
        $categories = Category_product::withCount('products')->latest()->paginate(8); 
        
        // Mengirim data ke view
        return view('category.index', compact('categories'));
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
        return view('category.create');
    }

    /**
    * store
    * digunakan untuk insert data ke dalam database
    *
    * @param  Request $request
    * @return RedirectResponse
    */
    public function store(Request $request)
    {
        // 1. Validate the incoming data from the form
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            // Add other validation rules for your fields
        ]);

        // 2. Use the Model's built-in create() method to store the data
        $category = Category_product::create($validatedData);

        // 3. Redirect the user back with a success message
        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    /**
    * edit
    *
    * @param mixed $id
    * @return View
    */
    public function edit(string $id): View
    {
        $categoryModel = new Category_product;
        $category = $categoryModel->get_category_product()->where('id', $id)->firstOrFail();

        return view('category.edit', compact('category'));
    }


    /**
    * update
    *
    * @param mixed $request
    * @param mixed $id
    * @return RedirectResponse
    */
    public function update(Request $request, $id): RedirectResponse
    {

        //validasi form
        $request->validate([
            'name'        => 'required|min:3',
            'description' => 'nullable|string'
        ]);

        $categoryModel = new Category_product;
        $updateCategory = $categoryModel->updateCategory($id, $request);

        return redirect()->route('category.index')->with(['success' => 'Data kategori berhasil diubah!']);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return View
     */
    public function show($id): View
    {
        $categoryModel = new Category_product;
        $category = $categoryModel->get_category_product()->where('id', $id)->firstOrFail();

        return view('category.show', compact('category'));
    }

    /**
     * destroy
     * 
     * @param mixed $id
     * @return RedirectResponse
     */
   public function destroy($id): RedirectResponse
{
    $deleted = Category_product::where('id', $id)->delete();

    if ($deleted) {
        return redirect()->route('category.index')->with('success', 'Data kategori berhasil dihapus!');
    } else {
        return redirect()->route('category.index')->with('error', 'Gagal menghapus data!');
    }
}

}