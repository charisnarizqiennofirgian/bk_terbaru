<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
        exit;
    } elseif ($_SESSION['role'] == 'dokter') {
        header("Location: doctor.php");
        exit;
    } elseif ($_SESSION['role'] == 'user') {
        header("Location: pasien.php"); 
        exit;
    }
}

require_once("db/koneksi.php");
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Poliklinik</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  </head>

<body>

  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <div href="index.php" class="logo">
                        <h1>MyCare</h1>
                    </div>
                    <ul class="nav">
                      <li><a href="index.php" class="active">Sistem temu janji dokter</a></li>
                  </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
  </header>

<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="caption header-text">
                    <h6>Selamat Datang di MyCare Poliklinik</h6>
                    <h2>Mitra Kesehatan Tepercaya Anda</h2>
                    <p>Poliklinik MyCare menyediakan layanan kesehatan terbaik </p>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="right-image">
                    <img src="assets/images/banner.jpg" alt="Poliklinik MyCare">
                </div>
            </div>
        </div>`
    </div>
</div>


  <div class="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <a href="login.php?role=pasien">
            <div class="item">
              <div class="image">
                <img src="assets/images/featured-02.png" alt="" style="max-width: 44px;">
              </div>
              <h4 class="btn">Login sebagai Pasien</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="login.php?role=dokter">
            <div class="item">
              <div class="image">
                <img src="assets/images/featured-02.png" alt="" style="max-width: 44px;">
              </div>
              <h4 class="btn">Login sebagai Dokter</h4>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="login.php?role=dokter">
            <div class="item">
              <div class="image">
                <img src="assets/images/featured-02.png" alt="" style="max-width: 44px;">
              </div>
              <h4 class="btn">Login sebagai Admin</h4>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2023 Wahdan Najmil Fata</p>
      </div>
    </div>
  </footer>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

  </body>
</html>