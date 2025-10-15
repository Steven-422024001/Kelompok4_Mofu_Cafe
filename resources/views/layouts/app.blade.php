<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mofu Cafe Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Palet Warna Mofusand yang Diperbarui */
            --mofu-blue-bg: #e0f2f7; 
            --mofu-sidebar-bg: #7096b6;
            --mofu-dark-text: #303f56; 
            --mofu-yellow-accent: #ffb347; 
            --mofu-light-border: #d0e6ed;
            --mofu-shadow-soft: rgba(0, 0, 0, 0.04);
            --card-bg: #ffffff;

            --status-red: #e27b7bff;
            --status-purple: #b66adaff;
            --status-green: #69d194ff;
            --status-blue: #65a8d5ff;
        }

        body {
            margin: 0;
            background-color: var(--mofu-blue-bg);
            font-family: 'Quicksand', sans-serif;
            font-weight: 500;
        }
        .page-wrapper {
            display: flex;
        }

        /* ===== SIDEBAR DENGAN WARNA BARU ===== */
        .sidebar {
            width: 260px;
            background-color: var(--mofu-sidebar-bg); /* Latar belakang sidebar diubah */
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }
        .sidebar .brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ffffff; /* Teks brand menjadi putih */
            text-align: center;
            margin-bottom: 2rem;
            text-decoration: none;
        }
        .sidebar .nav-title {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6); /* Judul navigasi menjadi putih transparan */
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.85); /* Teks link menjadi putih lembut */
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
            font-weight: 600;
        }
        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        .sidebar-nav .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.15); 
            color: #ffffff; 
        }
        .sidebar-nav .nav-link.active {
            background-color: rgba(0, 0, 0, 0.15); 
            color: #ffffff; 
        }
        .sidebar .sidebar-footer {
            margin-top: auto;
        }
        
        /* ===== PAGE CONTENT ===== */
        .page-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 1.5rem;
        }
        .content-header {
            background-color: var(--card-bg);
            border: 1px solid var(--mofu-light-border);
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px 0 var(--mofu-shadow-soft);
            margin-bottom: 1.5rem;
        }
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .content-card {
            background: var(--card-bg);
            border: 1px solid var(--mofu-light-border);
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 var(--mofu-shadow-soft);
            color: var(--mofu-dark-text);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /*
        ==============================================
        CUSTOM BUTTON STYLE: ADD NEW
        ==============================================
        */
        .btn-add-new {
            background-color: #ffffff;
            color: var(--mofu-yellow-accent);
            border: 1px solid var(--mofu-yellow-accent); 
            border-radius: 50px; 
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            
            /* Untuk merapikan ikon dan teks */
            display: inline-flex;
            align-items: center;
            gap: 0.5rem; 
            transition: all 0.2s ease-in-out; 
        }

        /* Efek saat cursor mouse di atas tombol */
        .btn-add-new:hover {
            background-color: var(--mofu-yellow-accent);
            border-color: var(--mofu-yellow-accent);
            color: var(--mofu-dark-text);
        }

        /* ===== GAYA BARU UNTUK KPI CARDS DASHBOARD ===== */
        .dashboard-kpi-card {
            border-radius: 1rem;
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
        }
        .dashboard-kpi-card .icon {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            font-size: 1.5rem;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.15);
        }
        .dashboard-kpi-card .title {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .dashboard-kpi-card .value {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem; /* Disesuaikan agar pas */
        }
        .dashboard-kpi-card .details {
            font-size: 0.8rem;
            opacity: 0.7;
            letter-spacing: 1px;
        }


        .dashboard-kpi-card.bg-red { background-color: var(--status-red); }
        .dashboard-kpi-card.bg-purple { background-color: var(--status-purple); }
        .dashboard-kpi-card.bg-green { background-color: var(--status-green); }
        .dashboard-kpi-card.bg-blue { background-color: var(--status-blue); }
                
        /* Untuk tabel (jika ada) */
        .table thead {
            background-color: var(--mofu-blue-text); /* Header tabel */
            color: white;
        }
        .table tbody tr:hover {
            background-color: var(--mofu-blue-bg); /* Hover baris tabel */
        }

        /* Pagination */
        .pagination .page-item .page-link {
            color: var(--mofu-blue-text);
            border-color: var(--mofu-light-border);
        }
        .pagination .page-item.active .page-link {
            background-color: var(--mofu-blue-text);
            border-color: var(--mofu-blue-text);
            color: white;
        }
        .pagination .page-item .page-link:hover {
            background-color: var(--mofu-blue-bg);
            border-color: var(--mofu-blue-text);
            color: var(--mofu-dark-text);
        }
    
        /* ===== STYLE TOMBOL UTAMA APLIKASI ===== */
        .btn-primary { background-color: var(--mofu-sidebar-bg); border: none; }
        
        .btn-app-primary, .btn-app-secondary {
            font-weight: 600;
            border-radius: 50px;
            border: 2px solid transparent;
            transition: all 0.2s ease;
            padding: 0.5rem 1rem;
        }

        /* Tombol Aksi Utama (Save, Update, Edit) */
        .btn-app-primary {
            border-color: var(--mofu-yellow-accent);
            color: var(--mofu-yellow-accent);
        }
        .btn-app-primary:hover {
            background-color: var(--mofu-yellow-accent);
            border-color: var(--mofu-yellow-accent);
            color: var(--mofu-dark-text);
        }

        /* Tombol Aksi Sekunder (Back, Cancel) */
        .btn-app-secondary {
            background-color: transparent;
            border-color: var(--mofu-sidebar-bg);
            color: var(--mofu-sidebar-bg);
        }
        .btn-app-secondary:hover {
            background-color: var(--mofu-sidebar-bg);
            border-color: var(--mofu-sidebar-bg);
            color: var(--mofu-dark-text);
        }

        /* ===== STYLE UNTUK ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .action-buttons a, .action-buttons button {
            width: 32px; height: 32px; display: inline-flex;
            align-items: center; justify-content: center;
            border-radius: 0.375rem;
            font-size: 0.8rem;
        }
        .action-buttons .btn-dark { background-color: #e2e8f0; color: #4a5568; border: none; }
        .action-buttons .btn-dark:hover { background-color: #cbd5e1; }
        .action-buttons .btn-primary { background-color: #e0e7ff; color: #4338ca; border: none; }
        .action-buttons .btn-primary:hover { background-color: #c7d2fe; }
        .action-buttons .btn-danger { background-color: #fee2e2; color: #b91c1c; border: none; }
        .action-buttons .btn-danger:hover { background-color: #fecaca; }

    </style>
    @stack('styles')
</head>
<body>

<div class="page-wrapper">
    @include('layouts.partials.sidebar')

    <div class="page-content">
        @include('layouts.partials.content-header')

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</body>
</html>

