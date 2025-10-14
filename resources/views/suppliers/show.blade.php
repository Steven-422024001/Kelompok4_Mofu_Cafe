<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Supplier - Mofu Cafe Admin</title>
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
        .detail-card .card-header { background-color: var(--mofu-cream); }
        .detail-card h4 { font-family: 'Mochiy Pop One', sans-serif; color: var(--mofu-dark); }
        .detail-label { font-size: 0.9rem; font-weight: 700; color: #a0aec0; text-transform: uppercase; margin-bottom: 0.25rem; }
        .detail-value { font-size: 1.1rem; color: var(--mofu-dark); }
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 style="font-family: 'Mochiy Pop One'; color: var(--mofu-dark);">Supplier Details</h1>
            <div>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                    <i class='bx bx-arrow-back'></i> Back to List
                </a>
                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn" style="background-color: var(--mofu-orange); color: white;">
                    <i class='bx bxs-pencil'></i> Edit Supplier
                </a>
            </div>
        </div>
        
        <div class="card shadow-sm rounded-3 detail-card">
            <div class="card-header py-3">
                <h4>{{ $supplier->supplier_name }}</h4>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <p class="detail-label">Contact Name (PIC)</p>
                            <h5 class="detail-value">{{ $supplier->contact_name ?: '-' }}</h5>
                        </div>
                        <div class="mb-4">
                            <p class="detail-label">Phone</p>
                            <h5 class="detail-value">{{ $supplier->phone }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <p class="detail-label">Address</p>
                            <h5 class="detail-value">{{ $supplier->address ?: '-' }}</h5>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div>
                    <p class="detail-label">Notes</p>
                    <div class="detail-value bg-light p-3 rounded">
                        {!! $supplier->notes ?: '<em>No notes provided.</em>' !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>