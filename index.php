<?php
session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
  // Jika pengguna belum login, alihkan mereka ke halaman login
  header("Location: login.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POLIKLINIK</title>

  <!-- My CSS -->
  <link rel="stylesheet" href="assets/css/footer.css">
  <link rel="stylesheet" href="assets/css/index.css">
  <!-- Bootstrap 5.3.2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- Include DataTables CSS and JS -->
  <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

  <!-- Include DataTables Buttons CSS and JS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>



  <style>
    body {
      padding-top: 30px;
      padding-bottom: 30px;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-scroll fixed-top shadow-0">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">MyCare</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="index.php?page=dokter/dokter">Dokter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="index.php?page=pasien/pasien">Pasien</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="index.php?page=obat/obat">Obat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="index.php?page=periksa/periksa">Periksa</a>
          </li>
          <a type="button" class="btn btn-outline-danger fw-semibold ms-3" href="logout.php">Logout</a>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->



  <main class="container mt-5">
    <?php
    // Menggunakan require_once untuk menggabungkan file koneksi.php
    require_once("inc/koneksi.php");

    if (isset($_GET['page'])) {
      // Menggunakan htmlentities() untuk mencegah potensi serangan injeksi
      $page = htmlentities($_GET['page']);

      // Memeriksa apakah file yang diminta ada sebelum menggabungkannya
      if (file_exists($page . ".php")) {
    ?>
        <h2><?php $page; ?></h2>
    <?php
        // Menggabungkan file yang diminta
        include($page . ".php");
      } else {
        echo "<h2 class='text-center'>Halaman Tidak Ditemukan</h2>";
      }
    } else {
      echo "<h2 class='text-center'>Selamat Datang di Sistem Informasi Poliklinik</h2>";
      echo "<div id='carouselExampleSlidesOnly' class='carousel slide mt-5' data-bs-ride='carousel'>
            <div class='carousel-inner'>
              <div class='carousel-item active'>
                <img src='assets/tes.png' class='d-block w-100' alt='...'>
              </div>
            </div>
          </div>";
    }
    ?>
  </main>

  <!-- copyright -->
  <footer class="footer">
    <div class="waves">
      <div class="wave" id="wave1"></div>
      <div class="wave" id="wave2"></div>
      <div class="wave" id="wave3"></div>
      <div class="wave" id="wave4"></div>
    </div>
    <ul class="social-icon">
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-facebook"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-twitter"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-linkedin"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-instagram"></ion-icon>
        </a></li>
    </ul>
    <p>&copy;2023 Poliklinik-Reffrains | All Rights Reserved</p>
  </footer>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <!-- Bootstrap 5.3.2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>