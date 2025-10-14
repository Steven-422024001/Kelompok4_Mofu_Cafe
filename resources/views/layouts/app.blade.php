<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mofu Cafe Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Di sini kita akan menaruh semua CSS --}}
    <style>
        body { margin: 0; background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
        .header-nav { background-color: #ffffff; border: 1px solid #e9ecef; border-radius: 12px; padding: 12px 24px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-top: 20px; }
        .header-nav .navbar-brand { font-weight: 700; font-size: 1.5rem; color: #111827 !important; }
        .nav-links { display: flex; gap: 8px; }
        .nav-links a { display: flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 8px; text-decoration: none; color: #6c757d; font-weight: 500; transition: color 0.2s ease; position: relative; padding-bottom: 10px; }
        .nav-links a:hover { color: #111827; }
        .nav-links a.active { color: #111827 !important; font-weight: 600; }
        .nav-links a.active::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 30px; height: 3px; background-color: #111827; border-radius: 2px; }
        .user-profile { display: flex; align-items: center; gap: 12px; }
        .user-profile img { width: 40px; height: 40px; border-radius: 50%; }
        .user-profile .user-name { font-weight: 600; color: #343a40; }
        .content-card { background: #ffffff; border: 1px solid #e9ecef; border-radius: 12px; width: 100%; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); color: #333; padding: 30px; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container-fluid">
    {{-- Memanggil Header/Navbar dari file terpisah --}}
    @include('layouts.partials.header')

    <main class="main-content">
        {{-- Di sinilah konten dari setiap halaman akan ditampilkan --}}
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- Di sini script khusus dari setiap halaman akan ditampilkan --}}
@yield('scripts')

</body>
</html>