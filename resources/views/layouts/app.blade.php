<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mofu Cafe Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* ===== PENGATURAN DASAR ===== */
    body {
      margin: 0;
      background-color: #efefef;
      font-family: 'Inter', sans-serif;
    }

    /* ===== HEADER / NAVBAR ===== */
    .header-nav {
      background-color: #ffffff;
      border: 1px solid #e9ecef;
      border-radius: 50px;
      padding: 12px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      margin-top: 20px;
    }

    .header-nav .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: #111827 !important;
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
      color: #6c757d;
      font-weight: 500;
      transition: background-color 0.2s ease, color 0.2s ease;
      position: relative;
      padding-bottom: 10px;
    }

    .nav-links a.active {
      color: #111827 !important;
      font-weight: 600;
      background-color: transparent;
    }

    .nav-links a.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background-color: #111827;
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

    .navbar-toggler { display: none; }

    /* ===== MAIN CONTENT ===== */
    .main-content {
      padding: 20px 0;
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
      <!-- Dashboard -->
      <div id="dashboard" class="slide active">
        <div class="dark-section">
          <div class="content-card">
            <h3 class="fw-bold mb-4">Dashboard Overview</h3>

            <!-- Statistik -->
            <div class="row text-center mb-4">
              <div class="col-md-4 mb-3">
                <div class="card bg-light border-0 shadow-sm p-3">
                  <h6 class="text-muted mb-1">Total Orders</h6>
                  <h3 class="fw-bold text-danger">21,375</h3>
                  <small class="text-success">+2.5% dari minggu lalu</small>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="card bg-light border-0 shadow-sm p-3">
                  <h6 class="text-muted mb-1">New Customers</h6>
                  <h3 class="fw-bold text-primary">1,012</h3>
                  <small class="text-success">+3.2% bulan ini</small>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="card bg-light border-0 shadow-sm p-3">
                  <h6 class="text-muted mb-1">Total Sales</h6>
                  <h3 class="fw-bold text-success">$24,254</h3>
                  <small class="text-danger">-1.4% dibanding minggu lalu</small>
                </div>
              </div>
            </div>

            <!-- Grafik Penjualan -->
            <div class="card bg-light border-0 shadow-sm p-4 mb-4">
              <h6 class="fw-bold mb-3">Sales Analytics</h6>
              <canvas id="salesChart" height="100"></canvas>
            </div>

            <!-- Trending Coffee -->
            <div class="card bg-light border-0 shadow-sm p-4">
              <h6 class="fw-bold mb-3">Trending Coffee ☕</h6>
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Sold</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Cappuccino</td>
                    <td>$85.00</td>
                    <td>240</td>
                  </tr>
                  <tr>
                    <td>Latte</td>
                    <td>$70.50</td>
                    <td>220</td>
                  </tr>
                  <tr>
                    <td>Frappuccino</td>
                    <td>$82.50</td>
                    <td>200</td>
                  </tr>
                  <tr>
                    <td>Mocha</td>
                    <td>$50.00</td>
                    <td>100</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Products -->
      <div id="products" class="slide">
          <div class="content-card">
            <h5 class="fw-bold mb-3">Product Overview</h5>
            @yield('content')
          </div>
      </div>

      <!-- Supplier -->
      <div id="supplier" class="slide">
          <div class="content-card">
            <h5>Daftar Supplier</h5>
            @yield('content1')
          </div>
      </div>

      <!-- Kategori -->
      <div id="kategori" class="slide">
          <div class="content-card">
            <h5>Kategori Produk</h5>
            @yield('content-kategori')
          </div>
      </div>

      <!-- Transaksi -->
      <div id="transaksi" class="slide">
          <div class="content-card">
            <h5>Transaksi Penjualan</h5>
            @yield('content-transaksi')
          </div>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function showSlide(event, id) {
  event.preventDefault();
  document.querySelectorAll('.slide').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
  event.currentTarget.classList.add('active');
}

document.addEventListener("DOMContentLoaded", function() {
  document.querySelector('.nav-links a[onclick*="dashboard"]').classList.add('active');

  // Chart.js setup
  const ctx = document.getElementById('salesChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['09:00', '12:00', '15:00', '18:00', '21:00'],
      datasets: [{
        label: 'Sales ($)',
        data: [50, 120, 230, 180, 140],
        fill: true,
        borderColor: '#ff4a3d',
        backgroundColor: 'rgba(255, 74, 61, 0.2)',
        tension: 0.4
      }]
    },
    options: {
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false } },
        y: { grid: { color: 'rgba(200,200,200,0.2)' } }
      }
    }
  });
});
</script>

@yield('scripts')
</body>
</html>
