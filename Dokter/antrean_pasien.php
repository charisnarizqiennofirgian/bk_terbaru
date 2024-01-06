<?php
// Lakukan pengecekan koneksi ke database dan set session jika belum ada
if (!isset($_SESSION)) {
    session_start();
}

// Sisipkan file koneksi.php
include_once("../koneksi.php");

// Inisialisasi variabel $id_dokter
$id_dokter = null;

// Lakukan query untuk mendapatkan data dokter berdasarkan NIP yang sudah login
if (isset($_SESSION['nip'])) {
    $nip = $_SESSION['nip'];
    $query = "SELECT id FROM dokter WHERE nip = '$nip'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    // Ambil data dokter
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Tetapkan nilai $id_dokter jika data dokter ditemukan
        $id_dokter = $row['id'];
    } else {
        echo "Data dokter tidak ditemukan";
        exit();
    }
}

// Query untuk mengambil daftar pasien yang mendaftar pada jadwal dokter yang sedang login
$query_daftar_pasien = "SELECT dp.id, p.nama_pasien, dp.keluhan, dp.no_antrian, dp.status_periksa
                        FROM daftar_poli dp 
                        JOIN pasien p ON dp.id_pasien = p.id 
                        WHERE dp.id_jadwal IN (SELECT id FROM jadwal_periksa WHERE id_dokter = '$id_dokter')
                        ORDER BY dp.no_antrian";

$result_daftar_pasien = $mysqli->query($query_daftar_pasien);

if (!$result_daftar_pasien) {
    die("Query error: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien Dokter</title>
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
                                    <a class="dropdown-item" href="jadwal_periksa.php?page=antrean_pasien">Jadwal Saya</a>
                                    <a class="dropdown-item" href="riwayat_pasien.php?page=riwayat_pasien">Cari Riwayat Pasien</a>                                </li>
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
                                (<?php echo isset($_SESSION['nama_dokter']) ? $_SESSION['nama_dokter'] : $_SESSION['nip'] ?>)
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Daftar Pasien Dokter</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($result_daftar_pasien->num_rows > 0) {
                            echo '<table class="table table-hover">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th scope="col">Nama Pasien</th>';
                            echo '<th scope="col">Keluhan</th>';
                            echo '<th scope="col">Nomor Antrian</th>';
                            echo '<th scope="col">Tindakan</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            while ($row_daftar_pasien = $result_daftar_pasien->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row_daftar_pasien['nama_pasien'] . '</td>';
                                echo '<td>' . $row_daftar_pasien['keluhan'] . '</td>';
                                echo '<td>' . $row_daftar_pasien['no_antrian'] . '</td>';

                                // Lakukan query untuk memeriksa apakah pasien sudah diperiksa atau belum
                                $query_cek_periksa = "SELECT * FROM periksa WHERE id_daftar_poli = " . $row_daftar_pasien['id'];
                                $result_cek_periksa = $mysqli->query($query_cek_periksa);

                                if (!$result_cek_periksa) {
                                    die("Query error: " . $mysqli->error);
                                }

                                // Menambahkan tombol Edit atau Periksa Pasien berdasarkan status periksa
                                echo '<td>';
                                if ($result_cek_periksa->num_rows > 0) {
                                    // Data pasien sudah ada di tabel periksa, maka tombol Edit aktif dan tombol Periksa Pasien nonaktif
                                    echo "<a href='edit_periksa.php?id=" . $row_daftar_pasien['id'] . "&nama_pasien=" . $row_daftar_pasien['nama_pasien'] . "&keluhan=" . $row_daftar_pasien['keluhan'] . "&no_antrian=" . $row_daftar_pasien['no_antrian'] . "' class='btn btn-warning'>Edit</a>";
                                    echo "<button class='btn btn-primary' disabled>Periksa Pasien</button>";

                                } else {
                                    // Data pasien belum ada di tabel periksa, maka tombol Edit nonaktif dan tombol Periksa Pasien aktif
                                    echo "<button class='btn btn-warning' disabled>Edit</button>";
                                    echo "<a href='periksa_pasien.php?id=" . $row_daftar_pasien['id'] . "&nama_pasien=" . $row_daftar_pasien['nama_pasien'] . "&keluhan=" . $row_daftar_pasien['keluhan'] . "&no_antrian=" . $row_daftar_pasien['no_antrian'] . "' class='btn btn-primary'>Periksa Pasien</a>";
                                }
                                echo '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p>Tidak ada pasien yang terdaftar</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>