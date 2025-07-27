<?php
include 'template/header.php';
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama_customer = mysqli_real_escape_string($koneksi, $_POST['nama_customer']);
  $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
  $telp          = mysqli_real_escape_string($koneksi, $_POST['telp']);
  $fax           = mysqli_real_escape_string($koneksi, $_POST['fax']);
  $email         = mysqli_real_escape_string($koneksi, $_POST['email']);

  $simpan = mysqli_query($koneksi, "INSERT INTO customer (nama_customer, alamat, telp, fax, email) 
                                    VALUES ('$nama_customer', '$alamat', '$telp', '$fax', '$email')");

  if ($simpan) {
    echo "<script>alert('Data customer berhasil ditambahkan!'); window.location='customer.php';</script>";
  } else {
    echo "<div class='alert alert-danger'>Gagal menambahkan data: " . mysqli_error($koneksi) . "</div>";
  }
}
?>

<div class="container-fluid px-4">
  <h4 class="mt-4">Tambah Customer</h4>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="customer.php">Customer</a></li>
    <li class="breadcrumb-item active">Tambah Data</li>
  </ol>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label>Nama Customer</label>
          <input type="text" name="nama_customer" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
          <label>Telepon</label>
          <input type="text" name="telp" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Fax</label>
          <input type="text" name="fax" class="form-control">
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
        <a href="customer.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

<?php include 'template/footer.php'; ?>
