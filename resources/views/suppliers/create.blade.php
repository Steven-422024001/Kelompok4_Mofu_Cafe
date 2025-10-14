<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier - Mofu Cafe Admin</title>
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
        <h1 style="font-family: 'Mochiy Pop One'; color: var(--mofu-dark);">Add New Supplier</h1>
        <p class="text-muted">Register a new supplier for Mofu Cafe 📦</p>

        <div class="card border-0 shadow-sm rounded">
            <div class="card-body p-4">
                <form id="supplierForm" action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">SUPPLIER NAME</label>
                        <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" value="{{ old('supplier_name') }}" placeholder="Masukkan Nama Supplier">
                        @error('supplier_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">CONTACT NAME (PIC)</label>
                                <input type="text" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" value="{{ old('contact_name') }}" placeholder="Masukkan Nama Kontak Person">
                                @error('contact_name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PHONE</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Masukkan Nomor Telepon">
                                @error('phone')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">ADDRESS</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="4" placeholder="Masukkan Alamat Lengkap Supplier">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">NOTES</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" rows="5" placeholder="Masukkan Catatan Tambahan">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-3" style="background-color: var(--mofu-pink); border: none;">SAVE SUPPLIER</button>
                    <button type="button" onclick="resetForm()" class="btn btn-warning" style="background-color: var(--mofu-orange); border: none;">RESET</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('notes');
        function resetForm() {
            document.getElementById("supplierForm").reset();
            if (CKEDITOR.instances.notes) {
                CKEDITOR.instances.notes.setData('');
            }
        }
    </script>

</body>
</html>