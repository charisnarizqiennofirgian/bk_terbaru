<?php
if (!isset($_SESSION)) {
    session_start();
}

// Sisipkan file koneksi.php
include_once("../koneksi.php");

// Mendapatkan informasi pasien dari database, misalnya berdasarkan id_pasien
if (isset($_GET['id_pasien'])) {
    $id_pasien = $_GET['id_pasien'];

    // Query untuk mendapatkan informasi pasien
    $query_pasien = "SELECT * FROM pasien WHERE id = '$id_pasien'";
    $result_pasien = $mysqli->query($query_pasien);

    if ($result_pasien) {
        // Mendapatkan data pasien jika ada
        $data_pasien = $result_pasien->fetch_assoc();

        // Query untuk mendapatkan riwayat periksa pasien
        $query_riwayat = "SELECT * FROM periksa WHERE id = '$id_pasien'";
        $result_riwayat = $mysqli->query($query_riwayat);
    } else {
        // Handle kesalahan jika query pasien gagal dieksekusi
        echo "Error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemeriksaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                    if (isset($_SESSION['nip'])) {
                        //menu master jika user sudah login
                        ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Menu</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="ubah_profil.php?page=ubah_profil">Ubah Profil Dokter</a>
                                    <a class="dropdown-item" href="atur_jadwal.php?page=atur_jadwal">Atur jadwal poli</a>
                                    <a class="dropdown-item" href="jadwal_periksa.php?page=jadwal_periksa">Jadwal Saya</a>
                                    <a class="dropdown-item" href="riwayat_pasien.php?page=riwayat_pasien">Cari Riwayat Pasien</a>
                                    <!-- <a class="dropdown-item" href="cari_pasien.php?page=pasien">Cari Pasien</a> -->
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                if (isset($_SESSION['nip'])) {
                    // Jika pengguna sudah login, tampilkan tombol "Logout"
                    ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Logout.php">Logout
                                (
                                <?php echo isset($_SESSION['nama_dokter']) ? $_SESSION['nama_dokter'] : $_SESSION['nip'] ?>)
                            </a>
                        </li>
                    </ul>
                    <?php
                } else {
                    // Jika pengguna belum login, tampilkan tombol "Login" dan "Register"
                    ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=loginDokter">Login</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="index.php?page=registerDokter">Registrasi Pasien</a>
                        </li> -->
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
    <div class="container mt-4">
        <h1>Riwayat Pemeriksaan</h1>
        <?php
        if (isset($data_pasien)) {
        ?>
            <!-- Informasi Pasien -->
            <h3>Informasi Pasien:</h3>
            <p>ID Pasien: <?php echo $data_pasien['id_pasien']; ?></p>
            <p>Nama Pasien: <?php echo $data_pasien['nama_pasien']; ?></p>
            <p>Alamat: <?php echo $data_pasien['alamat']; ?></p>

            <!-- Riwayat Periksa -->
            <h3>Riwayat Periksa:</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal Periksa</th>
                        <th>Catatan</th>
                        <th>Biaya Periksa</th>
                        <th>Status Periksa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_riwayat) {
                        // Menampilkan data riwayat periksa
                        while ($row_riwayat = $result_riwayat->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row_riwayat['tgl_periksa'] . "</td>";
                            echo "<td>" . $row_riwayat['catatan'] . "</td>";
                            echo "<td>Rp " . $row_riwayat['biaya_periksa'] . "</td>";
                            echo "<td>" . $row_riwayat['status_periksa'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Handle kesalahan jika query riwayat pemeriksaan gagal dieksekusi
                        echo "Error: " . $mysqli->error;
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "Informasi pasien tidak ditemukan.";
        }
        ?>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
