<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mofu Cafe</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@600;700;900&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      background: #f4f6f9;
      font-family: 'Poppins', sans-serif;
    }

    /* ===== NAVBAR ===== */
    .navbar {
      background: rgba(60, 60, 60, 0.9);
      backdrop-filter: blur(10px);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      font-family: 'Playfair Display', serif;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: 800;
      font-size: 1.8rem;
      letter-spacing: 1px;
    }

    .navbar-nav .nav-link {
      color: #fff !important;
      font-weight: 500;
      margin: 0 10px;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: all 0.3s ease;
      padding: 8px 12px;
    }

    .navbar-nav .nav-link i {
      font-size: 1rem;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: #ff4a3d !important;
      transform: scale(1.05);
    }

    /* ===== MAIN CONTENT ===== */
    .main-content {
      margin-top: 70px;
      padding: 0;
    }

    .slide {
      display: none;
      animation: fadeIn 0.5s ease-in-out;
    }

    .slide.active {
      display: block;
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    /* ===== Dashboard Hero ===== */
    .dashboard-hero {
      position: relative;
      width: 100%;
      height: 100vh;
      background: url('{{ asset('storage/images/welcome1.webp') }}') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
      overflow: hidden;
    }

    .dashboard-hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.55);
      z-index: 0;
    }

    .dashboard-content {
      position: relative;
      z-index: 1;
      padding: 20px;
      max-width: 900px;
    }

    .dashboard-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: 4rem;
      font-weight: 900;
      letter-spacing: 1px;
      color: #fff;
      text-shadow: 0 4px 20px rgba(0,0,0,0.4);
      margin-bottom: 15px;
      line-height: 1.2;
    }

    .dashboard-content span {
      color: #ff4a3d;
    }

    .dashboard-content p {
      font-size: 1.3rem;
      font-weight: 400;
      color: #f1f1f1;
      text-shadow: 0 2px 5px rgba(0,0,0,0.6);
    }

    /* ===== DARK TRANSPARENT SECTION ===== */
    .dark-section {
      position: relative;
      width: 100%;
      min-height: 100vh;
      background: linear-gradient(135deg, rgba(176, 176, 176, 0.85), rgba(45,45,45,0.85));
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 100px 0;
    }

    .dark-section .content-card {
      position: relative;
      background: rgba(103, 101, 101, 0.18);
      border: 1px solid rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(15px);
      border-radius: 15px;
      width: 90%;
      max-width: 1100px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.3);
      color: white;
      padding: 30px;
    }

    /* Table styling */
    .dark-section table {
      color: white !important;
      border-collapse: collapse;
      width: 100%;
    }

    .dark-section thead tr {
      background-color: rgba(255, 255, 255, 0.53);
      font-weight: bold;
    }

    .dark-section tbody tr {
      background-color: rgba(255, 255, 255, 0.53);
      transition: background 0.3s ease;
    }

    .dark-section tbody tr:hover {
      background-color: rgba(238, 238, 238, 0.55);
    }

    .dark-section th, 
    .dark-section td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dark-section .btn {
      color: white;
      font-weight: 600;
      border-radius: 6px;
    }
  </style>
</head>
<body>

  <!-- ===== NAVBAR ===== -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">Mofu Cafe</a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="#" class="nav-link active" onclick="showSlide(event, 'dashboard')"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
          <li class="nav-item"><a href="#" class="nav-link" onclick="showSlide(event, 'products')"><i class="fa-solid fa-mug-hot"></i> Products</a></li>
          <li class="nav-item"><a href="#" class="nav-link" onclick="showSlide(event, 'kategori')"><i class="fa-solid fa-truck-fast"></i> Supplier</a></li>
          <li class="nav-item"><a href="#" class="nav-link" onclick="showSlide(event, 'followers')"><i class="fa-solid fa-tags"></i> Kategori Produk</a></li>
          <li class="nav-item"><a href="#" class="nav-link" onclick="showSlide(event, 'saved')"><i class="fa-solid fa-receipt"></i> Transaksi Penjualan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="main-content">
    <!-- Dashboard -->
    <div id="dashboard" class="slide active">
      <div class="dashboard-hero">
        <div class="dashboard-content">
          <h2>Selamat Datang di <br><span>Mofu Cafe ☕</span></h2>
          <p>Semua products, supplier, kategori produk, dan transaksi penjualan kini bisa kamu atur dengan mudah dalam satu website.</p>
        </div>
      </div>
    </div>

    <!-- Products -->
    <div id="products" class="slide">
      <div class="dark-section">
        <div class="content-card">
          <h5 class="fw-bold mb-3">Product Overview</h5>
          @yield('content')
        </div>
      </div>
    </div>

    <!-- Supplier -->
    <div id="kategori" class="slide">
      <div class="dark-section">
        <div class="content-card">
          <h5>Supplier</h5>
        </div>
      </div>
    </div>

    <!-- Kategori Produk -->
    <div id="followers" class="slide">
      <div class="dark-section">
        <div class="content-card">
          <h5>Kategori Produk</h5>
        </div>
      </div>
    </div>

    <!-- Transaksi Penjualan -->
    <div id="saved" class="slide">
      <div class="dark-section">
        <div class="content-card">
          <h5>Transaksi Penjualan</h5>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== JS ===== -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    function showSlide(event, id) {
      event.preventDefault();
      document.querySelectorAll('.slide').forEach(s => s.classList.remove('active'));
      document.getElementById(id).classList.add('active');
      document.querySelectorAll('.navbar-nav .nav-link').forEach(a => a.classList.remove('active'));
      event.target.closest('a').classList.add('active');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  </script>
  @yield('scripts')
</body>
</html>
