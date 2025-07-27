<?php include 'template/header.php'; ?>
<?php include 'config/koneksi.php'; ?>

<h3 class="mb-4">Data Petugas</h3>

<a href="tambah_petugas.php" class="btn btn-primary mb-3">+ Tambah Petugas</a>

<table class="table table-bordered table-striped">
    <thead class="table-danger">
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM petugas ORDER BY id_petugas DESC");
        while ($row = mysqli_fetch_assoc($query)):
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_petugas'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['level'] ?></td>
            <td>
                <a href="edit_petugas.php?id=<?= $row['id_petugas'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="hapus_petugas.php?id=<?= $row['id_petugas'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus petugas ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'template/footer.php'; ?>
