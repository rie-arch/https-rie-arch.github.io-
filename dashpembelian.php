<?php
include 'config.php';

// Hitung total
$total = $conn->query("SELECT COUNT(*) as total FROM permintaan")->fetch_assoc()['total'];
$approved = $conn->query("SELECT COUNT(*) as approved FROM permintaan WHERE status='approved'")->fetch_assoc()['approved'];
$rejected = $conn->query("SELECT COUNT(*) as rejected FROM permintaan WHERE status='rejected'")->fetch_assoc()['rejected'];
$pending = $conn->query("SELECT COUNT(*) as pending FROM permintaan WHERE status='pending'")->fetch_assoc()['pending'];

// Ambil data grafik
$chartData = [];
for ($i = 1; $i <= 12; $i++) {
    $month = date('Y') . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
    $res = $conn->query("SELECT COUNT(*) as jumlah FROM permintaan WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$month'");
    $chartData[] = $res->fetch_assoc()['jumlah'];
}

// Ambil history
$history = $conn->query("SELECT * FROM permintaan ORDER BY tanggal DESC LIMIT 10");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengajuan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    

<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Dashboard Pengajuan Barang</span>
        <a href="index.php" class="btn btn-light btn-sm ms-auto">
            ← Kembali
        </a>
    </div>
</nav>

<div class="container">
    <!-- Card Ringkasan -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Permintaan</h5>
                    <h2><?= $total ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
    <div class="card text-white bg-success">
        <div class="card-body d-flex align-items-center">
            <div>
                <h5 class="card-title">Disetujui</h5>
                    <h2><?= $approved ?></h2>
            </div>
        </div>
    </div>
</div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Ditolak</h5>
                    <h2><?= $rejected ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <h2><?= $pending ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Grafik Permintaan per Bulan</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartPermintaan" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel History -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>History Permintaan</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Total Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $history->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nama_barang'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['status'] == 'approved' ? 'success' : ($row['status'] == 'rejected' ? 'danger' : 'warning') ?>">
                                        <?= ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('chartPermintaan').getContext('2d');
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Permintaan',
            data: <?= json_encode($chartData) ?>,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.3
        }]
    },
    options: {
  responsive: true,
  plugins: {
    legend: { display: true }
  },
  scales: {
    y: {
      beginAtZero: true,          // paksa sumbu Y dimulai dari 0
      min: 0,
      max: 100000000,             // maksimal 100 juta
      ticks: {
        callback: function(value) {
          // tampilkan angka penuh dengan pemisah ribuan
          return value.toLocaleString('id-ID');
        }
      }
    }
  }
}
});
</script>
</body>
</html>