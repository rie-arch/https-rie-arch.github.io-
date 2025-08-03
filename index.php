<?php /* sidebar.php */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Sidebar – Style with Image</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- FontAwesome 6 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap');

    :root {
      --bg: #0f172a;
      --bg-hover: #1e293b;
      --text: #e0e7ff;
      --accent: #6366f1;
      --accent-hover: #4f46e5;
      --shadow: rgba(100, 100, 255, 0.2);
    }
    * {
      transition: all 0.3s ease;
    }
    body {
      background: var(--bg);
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      margin: 0;
      padding: 0;
      color: var(--text);
      user-select: none;
    }

    .sidebar {
      width: 280px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background: var(--bg);
      padding-top: 2rem;
      overflow-y: auto;
      box-shadow: 4px 0 15px var(--shadow);
      border-right: 1px solid #334155;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      z-index: 1000;
      /* Background image dengan blur dan opacity */
      background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80');
      background-size: cover;
      background-position: center;
      position: relative;
    }
    .sidebar::before {
      content: '';
      position: absolute;
      inset: 0;
      background: var(--bg);
      opacity: 0.85;
      backdrop-filter: blur(10px);
      z-index: 0;
      border-right: 1px solid #334155;
    }
    .sidebar > * {
      position: relative;
      z-index: 1; /* supaya isi sidebar di atas efek blur */
    }
    .sidebar.collapsed {
      width: 72px;
    }

    .brand {
      color: #a5b4fc;
      font-size: 1.8rem;
      font-weight: 900;
      padding: 0 2rem 1.5rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      user-select: none;
      letter-spacing: 2px;
      text-shadow: 0 0 6px var(--accent);
    }
    /* Logo gambar di brand */
    .brand img.logo-img {
      height: 36px;
      width: 36px;
      border-radius: 8px;
      object-fit: cover;
      box-shadow: 0 0 8px var(--accent);
      filter: drop-shadow(0 0 4px var(--accent));
      transition: transform 0.3s ease;
    }
    .brand img.logo-img:hover {
      transform: rotate(15deg) scale(1.1);
    }

    .brand i {
      font-size: 2.2rem;
      color: var(--accent);
      text-shadow: 0 0 12px var(--accent);
      display: none; /* hide fontawesome icon karena ada logo gambar */
    }

    .nav-link {
      color: var(--text);
      padding: 0.85rem 2rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      border-radius: 0.6rem;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      position: relative;
      user-select: none;
      box-shadow: inset 0 0 0 0 var(--accent);
    }
    .nav-link i {
      min-width: 20px;
      text-align: center;
      font-size: 1.2rem;
      color: var(--accent);
      transition: color 0.3s ease;
    }
    .nav-link span {
      flex-grow: 1;
    }
    .nav-link:hover,
    .nav-link.active {
      background: var(--accent);
      color: #fff !important;
      box-shadow: inset 100px 0 100px var(--accent-hover);
      font-weight: 600;
      letter-spacing: 0.05em;
      text-shadow: 0 0 4px #fff;
      border-radius: 0.7rem;
    }
    .nav-link:hover i,
    .nav-link.active i {
      color: #fff;
    }

    .submenu {
      margin-left: 2.5rem;
      max-height: 0;
      overflow: hidden;
      opacity: 0;
      transition: max-height 0.4s ease, opacity 0.4s ease;
      user-select: none;
      border-left: 2px solid var(--accent);
      padding-left: 1rem;
    }
    .submenu.collapse.show {
      max-height: 1000px;
      opacity: 1;
    }
    .submenu li a.nav-link {
      padding: 0.55rem 1rem;
      font-size: 0.9rem;
      border-radius: 0.5rem;
      color: var(--text);
      font-weight: 400;
      text-transform: capitalize;
      transition: background 0.3s ease;
    }
    .submenu li a.nav-link:hover {
      background: var(--accent-hover);
      color: #fff;
      font-weight: 600;
    }

    /* Chevron arrow style */
    .nav-item > a > .fas.fa-chevron-down {
      transition: transform 0.3s ease;
      font-size: 0.9rem;
      color: var(--accent);
    }
    .nav-item:hover > a > .fas.fa-chevron-down {
      transform: rotate(180deg);
    }
    .nav-item > a[aria-expanded="true"] > .fas.fa-chevron-down {
      transform: rotate(180deg);
    }

    .badge {
      font-size: 0.65rem;
      margin-left: auto;
      background: var(--accent);
      color: #fff;
      padding: 0.15rem 0.4rem;
      border-radius: 10px;
      font-weight: 700;
      user-select: none;
      box-shadow: 0 0 6px var(--accent);
    }

    .toggle-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      color: var(--accent);
      font-size: 1.6rem;
      cursor: pointer;
      user-select: none;
      z-index: 1100;
      transition: color 0.3s ease;
    }
    .toggle-btn:hover {
      color: var(--accent-hover);
    }

    /* Scrollbar styling */
    .sidebar::-webkit-scrollbar {
      width: 6px;
    }
    .sidebar::-webkit-scrollbar-thumb {
      background: var(--accent);
      border-radius: 10px;
      box-shadow: inset 0 0 6px var(--accent);
    }
    .sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
      }
      .sidebar.show {
        transform: translateX(0);
      }
      .toggle-btn {
        top: 1rem;
        left: 1rem;
        right: auto;
      }
    }
  </style>
</head>
<body>

<nav class="sidebar" id="sidebar">
  <button class="toggle-btn" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
    <i class="fas fa-bars"></i>
  </button>

  <div class="brand" title="Jakarta 3">
    <img class="logo-img" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=64&q=80" alt="Logo" />
    <span>Jakarta 3</span>
  </div>

  <ul class="nav flex-column">
    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="collapse" href="#dashboardMenu" role="button" aria-expanded="true" aria-controls="dashboardMenu">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboards</span>
        <i class="fas fa-chevron-down ms-auto small"></i>
      </a>
      <ul class="collapse show nav submenu" id="dashboardMenu">
        <li><a class="nav-link" href="dashpembelian.php">Pembelian barang</a></li>
      </ul>
    </li>
    <!-- General Affair -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#generalAffairMenu" role="button" aria-expanded="true" aria-controls="generalAffairMenu">
        <i class="fas fa-clipboard-check"></i>
        <span>General Affair</span>
        <i class="fas fa-chevron-down ms-auto small"></i>
      </a>
      <ul class="collapse show nav submenu" id="generalAffairMenu">
        <li><a class="nav-link" href="frmpembelian.php">Form Pembelian Barang</a></li>
      </ul>
    </li>
  </ul>
</nav>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
  }

  // Hover submenu effect for desktop only
  if (window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
    document.querySelectorAll('.nav-item').forEach(item => {
      item.addEventListener('mouseenter', () => {
        const submenu = item.querySelector('.submenu.collapse');
        if (submenu && !submenu.classList.contains('show')) {
          submenu.classList.add('show');
          item.querySelector('a').setAttribute('aria-expanded', 'true');
        }
      });
      item.addEventListener('mouseleave', () => {
        const submenu = item.querySelector('.submenu.collapse');
        if (submenu && submenu.classList.contains('show')) {
          submenu.classList.remove('show');
          item.querySelector('a').setAttribute('aria-expanded', 'false');
        }
      });
    });
  }
</script>

</body>
</html>
