<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mofu Cafe Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* ===== PENGATURAN DASAR ===== */
    body {
      margin: 0;
      background-color: #efefefff; /* Warna latar belakang abu-abu muda seperti di gambar */
      font-family: 'Inter', sans-serif; /* Font yang lebih modern dan mirip gambar */
    }

    /* ===== HEADER / NAVBAR BARU ===== */
    .header-nav {
      background-color: #ffffff;
      border: 1px solid #e9ecef;
      border-radius: 50px;
      padding: 12px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      margin-top: 20px; /* Jarak dari atas */
    }

    .header-nav .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: #111827 !important;
    }

    .nav-links {
      display: flex;
      gap: 8px; /* Jarak antar menu */
    }

    .nav-links a {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      border-radius: 8px;
      text-decoration: none;
      color: #6c757d; /* Warna teks abu-abu */
      font-weight: 500;
      transition: background-color 0.2s ease, color 0.2s ease;
      position: relative; /* Diperlukan untuk garis bawah */
      padding-bottom: 10px; /* Beri sedikit ruang untuk garis bawah */
      }

    .nav-links a.active {
      color: #111827 !important; /* Ubah warna teks menjadi hitam saat aktif */
      font-weight: 600; /* Buat sedikit lebih tebal */
      background-color: transparent; /* Pastikan tidak ada warna latar belakang */
    }

    .nav-links a.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px; /* Lebar garis bawah */
      height: 3px;  /* Ketebalan garis bawah */
      background-color: #111827; /* Warna garis bawah (hitam) */
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
      object-fit: cover;
    }

    .user-profile .user-name {
      font-weight: 600;
      color: #343a40;
    }
    
    .user-profile .fa-chevron-down {
        color: #6c757d;
    }

    /* Menghilangkan tombol burger default */
    .navbar-toggler {
        display: none;
    }

    /* ===== MAIN CONTENT ===== */
    .main-content {
      padding: 20px 0; /* Memberi jarak di bawah header */
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

    /* Menyesuaikan style lama agar tidak bentrok */
    .dashboard-hero {
      width: 100%;
      height: 70vh; 
      border-radius: 50px;
      margin-top: 20px;
      background: url('https://images.unsplash.com/photo-1511920183276-5941c3e945e8?q=80&w=2940&auto=format&fit=crop') no-repeat center center/cover;
    }
    .dark-section {
        padding: 20px 0;
    }
    .content-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 50px;
        width: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        color: #333;
        padding: 30px;
    }

  </style>
</head>
<body>

<div class="container-fluid">
    <nav class="header-nav">
        <a class="navbar-brand" href="#">Mofu Cafe</a>

        <div class="nav-links">
            <a href="#" class="active" onclick="showSlide(event, 'dashboard')"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="#" onclick="showSlide(event, 'products')"><i class="fa-solid fa-mug-hot"></i> Products</a>
            <a href="#" onclick="showSlide(event, 'supplier')"><i class="fa-solid fa-truck-fast"></i> Supplier</a>
            <a href="#" onclick="showSlide(event, 'kategori')"><i class="fa-solid fa-tags"></i> Kategori</a>
            <a href="#" onclick="showSlide(event, 'transaksi')"><i class="fa-solid fa-receipt"></i> Transaksi</a>
        </div>

        <div class="user-profile">
            <img src="https://i.pravatar.cc/150?u=admin" alt="User Avatar">
            <div>
                <span class="user-name">Admin Mofu</span>
                <i class="fa-solid fa-chevron-down ms-1"></i>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div id="dashboard" class="slide active">
            <div class="dashboard-hero">
                <div class="dashboard-content">
                    <h2 style="font-family: 'Inter', sans-serif; font-size: 2.5rem; font-weight: 700;">Selamat Datang di Mofu Cafe ☕</h2>
                    <p style="font-family: 'Inter', sans-serif; font-size: 1.1rem;">Atur semua kebutuhan kafe Anda dalam satu dasbor terpusat.</p>
                </div>
            </div>
        </div>

        <div id="products" class="slide">
            <div class="content-card">
              <h5 class="fw-bold mb-3">Product Overview</h5>
            </div>
        </div>

        <div id="supplier" class="slide">
            <div class="content-card">
              <h5>Daftar Supplier</h5>
              
            </div>
        </div>

        <div id="kategori" class="slide">
            <div class="content-card">
              <h5>Kategori Produk</h5>
             
            </div>
        </div>

        <div id="transaksi" class="slide">
            <div class="content-card">
              <h5>Transaksi Penjualan</h5>
               
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Sedikit penyesuaian pada Javascript agar bekerja dengan struktur baru
    function showSlide(event, id) {
        event.preventDefault();
        
        // Sembunyikan semua slide
        document.querySelectorAll('.slide').forEach(s => s.classList.remove('active'));
        // Tampilkan slide yang dipilih
        document.getElementById(id).classList.add('active');
        
        // Hapus kelas 'active' dari semua link
        document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
        // Tambahkan kelas 'active' ke link yang diklik
        event.currentTarget.classList.add('active');
    }

    // Set 'Dashboard' sebagai menu aktif saat halaman pertama kali dimuat
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('.nav-links a[onclick*="dashboard"]').classList.add('active');
    });
</script>
@yield('scripts')
</body>
</html>