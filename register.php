<?php
session_start();
include "config/koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$success = "";
$error = "";

// Ambil data level untuk dropdown
$levels = mysqli_query($koneksi, "SELECT * FROM level");

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_petugas = mysqli_real_escape_string($koneksi, $_POST['nama_petugas']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id_level = (int) $_POST['id_level'];

    // Cek apakah username sudah digunakan
    $cek = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO petugas (nama_petugas, username, password, id_level) 
                   VALUES ('$nama_petugas', '$username', '$password', $id_level)");
        if ($query) {
            $success = "Registrasi berhasil! Silakan login.";
        } else {
            $error = "Gagal registrasi: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4>Form Registrasi Petugas</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php elseif (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <select name="id_level" class="form-select" required>
                                <option value="">-- Pilih Level --</option>
                                <?php while ($lvl = mysqli_fetch_assoc($levels)) : ?>
                                    <option value="<?= $lvl['id_level'] ?>"><?= $lvl['nama_level'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Daftar</button>
                        <a href="login.php" class="btn btn-secondary w-100 mt-2">Kembali ke Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
