<?php include 'template/header.php'; ?>
<?php include 'config/koneksi.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Data Sales</h4>
    <a href="tambah_sales.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Sales
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th style="width: 50px;">No</th>
                        <th>Nama Customer</th>
                        <th>No. HP</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "
                        SELECT sales.id_sales, customer.nama_customer, customer.telp 
                        FROM sales 
                        JOIN customer ON sales.id_customer = customer.id_customer 
                        ORDER BY sales.id_sales DESC
                    ");
                    if (mysqli_num_rows($query) > 0):
                        while ($row = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_customer']) ?></td>
                        <td><?= htmlspecialchars($row['telp']) ?></td>
                        <td class="text-center">
                            <a href="edit_sales.php?id=<?= $row['id_sales'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="hapus_sales.php?id=<?= $row['id_sales'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data sales.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'template/footer.php'; ?>
