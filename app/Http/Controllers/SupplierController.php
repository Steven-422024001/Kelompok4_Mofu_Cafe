<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SupplierController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get all suppliers
        $suppliers = Supplier::latest()->paginate(10);

        //render view with suppliers
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('suppliers.create');
    }

    /**
     * store
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi data input dari form
        $request->validate([
            'supplier_name' => 'required|string|min:3',
            'contact_name'  => 'nullable|string|min:3',
            'phone'         => 'required|string|min:10',
            'address'       => 'required|string|min:10',
            'notes'         => 'nullable|string',
        ]);

        // 2. Insert data ke database
        Supplier::create([
            'supplier_name' => $request->supplier_name,
            'contact_name'  => $request->contact_name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'notes'         => $request->notes,
        ]);

        // 3. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('suppliers.index')
                         ->with('success', 'Data Supplier Berhasil Disimpan!');
    }

    /**
     * show
     *
     * @param  string $id
     * @return View
     */
    public function show(string $id): View
    {
        //get supplier by ID
        $supplier = Supplier::findOrFail($id);

        //render view with supplier
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * edit
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get supplier by ID
        $supplier = Supplier::findOrFail($id);

        //render view with supplier
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // 1. Validasi data input dari form
        $request->validate([
            'supplier_name' => 'required|string|min:3',
            'contact_name'   => 'nullable|string|min:3',
            'phone'       => 'required|string|min:10',
            'address'        => 'required|string|min:10',
            'notes'    => 'nullable|string',
        ]);

        // 2. Dapatkan data supplier berdasarkan ID
        $supplier = Supplier::findOrFail($id);

        // 3. Update data di database
        $supplier->update([
            'supplier_name' => $request->supplier_name,
            'contact_name'   => $request->contact_name,
            'phone'       => $request->phone,
            'address'        => $request->address,
            'notes'    => $request->notes,
        ]);

        // 4. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('suppliers.index')
                         ->with('success', 'Data Supplier Berhasil Diubah!');
    }

    /**
     * destroy
     *
     * @param  string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        // 1. Dapatkan data supplier berdasarkan ID
        $supplier = Supplier::findOrFail($id);

        // 2. Hapus data supplier
        $supplier->delete();

        // 3. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('suppliers.index')
                         ->with('success', 'Data Supplier Berhasil Dihapus!');
    }
}