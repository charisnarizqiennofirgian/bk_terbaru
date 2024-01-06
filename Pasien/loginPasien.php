<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_rm = $_POST['no_rm'];
    // Validasi nomor rekam medis jika diperlukan

    $query = "SELECT * FROM pasien WHERE no_rm = '$no_rm'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Membandingkan nomor rekam medis dari input dengan database
        if ($no_rm === $row['no_rm']) {
            $_SESSION['nama_pasien'] = $row['nama_pasien'];
            $_SESSION['id_pasien'] = $row['id_pasien']; // Menyimpan ID pasien ke dalam session
            $_SESSION['id_pasien'] = $row['id']; // Menyimpan ID pasien ke dalam session

            header("Location: index.php");
            exit;
        } else {
            $error = "Nomor Rekam Medis salah";
        }
        
    } else {
        $error = "Nomor Rekam Medis Tidak ditemukan";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center" style="font-weight: bold; font-size: 32px;">Login Pasien</div>
                <div class="card-body">
                    <form method="POST" action="index.php?page=loginPasien">
                        <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        }
                        ?>
                        <div class="form-group" style="padding-bottom: 20px">
                            <label for="no_rm">Nomor Rekam Medis</label>
                            <input type="text" name="no_rm" class="form-control" required
                                placeholder="Masukkan Nomor Rekam Medis anda">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Daftar Poli</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>