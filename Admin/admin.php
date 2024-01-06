<?php
include_once("../koneksi.php");


if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=loginAdmin");
    exit;
}

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $sandi_adm = $_POST['sandi_adm'];

    // Menambahkan fungsi password_hash() untuk menghash kata sandi sebelum disimpan
    $hashed_password = password_hash($sandi_adm, PASSWORD_DEFAULT);

    if (isset($_POST['id'])) {
        // Jika ID sudah ada, gunakan UPDATE
        $ubah = mysqli_query($mysqli, "UPDATE user SET 
                                            username = '$username',
                                            sandi_adm = '$hashed_password'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
    } else {
        // Jika tidak ada ID, gunakan INSERT
        $tambah = mysqli_query($mysqli, "INSERT INTO user (username, sandi_adm) 
                                            VALUES (
                                            '$username',
                                            '$hashed_password'
                                            )");
    }
    echo "<script> 
                document.location='index.php?page=admin';
                </script>";
}
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM user WHERE id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
                document.location='index.php?page=admin';
                </script>";
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Rumah Sakit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
<center><h2>Admin</h2></center>
<br>
<div class="container">
    <!--Form Input Data-->

    <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <?php
        $username = '';
        $sandi_adm = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM user 
                    WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $username = $row['username'];
                $sandi_adm = $row['sandi_adm'];
            }
            ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
        }
        ?>
        <div class="row">
            <label for="inputUsername" class="form-label fw-bold">
                Username
            </label>
            <div>
                <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Username"
                    value="<?php echo $username ?>">
            </div>
        </div>
        <div class="row mt-1">
            <label for="inputSandiadm" class="form-label fw-bold">
                Sandi Admin
            </label>
            <div>
                <input type="text" class="form-control" name="sandi_adm" id="inputSandiadm" placeholder="Sandi Admin"
                    value="<?php echo $sandi_adm ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class=col>
                <button type="submit" class="btn btn-primary rounded-pill px-3 mt-auto" name="simpan">Simpan</button>
            </div>
        </div>
    </form>
    <br>
    <br>
    <!-- Table-->
    <table class="table table-hover">
        <!--thead atau baris judul-->
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Sandi Admin</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <!--tbody berisi isi tabel sesuai dengan judul atau head-->
        <tbody>
            <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM user");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th scope="row">
                        <?php echo $no++ ?>
                    </th>
                    <td>
                        <?php echo $data['username'] ?>
                    </td>
                    <td>
                        <?php echo $data['sandi_adm'] ?>
                    </td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3"
                            href="index.php?page=admin&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3"
                            href="index.php?page=admin&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <button class="btn btn-dark" onclick="window.location.href='index.php'">Kembali</button>
    <script>
        function showNotification() {
            alert('Data berhasil disimpan!'); 
        }
    </script>
</body>