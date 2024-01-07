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
    $nama_dokter = $_POST['nama_dokter'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['no_hp'];
    $idpoli = $_POST['id_poli'];
    $nip = $_POST['nip'];
    $sandi_dokter = $_POST['sandi_dokter'];

    $hashed_password = password_hash($sandi_dokter, PASSWORD_DEFAULT);

    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE dokter SET 
                                            nama_dokter = '$nama_dokter',
                                            alamat = '$alamat',
                                            no_hp = '$nohp',
                                            id_poli = '$idpoli',
                                            nip = '$nip',
                                            sandi_dokter = '$hashed_password'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO dokter (nama_dokter, alamat, no_hp, id_poli, nip, sandi_dokter) 
                                            VALUES (
                                            '$nama_dokter',
                                            '$alamat',
                                            '$nohp',
                                            '$idpoli',
                                            '$nip',
                                            '$hashed_password'
                                            )");
    }
    echo "<script> 
                document.location='index.php?page=dokter';
                </script>";
}
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM dokter WHERE id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
                document.location='index.php?page=dokter';
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
<center><h2>Dokter</h2></center>
<br>
<div class="container">

    <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <?php
        $nama_dokter = '';
        $alamat = '';
        $nohp = '';
        $idpoli = '';
        $nip = '';
        $sandi_dokter = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM dokter 
                    WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $nama_dokter = $row['nama_dokter'];
                $alamat = $row['alamat'];
                $nohp = $row['no_hp'];
                $idpoli = $row['id_poli'];
                $nip = $row['nip'];
                $sandi_dokter = $row['sandi_dokter'];
            }
            ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
        }
        ?>
        <div class="row">
            <label for="inputNama" class="form-label fw-bold">
                Nama
            </label>
            <div>
                <input type="text" class="form-control" name="nama_dokter" id="inputNama" placeholder="Nama"
                    value="<?php echo $nama_dokter ?>">
            </div>
        </div>
        <div class="row mt-1">
            <label for="inputAlamat" class="form-label fw-bold">
                Alamat
            </label>
            <div>
                <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat"
                    value="<?php echo $alamat ?>">
            </div>
        </div>
        <div class="row mt-1">
            <label for="inputNohp" class="form-label fw-bold">
                No HP
            </label>
            <div>
                <input type="text" class="form-control" name="no_hp" id="inputNohp" placeholder="No HP"
                    value="<?php echo $nohp ?>">
            </div>
        </div>
        <!-- <div class="row mt-1">
            <label for="inputIDpoli" class="form-label fw-bold">
                ID Poli
            </label>
            <div>
                <input type="text" class="form-control" name="id_poli" id="inputIDpoli" placeholder="ID Poli"
                    value="<?php echo $idpoli ?>">
            </div>
        </div> -->
        <div class="row mt-1">
            <label for="inputNIP" class="form-label fw-bold">
                NIP
            </label>
            <div>
                <input type="text" class="form-control" name="nip" id="inputNIP" placeholder="NIP"
                    value="<?php echo $nip ?>">
            </div>
        </div>
        <div class="row mt-1">
            <label for="inputHarga" class="form-label fw-bold">
                Nama Poli
            </label>
            <div>
                <select class="form-control" name="id_poli" id="inputIDpoli">
                    <?php
                    $ambil_poli = mysqli_query($mysqli, "SELECT * FROM poli");
                    while ($row_poli = mysqli_fetch_array($ambil_poli)) {
                        ?>
                        <option value="<?php echo $row_poli['id']; ?>" <?php if ($idpoli == $row_poli['id'])
                               echo 'selected="selected"'; ?>>
                            <?php echo $row_poli['nama_poli']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mt-1">
            <label for="inputSandi" class="form-label fw-bold">
                Sandi Dokter
            </label>
            <div>
                <input type="text" class="form-control" name="sandi_dokter" id="inputSandi"
                    placeholder="Sandi Dokter Dokter" value="<?php echo $sandi_dokter ?>">
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
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Dokter</th>
                <th scope="col">Alamat</th>
                <th scope="col">No. HP</th>
                <th scope="col">Nama Poli</th>
                <th scope="col">NIP</th>
                <th scope="col">sandi Dokter</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM dokter");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th scope="row">
                        <?php echo $no++ ?>
                    </th>
                    <td>
                        <?php echo $data['nama_dokter'] ?>
                    </td>
                    <td>
                        <?php echo $data['alamat'] ?>
                    </td>
                    <td>
                        <?php echo $data['no_hp'] ?>
                    </td>
                    <td>
                        <?php
                        $id_poli = $data['id_poli'];
                        $query_poli = mysqli_query($mysqli, "SELECT nama_poli FROM poli WHERE id = '$id_poli'");
                        $result_poli = mysqli_fetch_assoc($query_poli);
                        echo $result_poli['nama_poli'];
                        ?>
                    </td>
                    <td>
                        <?php echo $data['nip'] ?>
                    </td>
                    <td>
                        <?php echo $data['sandi_dokter'] ?>
                    </td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3"
                            href="index.php?page=dokter&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3"
                            href="index.php?page=dokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
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