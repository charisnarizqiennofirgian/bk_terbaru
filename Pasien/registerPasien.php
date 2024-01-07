<?php
// Buat koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "poli");

if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Pasien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
        }

        .container {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 8px;
            margin-top: 50px;
        }

        .card-header {
            background-color: #1877f2;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 32px;
            padding: 20px 0;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #1877f2;
            border-color: #1877f2;
        }

        .btn-primary:hover {
            background-color: #3b5998;
            border-color: #3b5998;
        }

        .text-center a {
            color: #1877f2;
            font-weight: bold;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Buat Akun</div>
                    <div class="card-body">
                        <form method="POST" action="index.php?page=registerPasien">
                            <div class="form-group">
                                <label for="nama_pasien" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="no_ktp" class="form-label">Nomor KTP</label>
                                <input type="text" class="form-control" id="no_ktp" name="no_ktp" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                            </div>
                        </form>
                        <?php
                   if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $mysqli = new mysqli("localhost", "root", "", "poli");

                        if ($mysqli->connect_error) {
                            die("Koneksi database gagal: " . $mysqli->connect_error);
                        }

                        $namapasien = $_POST['nama_pasien'];
                        $alamat = $_POST['alamat'];
                        $no_ktp = $_POST['no_ktp'];
                        $no_hp = $_POST['no_hp'];

                        $check_query = "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'";
                        $result = $mysqli->query($check_query);

                        if ($result->num_rows > 0) {
                            echo "Nomor KTP sudah terdaftar. Mohon gunakan nomor KTP yang lain.";
                        } else {
                            $tahun_pendaftaran = date("Y");
                            $bulan_pendaftaran = date("m");

                            $result = $mysqli->query("SELECT MAX(id) as max_id FROM pasien");
                            $row = $result->fetch_assoc();
                            $id_di_database = $row['max_id'] + 1;

                            $no_rm = $tahun_pendaftaran . $bulan_pendaftaran . $id_di_database;

                            $sql = "INSERT INTO pasien (nama_pasien, alamat, no_ktp, no_hp, no_rm) 
                                    VALUES ('$namapasien', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";

                            if ($mysqli->query($sql) === TRUE) {
                                echo "Pendaftaran pasien berhasil. Nomor Rekam Medis: " . $no_rm;
                            } else {
                                echo "Error: " . $sql . "<br>" . $mysqli->error;
                            }
                        }

                            $mysqli->close();
                        }
                        ?>
                        <div class="text-center">
                            <p class="mt-3">Sudah Punya Akun? <a href="index.php?page=loginPasien">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>




 