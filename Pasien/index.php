<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['id_pasien'])) {
    $_SESSION['id_pasien'] = $_GET['id_pasien'];
}

// Pastikan bahwa id_pasien tersedia dalam $_GET sebelum menetapkannya ke $_SESSION['id_pasien']


include_once("../koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Informasi Poliklinik</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <?php
                    if (isset($_SESSION['nama_pasien'])) {
                        //menu master jika user sudah login
                        ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Menu</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="daftar_poli.php?page=dokter">Mendaftar ke Poli</a>
                                    <!-- <a class="dropdown-item" href="obat.php?page=obat">Obat</a>
                                    <a class="dropdown-item" href="admin.php?page=admin">Admin</a>
                                    <a class="dropdown-item" href="poli.php?page=poli">Poli</a>
                                    <a class="dropdown-item" href="pasien.php?page=pasien">Pasien</a> -->
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                if (isset($_SESSION['nama_pasien'])) {
                    // Jika pengguna sudah login, tampilkan tombol "Logout"
                    ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Logout.php">Logout (
                                <?php echo $_SESSION['nama_pasien'] ?>)
                            </a>
                        </li>
                    </ul>
                    <?php
                } else {
                    // Jika pengguna belum login, tampilkan tombol "Login" dan "Register"
                    ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=loginPasien">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=registerPasien">Registrasi Pasien</a>
                        </li>
                    </ul>
                    <?php
                }
                ?>
                <!-- <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=registerAdmin">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=loginAdmin">Login</a>
                </li>
            </ul> -->
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <main role="main" class="container">
        <?php
        if (isset($_GET['page'])) {
            include($_GET['page'] . ".php");
        } else {
            echo "<br><h2>Selamat Datang di Sistem Informasi Poliklinik";

            if (isset($_SESSION['nama_pasien'])) {
                //jika sudah login tampilkan username
                echo ", " . $_SESSION['nama_pasien'] . "</h2><hr>";
            } else {
                echo "</h2><hr>Silakan Login untuk menggunakan sistem pendaftaran poli dengan memasukkan Nomor Rekam Medis. Jika belum memiliki Nomor Rekam Medis silakan registrasi terlebih dahulu.";
            }
        }
        ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
