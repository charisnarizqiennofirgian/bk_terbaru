<?php
// Buat koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "poli");

if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center" style="font-weight: bold; font-size: 32px;">Registrasi Pasien</div>

                <!-- ... Bagian lain dari HTML Anda ... -->
                <div class="card-body">
                    <form method="POST" action="index.php?page=registerPasien">
                        <div class="container">
                            <h2>Form Pendaftaran Pasien</h2>
                            <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama">Nama Pasien:</label>
                                    <input class="form-control" type="text" id="nama_pasien" name="nama_pasien"
                                        required><br><br>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <input class="form-control" type="text" id="alamat" name="alamat" required><br><br>
                                </div>
                                <div class="form-group">
                                    <label for="no_ktp">Nomor KTP:</label>
                                    <input class="form-control" type="text" id="no_ktp" name="no_ktp" required><br><br>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">Nomor HP:</label>
                                    <input class="form-control" type="text" id="no_hp" name="no_hp" required><br><br>
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary btn-block" name="Daftar" value="Daftar">
                                </div>
                            </form>
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

                        // Periksa apakah nomor KTP sudah terdaftar sebelumnya
                        $check_query = "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'";
                        $result = $mysqli->query($check_query);

                        if ($result->num_rows > 0) {
                            // Jika nomor KTP sudah terdaftar, tampilkan pesan kesalahan
                            echo "Nomor KTP sudah terdaftar. Mohon gunakan nomor KTP yang lain.";
                        } else {
                            // Nomor KTP belum terdaftar, lakukan proses pendaftaran pasien baru
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
</div>
<?php
// Tutup koneksi ke database
?>