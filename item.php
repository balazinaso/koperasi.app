<?php include 'template/header.php'; ?>
<?php include 'config/koneksi.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Data Item / Barang</h4>
    <a href="tambah_item.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Item
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Item</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM item ORDER BY id_item DESC");
                    if (mysqli_num_rows($query) > 0):
                        while ($row = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_item']) ?></td>
                        <td>Rp<?= number_format(isset($row['harga_jual']) ? $row['harga_jual'] : 0, 0, ',', '.') ?></td>
                        <td class="text-center"><?= isset($row['stok']) ? $row['stok'] : 0 ?></td>
                        <td class="text-center">
                            <a href="edit_item.php?id=<?= $row['id_item'] ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="hapus_item.php?id=<?= $row['id_item'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus item ini?')">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data item.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'template/footer.php'; ?>
