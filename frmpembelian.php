<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['save'])) {
        $noSurat = $_POST['no_surat'];
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $barang = $_POST['nama_barang'];
        $qty = $_POST['qty'];

        $_SESSION['data'][] = [
            'no_surat' => $noSurat,
            'nama' => $nama,
            'nama_barang' => $barang,
            'kategori' => $kategori,
            'qty' => $qty
        ];
    }

    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pembelian</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
    }
    .card {
      margin-top: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      border-radius: 15px;
    }
  </style>
</head>
<body>

<!-- Tombol Back -->
<button type="button" class="btn btn-success mt-3 ms-3" onclick="window.location.href='index.php'">← Back</button>

<div class="container">
  <div class="card p-4">
    <h3 class="mb-4 text-center">Form Pembelian Barang</h3>
    <form method="post" class="row g-3">
      
      <div class="col-md-4">
        <label for="no_surat" class="form-label">No Surat</label>
        <input type="text" name="no_surat" id="no_surat" class="form-control" required>
      </div>

      <div class="col-md-4">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
      </div>

      <!-- Dropdown Kategori -->
      <div class="col-md-4">
        <label for="kategori" class="form-label">Kategori</label>
        <select name="kategori" id="kategori" class="form-select" required onchange="updateBarangOptions()">
          <option value="" disabled selected>-- Pilih Kategori --</option>
          <option value="Alat">Alat-alat</option>
          <option value="Bahan">Bahan</option>
        </select>
      </div>

      <!-- Dropdown Nama Barang (Dinamis) -->
      <div class="col-md-4">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <select name="nama_barang" id="nama_barang" class="form-select" required>
          <option value="" disabled selected>-- Pilih Barang --</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="qty" class="form-label">Qty</label>
        <input type="number" name="qty" id="qty" class="form-control" min="1" required>
      </div>

      <div class="col-12 d-flex justify-content-end mt-4">
        <button type="submit" name="save" class="btn btn-success me-2">Save</button>
        <button type="submit" name="cancel" class="btn btn-secondary">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- JavaScript untuk update barang berdasarkan kategori -->
<script>
function updateBarangOptions() {
  const kategori = document.getElementById("kategori").value;
  const namaBarangSelect = document.getElementById("nama_barang");

  // Kosongkan dulu
  namaBarangSelect.innerHTML = '<option value="" disabled selected>-- Pilih Barang --</option>';

  let options = [];

  if (kategori === "Alat") {
    options = ["Sabun", "Sikat", "Lap"];
  } else if (kategori === "Bahan") {
    options = ["Parfum Ruangan", "Pembersih Lantai"];
  }

  options.forEach(function(item) {
    const option = document.createElement("option");
    option.value = item;
    option.text = item;
    namaBarangSelect.appendChild(option);
  });
}
</script>

<!-- Tabel Data -->
<?php if (!empty($_SESSION['data'])): ?>
<div class="card p-4 mt-4">
  <h4 class="mb-3">Data Pembelian</h4>
  <form method="post"> <!-- Mulai form di sini -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>No</th>
            <th>No Surat</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Nama Barang</th>
            <th>Qty</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION['data'] as $i => $row): ?>
          <tr>
            <td>
              <input type="checkbox" name="hapus[]" value="<?= $i ?>">
            </td>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($row['no_surat']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['kategori']) ?></td>
            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
            <td><?= htmlspecialchars($row['qty']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <button type="submit" name="delete" class="btn btn-danger mt-2">Hapus Data Terpilih</button>
  </form>
</div>
<?php endif; ?>

