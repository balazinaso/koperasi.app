<?php include 'template/header.php'; ?>
<?php include 'config/koneksi.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="fw-bold">Data Transaksi</h4>
</div>

<!-- Form Input Transaksi -->
<div class="card shadow-sm mb-4">
  <div class="card-header bg-primary text-white">
    <strong><i class="bi bi-cart-plus"></i> Input Transaksi</strong>
  </div>
  <div class="card-body">
    <form method="post" class="row g-3">
      <div class="col-md-3">
        <label class="form-label">Customer</label>
        <select name="id_customer" class="form-select" required>
          <option value="">- Pilih -</option>
          <?php
          $q_cust = mysqli_query($koneksi, "SELECT * FROM customer");
          while ($c = mysqli_fetch_assoc($q_cust)) {
              echo "<option value='$c[id_customer]'>$c[nama_customer]</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">Item</label>
        <select name="id_item" class="form-select" required>
          <option value="">- Pilih -</option>
          <?php
          $q_item = mysqli_query($koneksi, "SELECT * FROM item");
          while ($i = mysqli_fetch_assoc($q_item)) {
              echo "<option value='$i[id_item]'>$i[nama_item]</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">Sales</label>
        <select name="id_sales" class="form-select" required>
          <option value="">- Pilih -</option>
          <?php
          $q_sales = mysqli_query($koneksi, "SELECT * FROM sales");
          while ($s = mysqli_fetch_assoc($q_sales)) {
              echo "<option value='$s[id_sales]'>$s[nama_sales]</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-md-1">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" min="1" required>
      </div>
      <div class="col-md-2">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
      </div>
      <div class="col-md-1 d-flex align-items-end">
        <button type="submit" name="simpan" class="btn btn-success w-100">
          <i class="bi bi-save"></i>
        </button>
      </div>
    </form>
  </div>
</div>

<?php
// Proses simpan transaksi
if (isset($_POST['simpan'])) {
    $id_customer = $_POST['id_customer'];
    $id_item     = $_POST['id_item'];
    $id_sales    = $_POST['id_sales'];
    $jumlah      = $_POST['jumlah'];
    $tanggal     = $_POST['tanggal'];

    $h = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga_jual FROM item WHERE id_item='$id_item'"));
    $harga = $h['harga_jual'];
    $total = $jumlah * $harga;

    $simpan = mysqli_query($koneksi, "INSERT INTO transaksi (id_customer, id_item, id_sales, jumlah, tanggal, total)
                                      VALUES ('$id_customer', '$id_item', '$id_sales', '$jumlah', '$tanggal', '$total')");
    if ($simpan) {
        echo "<div class='alert alert-success'>✅ Transaksi berhasil disimpan.</div>";
    } else {
        echo "<div class='alert alert-danger'>❌ Gagal menyimpan transaksi.</div>";
    }
}
?>

<!-- Tabel Transaksi -->
<div class="card shadow-sm">
  <div class="card-body">
    <h6 class="card-title fw-bold mb-3">Riwayat Transaksi</h6>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light text-center">
          <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Item</th>
            <th>Sales</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $q = mysqli_query($koneksi, "
              SELECT t.*, c.nama_customer, i.nama_item, s.nama_sales
              FROM transaksi t
              JOIN customer c ON t.id_customer = c.id_customer
              JOIN item i ON t.id_item = i.id_item
              JOIN sales s ON t.id_sales = s.id_sales
              ORDER BY t.id_transaksi DESC
          ");
          while ($row = mysqli_fetch_assoc($q)):
          ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_customer']) ?></td>
            <td><?= htmlspecialchars($row['nama_item']) ?></td>
            <td><?= htmlspecialchars($row['nama_sales']) ?></td>
            <td class="text-center"><?= $row['jumlah'] ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
            <td><?= date("d-m-Y", strtotime($row['tanggal'])) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'template/footer.php'; ?>
