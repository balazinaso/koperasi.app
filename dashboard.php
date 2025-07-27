<?php include 'template/header.php'; ?>
<?php include 'config/koneksi.php'; ?>

<?php
$jumlah_customer   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM customer"))['total'];
$jumlah_item       = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM item"))['total'];
$jumlah_transaksi  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi"))['total'];
?>

<style>
  .card-custom {
    border: none;
    border-radius: 16px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
  }

  .icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
  }

  .count-up {
    font-size: 28px;
    font-weight: bold;
  }
</style>

<div class="container-fluid px-4">
  <h4 class="mt-4">Dashboard</h4>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Selamat datang di Sistem Informasi Koperasi</li>
  </ol>

  <div class="row">
    <!-- Customer -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card card-custom bg-primary text-white shadow h-100">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="text-uppercase fw-bold small">Jumlah Customer</div>
            <div class="count-up" data-count="<?= $jumlah_customer ?>">0</div>
          </div>
          <div class="icon-circle">
            <i class="bi bi-people-fill"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Item -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card card-custom bg-success text-white shadow h-100">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="text-uppercase fw-bold small">Jumlah Item</div>
            <div class="count-up" data-count="<?= $jumlah_item ?>">0</div>
          </div>
          <div class="icon-circle">
            <i class="bi bi-box-seam"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Transaksi -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card card-custom bg-warning text-white shadow h-100">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="text-uppercase fw-bold small">Jumlah Transaksi</div>
            <div class="count-up" data-count="<?= $jumlah_transaksi ?>">0</div>
          </div>
          <div class="icon-circle">
            <i class="bi bi-cash-stack"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Animasi Count Up -->
<script>
  const counters = document.querySelectorAll('.count-up');
  counters.forEach(counter => {
    const updateCount = () => {
      const target = +counter.getAttribute('data-count');
      const count = +counter.innerText;
      const speed = 15;

      if (count < target) {
        counter.innerText = count + Math.ceil((target - count) / speed);
        setTimeout(updateCount, 30);
      } else {
        counter.innerText = target;
      }
    };
    updateCount();
  });
</script>

<?php include 'template/footer.php'; ?>
