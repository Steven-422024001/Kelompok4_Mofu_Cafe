<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mofu Cafe Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Di sini kita akan menaruh semua CSS --}}
    <style>
        :root {
            /* Palet Warna Mofusand */
            --mofu-blue-bg: #e0f2f7; 
            --mofu-blue-text: #5a7d9a; 
            --mofu-dark-text: #303f56; 
            --mofu-text-muted: #6c757d;
            --mofu-yellow-accent: #ffb347; 
            --mofu-light-border: #d0e6ed; 
            --mofu-shadow-light: rgba(88, 126, 161, 0.1); 
            --mofu-shadow-soft: rgba(0, 0, 0, 0.04); 
        }

        body {
            margin: 0;
            background-color: var(--mofu-blue-bg); 
            font-family: 'Quicksand', sans-serif;
            font-weight: 500;
            color: var(--mofu-dark-text); 
        }

        .header-nav {
            background-color: #ffffff;
            border: 1px solid var(--mofu-light-border);
            border-radius: 40px;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px -2px var(--mofu-shadow-light); 
            margin-top: 20px;
        }

        .header-nav .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--mofu-dark-text) !important; 
        }

        .nav-links {
            display: flex;
            gap: 8px;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--mofu-blue-text); 
            font-weight: 500;
            transition: color 0.2s ease, background-color 0.2s ease; 
            position: relative;
            padding-bottom: 10px;
        }

        .nav-links a:hover {
            color: var(--mofu-dark-text);
            background-color: var(--mofu-blue-bg); 
        }

        .nav-links a.active {
            color: var(--mofu-dark-text) !important; 
            font-weight: 600;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 3px;
            background-color: var(--mofu-yellow-accent);
            border-radius: 2px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--mofu-light-border); /* Border pada foto profil */
        }

        .user-profile .user-name {
            font-weight: 600;
            color: var(--mofu-dark-text); /* Nama user lebih gelap */
        }

        .content-card {
            background: #ffffff;
            border: 1px solid var(--mofu-light-border); 
            border-radius: 40px;
            width: 100%;
            box-shadow: 0 4px 8px -2px var(--mofu-shadow-soft); 
            color: var(--mofu-dark-text); 
            padding: 30px;
            margin-top: 20px;
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
            background-color:var(--mofu-dark-text); 
            color: #ffffff; 
            border-color: var(--mofu-dark-text); 
        }

        /* --- Tambahan untuk KPI Cards (dari dashboard) --- */
        .kpi-card .card-body {
            display: flex;
            align-items: center;
        }
        .kpi-card .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
            color: white; /* Ikon tetap putih */
        }

        .kpi-card .icon-circle.bg-success { background-color: #6fb07f !important; } /* Hijau lembut */
        .kpi-card .icon-circle.bg-primary { background-color: var(--mofu-blue-text) !important; } /* Biru teks mofusand */
        .kpi-card .icon-circle.bg-warning { background-color: var(--mofu-yellow-accent) !important; } /* Kuning aksen mofusand */
        .kpi-card .icon-circle.bg-danger { background-color: #e57373 !important; } /* Merah lembut */

        .kpi-card .card-subtitle { color: var(--mofu-blue-text) !important; } /* Subtitle kpi */
        .kpi-card .card-title { color: var(--mofu-dark-text) !important; } /* Judul kpi */
        
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
       
        
    </style>
    @stack('styles') {{-- Slot untuk CSS tambahan per halaman --}}
</head>
<body>

<div class="container-fluid">
    @include('layouts.partials.header')

    <main id="swup" class="main-content transition-fade">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</body>
</html>