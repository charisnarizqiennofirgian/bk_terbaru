<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = $_POST['nip'];
    // $nama_dokter = $_POST['nama_dokter'];
    $sandi_dokter = $_POST['sandi_dokter'];

    $query = "SELECT * FROM dokter WHERE nip = '$nip'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($sandi_dokter, $row['sandi_dokter'])) {
            $_SESSION['nip'] = $nip;
            $_SESSION['nama_dokter'] = $row['nama_dokter']; // Simpan nama_dokter di session
            header("Location: index.php");
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Dokter tidak ditemukan";
    }
    
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center" style="font-weight: bold; font-size: 32px;">Login Dokter</div>
                <div class="card-body">
                    <form method="POST" action="index.php?page=loginDokter">
                        <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        }
                        ?>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" class="form-control" required placeholder="Masukkan NIP anda">
                        </div>
                        <div class="form-group" style="padding-bottom: 20px">
                            <label for="sandi_dokter">Sandi Dokter</label>
                            <input type="password" name="sandi_dokter" class="form-control" required
                                placeholder="Masukkan sandi dokter anda">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>