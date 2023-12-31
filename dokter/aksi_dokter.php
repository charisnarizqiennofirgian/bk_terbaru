<?php
include("C:/xampp/htdocs/poliklinik/db/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $query = "INSERT INTO dokter(nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')";
    if ($mysqli->query($query)) {
        header("Location: ?page=dokter/dokter");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM dokter WHERE id='$id'";
    if ($mysqli->query($query)) {
        header("Location: ?page=dokter/dokter");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
