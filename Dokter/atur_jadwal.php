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

// Proses form jika data dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    // Periksa apakah $id_dokter memiliki nilai sebelum menjalankan query
    if ($id_dokter !== null) {
        // Query untuk menyimpan jadwal periksa ke dalam tabel database
        $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES ('$id_dokter', '$hari', '$jam_mulai', '$jam_selesai')";

        if ($mysqli->query($query)) {
            echo '<script>alert("Jadwal periksa berhasil disimpan.");</script>';
        } else {
            echo '<script>alert("Error: ' . $query . '\n' . $mysqli->error . '");</script>';
        }
    } else {
        echo "ID Dokter tidak tersedia.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Jadwal Periksa</title>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Atur Jadwal Periksa</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="hari" class="form-label">Hari</label>
                                <select class="form-control" name="hari">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" name="jam_mulai" required>
                            </div>
                            <div class="mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" name="jam_selesai" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <!--thead atau baris judul-->
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jam Mulai</th>
                                    <th scope="col">Jam Selesai</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <!--tbody berisi isi tabel sesuai dengan judul atau head-->
                            <tbody>
                                <?php
                                // Lakukan query untuk mengambil jadwal periksa dokter yang sedang login
                                $query_jadwal = "SELECT * FROM jadwal_periksa WHERE id_dokter = '$id_dokter'";
                                $result_jadwal = $mysqli->query($query_jadwal);

                                if (!$result_jadwal) {
                                    die("Query error: " . $mysqli->error);
                                }

                                if ($result_jadwal->num_rows > 0) {
                                    $count = 1;
                                    while ($row_jadwal = $result_jadwal->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<th scope="row">' . $count . '</th>';
                                        echo '<td>' . $row_jadwal['hari'] . '</td>';
                                        echo '<td>' . $row_jadwal['jam_mulai'] . '</td>';
                                        echo '<td>' . $row_jadwal['jam_selesai'] . '</td>';
                                        echo '<td>';
                                        echo '<form method="post" action="hapus_jadwal.php">';
                                        echo '<input type="hidden" name="id" value="' . $row_jadwal['id'] . '">';
                                        echo '<button type="submit" name="delete_jadwal" class="btn btn-danger btn-sm">Hapus</button>';
                                        echo '</form>';
                                        echo '</td>';
                                        echo '</tr>';
                                        $count++;
                                        
                                    }
                                } else {
                                    echo '<tr><td colspan="5">Tidak ada jadwal periksa yang tersedia</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>