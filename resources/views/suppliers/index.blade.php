<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers - Mofu Cafe Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        :root {
            --mofu-orange: #F9A870; --mofu-cream: #FDE5D0; --mofu-mint: #A8D0C6;
            --mofu-pink: #E6A5B1; --mofu-dark: #69554a; --sidebar-bg: #fff8f2ff;
            --body-bg: #f7f8fc; --header-height: 70px; --sidebar-width: 260px;
        }
        body { background-color: var(--body-bg); font-family: 'Nunito', sans-serif; }
        .top-header { height: var(--header-height); background-color: #fff; position: fixed; top: 0; left: var(--sidebar-width); right: 0; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); z-index: 1000; }
        .top-header .search-box { width: 300px; }
        .top-header .header-right { display: flex; align-items: center; gap: 20px; }
        .top-header .user-profile { display: flex; align-items: center; gap: 10px; }
        .top-header .user-profile img { width: 40px; height: 40px; border-radius: 50%; }
        .sidebar { width: var(--sidebar-width); background-color: var(--sidebar-bg); color: #a0aec0; height: 100vh; position: fixed; top: 0; left: 0; padding: 20px; display: flex; flex-direction: column; }
        .sidebar .brand { font-family: 'Mochiy Pop One', sans-serif; color: var(--mofu-pink); font-size: 1.8rem; text-align: center; padding: 10px 0; margin-bottom: 20px; text-decoration: none; }
        .sidebar .sidebar-profile { text-align: center; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #ddd; }
        .sidebar .sidebar-profile img { width: 80px; height: 80px; border-radius: 50%; margin-bottom: 10px; border: 3px solid var(--mofu-mint); }
        .sidebar .sidebar-profile .user-name { color: var(--mofu-dark); font-weight: 600; }
        .sidebar .nav-title { font-size: 0.8rem; color: #a0aeb9; text-transform: uppercase; letter-spacing: 1px; margin-top: 1.5rem; margin-bottom: 1rem; padding: 0 15px; font-weight: 600; }
        .sidebar .nav-link { display: flex; align-items: center; color: var(--mofu-dark); font-weight: 500; padding: 12px 15px; border-radius: 8px; margin-bottom: 5px; transition: all 0.2s; }
        .sidebar .nav-link i { font-size: 1.2rem; margin-right: 15px; }
        .sidebar .nav-link:hover { background-color: var(--mofu-cream); }
        .sidebar .nav-link.active { color: #fff; background-color: var(--mofu-mint); box-shadow: 0 4px 10px rgba(168, 208, 198, 0.5); }
        .main-content { margin-top: var(--header-height); margin-left: var(--sidebar-width); padding: 30px; width: calc(100% - var(--sidebar-width)); }
        .btn-success { background-color: var(--mofu-pink) !important; border-color: var(--mofu-pink) !important; }
    </style>
</head>
<body>

    <header class="top-header">
        <div class="header-left"></div>
        <div class="header-right">
            <div class="input-group search-box">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn btn-outline-secondary" type="button"><i class='bx bx-search'></i></button>
            </div>
            <a href="#" class="text-secondary fs-4"><i class='bx bxs-bell'></i></a>
            <div class="user-profile">
                <img src="https://i.pravatar.cc/40?u=neshia" alt="User Avatar">
                <span>Neshia</span>
            </div>
        </div>
    </header>

    <aside class="sidebar">
        <a href="#" class="brand">🐾 Mofu Cafe</a>
        <div class="sidebar-profile">
            <img src="https://i.pravatar.cc/80?u=neshia" alt="User Avatar">
            <div class="user-name">Neshia</div>
        </div>
        <div>
            <div class="nav-title">Main</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class='bx bxs-dashboard'></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class='bx bx-receipt'></i> Transactions
                    </a>
                </li>
            </ul>
            <div class="nav-title">Management</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class='bx bx-package'></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('suppliers.index') }}">
                        <i class='bx bxs-truck'></i> Suppliers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class='bx bx-category-alt'></i> Categories
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <main class="main-content">
        <h1 style="font-family: 'Mochiy Pop One'; color: var(--mofu-dark);">Supplier Management</h1>
        <p class="text-muted">Manage all your Mofu Cafe suppliers here 🚚</p>

        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('suppliers.create') }}" class="btn btn-md btn-success mb-3">ADD SUPPLIER</a>
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
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert messages
        @if(session('success'))
            Swal.fire({ icon: "success", title: "BERHASIL", text: "{{ session('success') }}", showConfirmButton: false, timer: 2000 });
        @elseif(session('error'))
            Swal.fire({ icon: "error", title: "GAGAL", text: "{{ session('error') }}", showConfirmButton: false, timer: 2000 });
        @endif

        // SweetAlert delete confirm
        const deleteButtons = document.querySelectorAll('#btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>