<?php
session_start();

include_once("../koneksi.php");

// Inisialisasi variabel $id_pasien dan $namaDokter
$id_pasien = $namaDokter = $no_antrian = "";

// Periksa apakah parameter id_pasien ada dalam URL
if (isset($_GET['id_pasien'])) {
    $_SESSION['id_pasien'] = $_GET['id_pasien'];
}

// Periksa apakah parameter id_jadwal ada dalam URL
if (isset($_GET['id_jadwal'])) {
    $_SESSION['id_jadwal'] = $_GET['id_jadwal'];
}

if (isset($_SESSION['id_pasien'])) {

} else {
    // Variabel $_SESSION['id_pasien'] belum tersimpan
    echo "id_pasien belum tersimpan";
}

if (isset($_SESSION['id_jadwal'])) {

} else {
    // Variabel $_SESSION['id_jadwal'] belum tersimpan
    echo "id_jadwal belum tersimpan";
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_keluhan'])) {
    if (isset($_SESSION['id_pasien']) && isset($_SESSION['id_jadwal'])) {
        $id_pasien = $_SESSION['id_pasien'];
        $id_jadwal = $_SESSION['id_jadwal'];
        $keluhan = $_POST['keluhan'];

        // Validasi nilai id_pasien dan id_jadwal
        $queryCheckPasien = "SELECT id FROM pasien WHERE id = ?";
        $stmtCheckPasien = $mysqli->prepare($queryCheckPasien);
        if ($stmtCheckPasien === false) {
            die("Error: " . htmlspecialchars($mysqli->error));
        }

        $stmtCheckPasien->bind_param("i", $id_pasien);
        $stmtCheckPasien->execute();
        $resultCheckPasien = $stmtCheckPasien->get_result();

        $queryCheckJadwal = "SELECT id FROM jadwal_periksa WHERE id = ?";
        $stmtCheckJadwal = $mysqli->prepare($queryCheckJadwal);
        if ($stmtCheckJadwal === false) {
            die("Error: " . htmlspecialchars($mysqli->error));
        }

        $stmtCheckJadwal->bind_param("i", $id_jadwal);
        $stmtCheckJadwal->execute();
        $resultCheckJadwal = $stmtCheckJadwal->get_result();

        if ($resultCheckPasien->num_rows > 0 && $resultCheckJadwal->num_rows > 0) {
            // Query untuk mendapatkan jumlah antrian pada hari tersebut
            $queryAntrian = "SELECT COUNT(*) AS total_antrian FROM daftar_poli WHERE id_jadwal = ?";
            $stmtAntrian = $mysqli->prepare($queryAntrian);
            if ($stmtAntrian === false) {
                die("Error: " . htmlspecialchars($mysqli->error));
            }

            $stmtAntrian->bind_param("i", $id_jadwal);
            $stmtAntrian->execute();
            $resultAntrian = $stmtAntrian->get_result();

            if ($resultAntrian->num_rows > 0) {
                $rowAntrian = $resultAntrian->fetch_assoc();
                $no_antrian = $rowAntrian['total_antrian'] + 1; // Nomor antrian baru
            } else {
                $no_antrian = 1; // Jika tidak ada antrian, nomor antrian dimulai dari 1
            }

            // Query untuk menyimpan informasi ke dalam tabel daftar_poli beserta nomor antrian
            $query = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            if ($stmt === false) {
                die("Error: " . htmlspecialchars($mysqli->error));
            }

            $stmt->bind_param("iisi", $id_pasien, $id_jadwal, $keluhan, $no_antrian);
            if ($stmt->execute()) {
                echo '<script>alert("Keluhan telah disimpan. Nomor Antrian Anda: ' . $no_antrian . '");</script>';
            } else {
                echo '<script>alert("Terjadi kesalahan: ' . $stmt->error . '");</script>';
            }
            
        } else {
            echo "ID Pasien atau ID Jadwal tidak valid.";
        }
    } else {
        echo "ID Pasien atau ID Jadwal tidak tersedia.";
    }
} else {
    if (isset($_SESSION['id_pasien'])) {
        $id_pasien = $_SESSION['id_pasien'];

        // Query untuk mendapatkan nama dokter
        $queryDokter = "SELECT nama_dokter FROM dokter WHERE id = ?";
        $stmtDokter = $mysqli->prepare($queryDokter);
        if ($stmtDokter === false) {
            die("Error: " . htmlspecialchars($mysqli->error));
        }

        $stmtDokter->bind_param("i", $_SESSION['id_dokter']);
        $stmtDokter->execute();
        $resultDokter = $stmtDokter->get_result();

        if ($resultDokter->num_rows > 0) {
            $rowDokter = $resultDokter->fetch_assoc();
            $namaDokter = $rowDokter['nama_dokter']; // Simpan nama dokter dalam variabel
        } else {
            $namaDokter = 'Nama Dokter Tidak Tersedia';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">RS Wahyu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
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
                    if (isset($_SESSION['no_rm'])) {
                        //menu master jika user sudah login
                        ?>
                        <!-- Tambahkan menu lain jika diperlukan -->
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
            </div>
        </div>
    </nav>

    <title>Daftar Poli Poliklinik</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
        <div class="container mt-5">
        <h2>Form Keluhan</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan anda</label>
                <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" href="index.php" submit_keluhan">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>