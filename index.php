<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

require_once("db/koneksi.php");

// Check if user is authenticated
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}

$username = htmlspecialchars($_SESSION['username']);

if (isset($_SESSION['role'])) {
  $role = $_SESSION['role'];
  switch ($role) {
    case 'admin':
      header("Location: admin.php");
      exit;
      break;

    case 'dokter':
      header("Location: doctor.php");
      exit;
      break;

    default:
      break;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MY CARE POLYCLINIC</title>
  <link rel="stylesheet" href="assets/css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
  <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body>

  <div class="sidebar">
    <a class="navbar-brand fw-bold" href="index.php" style="font-size: 24px;">
      <i class="fas fa-hospital fa-2x"></i>
      MyCare
    </a>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link fw-semibold" href="index.php?page=periksa/periksa">Periksa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link fw-semibold" href="index.php?page=periksa/periksa">Jadwal Poliklinik</a>
      </li>
      <li class="nav-item">
        <a class="btn font-weight-bold ml-md-3 m-4" href="logout.php">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </div>
  <div class="content">
    <h2>Selamat Datang, <?= $username ?>!</h2>
    <p>Terima kasih telah menggunakan layanan MyCare Polyclinic. Kami siap memberikan pelayanan kesehatan terbaik untuk Anda.</p>

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

  <script>
    $(document).ready(function () {
      $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
          $('.navbar').addClass('scrolled');
        } else {
          $('.navbar').removeClass('scrolled');
        }
      });
    });
  </script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
