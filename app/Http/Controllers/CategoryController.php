<?php

namespace App\Http\Controllers;

use App\Models\Category_product;
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index() : View
    {
        //get all categories
        $category = new Category_product;
        $categories = $category->get_category_product()->orderBy('id', 'asc')->paginate(10);

        //render view with categories
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
    public function store(Request $request): RedirectResponse
    {
        // Validasi data input
        $request->validate([
            'name'        => 'required|min:3',
            'description' => 'nullable|string'
        ]);

        // Simpan ke database
        $category = new Category_product;
        $insertCategory = $category->storeCategory($request);

        if ($insertCategory) {
            return redirect()->route('category.index')
                             ->with('success', 'Kategori berhasil ditambahkan!');
        }

        return redirect()->route('category.index')
                         ->with('error', 'Gagal menyimpan kategori.');
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
    $deleted = \App\Models\Category_product::where('id', $id)->delete();

    if ($deleted) {
        return redirect()->route('category.index')->with('success', 'Data kategori berhasil dihapus!');
    } else {
        return redirect()->route('category.index')->with('error', 'Gagal menghapus data!');
    }
}

}