@extends('layouts.app')

@section('content1')
<div class="main-content">
    <h1 style="font-family: 'Mochiy Pop One'; color: #69554a;">Supplier Management</h1>
    <p class="text-muted">Manage all your Mofu Cafe suppliers here 🚚</p>

    <div class="card border-0 shadow-sm rounded mt-4">
        <div class="card-body">
            <a href="{{ route('suppliers.create') }}" class="btn btn-md btn-success mb-3">+ ADD SUPPLIER</a>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">SUPPLIER NAME</th>
                        <th scope="col">CONTACT NAME</th>
                        <th scope="col">PHONE</th>
                        <th scope="col">ADDRESS</th>
                        <th scope="col" style="width: 20%">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->supplier_name }}</td>
                            <td>{{ $supplier->contact_name }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td class="text-center">
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="btn-delete" class="btn btn-sm btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-danger text-center mb-0">
                                    Data Suppliers belum tersedia.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $suppliers->links() }}
        </div>
    </div>
</div>
@endsection
