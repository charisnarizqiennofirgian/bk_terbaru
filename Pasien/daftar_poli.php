<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['nama_pasien'])) {
    // Jika pengguna sudah login, tampilkan tombol "Logout"
    header("Location: index.php?page=loginPasien");
    exit;
}


// Pastikan bahwa id_pasien tersedia dalam $_GET sebelum menetapkannya ke $_SESSION['id_pasien']
// Di halaman daftar_poli.php atau index.php
if (isset($_GET['id_pasien'])) {
    $_SESSION['id_pasien'] = $_GET['id_pasien'];
}
if (isset($_GET['nama_dokter'])) {
    $_SESSION['nama_dokter'] = $_GET['nama_dokter'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Informasi Poliklinik</a>
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
        <h2>Daftar Poli Poliklinik</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Jam Mulai</th>
                    <th scope="col">Jam Selesai</th>
                    <th scope="col">Daftar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $mysqli = new mysqli("localhost", "root", "", "poli"); // Ganti dengan informasi koneksi database yang benar
                
                if ($mysqli->connect_error) {
                    die("Koneksi database gagal: " . $mysqli->connect_error);
                }

                $query = "SELECT jp.*, d.nama_dokter
                          FROM jadwal_periksa jp
                          INNER JOIN dokter d ON jp.id_dokter = d.id";

                $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $count = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_dokter']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['hari']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jam_mulai']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jam_selesai']) . "</td>";
                
                        // Tautan Daftar dengan parameter id
                        echo "<td><a href='proses_form_keluhan.php?id_jadwal=" . $row['id'] . "&id_pasien=" . (isset($_SESSION['id_pasien']) ? $_SESSION['id_pasien'] : '') . "' class='btn btn-primary'>Daftar</a></td>";
                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada jadwal periksa</td></tr>";
                }

                $stmt->close();
                $mysqli->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>