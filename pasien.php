<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: unauthorized.php");
    exit;
}

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
                    <a href="index.php" class="logo">
                        <h1>MyCare</h1>
                    </a>
                    <ul class="nav">
                      <li><a href="?page=dokter/dokter" class="active">Dokter</a></li>
                      <li><a href="?page=obat/obat" class="active">Obat</a></li>
                      <li><a href="?page=pasien/pasien" class="active">Pasien</a></li>
                      <li><a href="?page=poli/poli" class="active">Poli</a></li>
                      <li><a href="logout.php" class="active">Logout</a></li>
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
                    <h2>Selamat Datang Admin</h2>
                </div>
            </div>
    <?php
    if (isset($_GET['page'])) {
      $page = htmlentities($_GET['page']);

      if (file_exists($page . ".php")) {
        include($page . ".php");
      } else {
        echo "<p class='text-center'>Page Not Found</p>";
      }
    }
    ?>
        </div>
    </div>
</div>

</body>

</html>
