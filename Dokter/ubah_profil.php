<?php
session_start();

if (!isset($_SESSION['nip'])) {
    header("Location: index.php?page=loginDokter");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "poli");

    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    $nama_dokter = $_POST['nama_dokter'];
    $id_poli = $_POST['id_poli'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $nip = $_POST['nip'];
    $sandi_dokter = $_POST['sandi_dokter'];

    $hashed_password = password_hash($sandi_dokter, PASSWORD_DEFAULT);

    // Update data dokter ke dalam tabel
    $sql = "UPDATE dokter SET 
            nama_dokter = '$nama_dokter',
            id_poli = '$id_poli',
            alamat = '$alamat',
            no_hp = '$no_hp',
            sandi_dokter = '$hashed_password'
            WHERE nip = '$nip'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Data dokter berhasil diperbarui");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Tutup koneksi ke database
}

$nip = $_SESSION['nip'];
$conn = new mysqli("localhost", "root", "", "poli");

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM dokter WHERE nip = '$nip'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data dokter tidak ditemukan";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Profil Dokter</title>
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
                                    <a class="dropdown-item" href="cek_riwayat.php?page=poli">Cari Riwayat Pasien</a>
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
                        <h3 class="text-center">Ubah Profil Dokter</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter"
                                    value="<?php echo $row['nama_dokter']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="id_poli" class="form-label">ID Poli</label>
                                <input type="text" class="form-control" id="id_poli" name="id_poli"
                                    value="<?php echo $row['id_poli']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="<?php echo $row['alamat']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="<?php echo $row['no_hp']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip"
                                    value="<?php echo $row['nip']; ?>" disabled>
                                <input type="hidden" name="nip" value="<?php echo $row['nip']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sandi_dokter" class="form-label">Sandi Dokter</label>
                                <input type="password" class="form-control" id="sandi_dokter" name="sandi_dokter"
                                    value="<?php echo $row['sandi_dokter']; ?>">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>