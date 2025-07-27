<?php include 'template/header.php'; ?>
<?php include 'config/koneksi.php'; ?>

<div class="container-fluid px-4">
  <h4 class="mt-4">Tambah Item / Barang</h4>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="item.php">Data Item</a></li>
    <li class="breadcrumb-item active">Tambah Item</li>
  </ol>

  <div class="card shadow-sm mb-4">
    <div class="card-body">

      <?php
      if (isset($_POST['simpan'])) {
          $nama_item = ucwords(trim($_POST['nama_item']));
          $satuan = trim($_POST['satuan']);
          $harga_beli = str_replace(',', '', $_POST['harga_beli']);
          $harga_jual = str_replace(',', '', $_POST['harga_jual']);

          if ($nama_item && $satuan && is_numeric($harga_beli) && is_numeric($harga_jual)) {
              $simpan = mysqli_query($koneksi, "INSERT INTO item (nama_item, satuan, harga_beli, harga_jual) VALUES ('$nama_item', '$satuan', '$harga_beli', '$harga_jual')");
              if ($simpan) {
                  echo "<div class='alert alert-success alert-dismissible fade show'>
                          <strong>Berhasil!</strong> Data item berhasil ditambahkan.
                          <a href='item.php' class='btn btn-sm btn-outline-success ms-3'>Lihat Data</a>
                        </div>";
              } else {
                  echo "<div class='alert alert-danger'>Gagal menambahkan data: " . mysqli_error($koneksi) . "</div>";
              }
          } else {
              echo "<div class='alert alert-warning'>Harap isi semua data dengan benar!</div>";
          }
      }
      ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label fw-semibold">Nama Item</label>
          <input type="text" name="nama_item" class="form-control" placeholder="Contoh: Pulpen" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Satuan</label>
          <input type="text" name="satuan" class="form-control" placeholder="Contoh: pcs, box, lusin" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Harga Beli</label>
          <input type="number" name="harga_beli" class="form-control" placeholder="Contoh: 1500" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Harga Jual</label>
          <input type="number" name="harga_jual" class="form-control" placeholder="Contoh: 2000" required>
        </div>
        <div class="d-flex justify-content-between">
          <a href="item.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Kembali</a>
          <button type="submit" name="simpan" class="btn btn-primary">
            <i class="bi bi-save2"></i> Simpan
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<?php include 'template/footer.php'; ?>
