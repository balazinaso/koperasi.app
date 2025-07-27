<?php include 'template/header.php'; ?>
<?php include 'config/koneksi.php'; ?>

<div class="container-fluid px-4">
  <h4 class="mt-4">Tambah Sales</h4>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="sales.php">Data Sales</a></li>
    <li class="breadcrumb-item active">Tambah Sales</li>
  </ol>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <?php
      if (isset($_POST['simpan'])) {
          $tgl_sales = $_POST['tgl_sales'];
          $id_customer = $_POST['id_customer'];
          $do_customer = strtoupper(trim($_POST['do_customer']));
          $status = $_POST['status'];

          if ($tgl_sales && $id_customer && $do_customer && $status) {
              $simpan = mysqli_query($koneksi, "INSERT INTO sales (tgl_sales, id_customer, do_customer, status)
                                                VALUES ('$tgl_sales', '$id_customer', '$do_customer', '$status')");

              if ($simpan) {
                  echo "<div class='alert alert-success alert-dismissible fade show'>
                          <strong>Berhasil!</strong> Data sales telah ditambahkan.
                          <a href='sales.php' class='btn btn-sm btn-outline-success ms-3'>Lihat Data</a>
                        </div>";
              } else {
                  echo "<div class='alert alert-danger'>Gagal menyimpan data: " . mysqli_error($koneksi) . "</div>";
              }
          } else {
              echo "<div class='alert alert-warning'>Harap lengkapi semua field!</div>";
          }
      }
      ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label fw-semibold">Tanggal Sales</label>
          <input type="date" name="tgl_sales" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Pilih Customer</label>
          <select name="id_customer" class="form-select" required>
            <option value="">-- Pilih Customer --</option>
            <?php
            $cust = mysqli_query($koneksi, "SELECT * FROM customer ORDER BY nama_customer ASC");
            while ($c = mysqli_fetch_assoc($cust)) {
              echo "<option value='$c[id_customer]'>$c[nama_customer]</option>";
            }
            ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">DO Customer</label>
          <input type="text" name="do_customer" class="form-control" placeholder="Nomor DO atau keterangan DO" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Status</label>
          <select name="status" class="form-select" required>
            <option value="">-- Pilih Status --</option>
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
          </select>
        </div>

        <div class="d-flex justify-content-between">
          <a href="sales.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali
          </a>
          <button type="submit" name="simpan" class="btn btn-primary">
            <i class="bi bi-save2"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'template/footer.php'; ?>
