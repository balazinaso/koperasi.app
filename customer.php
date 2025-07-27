<?php include 'template/header.php'; ?>
<?php include 'config/koneksi.php'; ?>

<div class="container-fluid px-4">
  <h4 class="mt-4">Data Customer</h4>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Manajemen Data Customer Koperasi</li>
  </ol>

  <div class="mb-3">
    <a href="tambah_customer.php" class="btn btn-sm btn-primary">
      <i class="bi bi-person-plus"></i> Tambah Customer
    </a>
  </div>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-primary text-center">
            <tr>
              <th width="5%">No</th>
              <th>Nama Customer</th>
              <th>Alamat</th>
              <th>No. HP</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 1;
              $query = mysqli_query($koneksi, "SELECT * FROM customer ORDER BY id_customer DESC");
              while ($row = mysqli_fetch_assoc($query)):
            ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td><?= $row['nama_customer'] ?></td>
              <td><?= $row['alamat'] ?></td>
              <td><?= $row['telp'] ?></td> <!-- Gunakan kolom 'telp' sebagai 'No. HP' -->
              <td class="text-center">
                <a href="edit_customer.php?id=<?= $row['id_customer'] ?>" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <a href="hapus_customer.php?id=<?= $row['id_customer'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus data ini?')">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'template/footer.php'; ?>
