<?php /* sidebar.php */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Sidebar – Style</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- FontAwesome 6 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    :root {
      --bg: #111827;
      --bg-hover: #1f2937;
      --text: #d1d5db;
      --accent: #3b82f6;
    }
    body {
      background: var(--bg);
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
        sans-serif;
    }

    .sidebar {
      width: 260px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background: var(--bg);
      padding-top: 1.5rem;
      overflow-y: auto;
      transition: 0.3s;
    }
    .sidebar.collapsed {
      width: 72px;
    }
    .brand {
      color: #fff;
      font-size: 1.3rem;
      font-weight: 700;
      padding: 0 1.5rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .nav-link {
      color: var(--text);
      padding: 0.7rem 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      border-radius: 0.5rem;
      margin: 0.25rem 1rem;
      font-size: 0.9rem;
      transition: 0.2s;
      cursor: pointer;
    }
    .nav-link:hover {
      background: var(--bg-hover);
      color: var(--accent);
    }
    .submenu {
      margin-left: 1.5rem;
      max-height: 0;
      overflow: hidden;
      opacity: 0;
      transition: max-height 0.3s ease, opacity 0.3s ease;
    }

    /* Hover animasi submenu muncul */
    @media (hover: hover) and (pointer: fine) {
      .nav-item:hover > .submenu {
        max-height: 500px;
        opacity: 1;
        overflow: visible;
      }
      /* Chevron panah berputar */
      .nav-item:hover > a > .fas.fa-chevron-down {
        transform: rotate(180deg);
        transition: transform 0.3s ease;
      }
    }

    .badge {
      font-size: 0.65rem;
      margin-left: auto;
    }
    .toggle-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      color: var(--accent);
      font-size: 1.2rem;
      cursor: pointer;
    }
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }
      .sidebar.show {
        transform: translateX(0);
      }
    }
  </style>
</head>
<body>

<nav class="sidebar" id="sidebar">
  <button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
  </button>

  <div class="brand">
    <i class="fas fa-cube"></i>
    <span>Jakarta 3</span>
  </div>

  <ul class="nav flex-column">
    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboards</span>
        <i class="fas fa-chevron-down ms-auto small"></i>
      </a>
      <ul class="submenu nav flex-column">
        <li><a class="nav-link" href="dashpembelian.php">Pembelian barang</a></li>
      </ul>
    </li>

    <!-- General Affair -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-clipboard-check"></i>
        <span>General Affair</span>
        <i class="fas fa-chevron-down ms-auto small"></i>
      </a>
      <ul class="submenu nav flex-column">
        <li><a class="nav-link" href="frmpembelian.php">Form Pembelian Barang</a></li>
        <!-- Tambahkan submenu lain jika diperlukan -->
      </ul>
    </li>
  </ul>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
  }
</script>
</body>
</html>
