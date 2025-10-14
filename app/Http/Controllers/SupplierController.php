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
        // Ambil semua data supplier dari database (terbaru di atas)
        $suppliers = Supplier::latest()->paginate(10);

        // Tampilkan ke halaman layout utama dan arahkan ke bagian supplier
        return view('layouts.app', [
            'suppliers' => $suppliers,
        ]);
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
        $request->validate([
            'supplier_name' => 'required|string|min:3',
            'contact_name'  => 'nullable|string|min:3',
            'phone'         => 'required|string|min:10',
            'address'       => 'required|string|min:10',
            'notes'         => 'nullable|string',
        ]);

        Supplier::create([
            'supplier_name' => $request->supplier_name,
            'contact_name'  => $request->contact_name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'notes'         => $request->notes,
        ]);

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
        $supplier = Supplier::findOrFail($id);
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
        $supplier = Supplier::findOrFail($id);
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
        $request->validate([
            'supplier_name' => 'required|string|min:3',
            'contact_name'  => 'nullable|string|min:3',
            'phone'         => 'required|string|min:10',
            'address'       => 'required|string|min:10',
            'notes'         => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'supplier_name' => $request->supplier_name,
            'contact_name'  => $request->contact_name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'notes'         => $request->notes,
        ]);

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
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')
                         ->with('success', 'Data Supplier Berhasil Dihapus!');
    }
}
