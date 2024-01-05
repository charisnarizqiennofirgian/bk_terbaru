<?php
include("C:/xampp/htdocs/poliklinik/db/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];

    $query = "INSERT INTO pasien(nama, no_ktp, no_hp) VALUES ('$nama', '$no_ktp', '$no_hp')";
    if ($mysqli->query($query)) {
        header("Location: index.php?page=pasien/pasien");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM pasien WHERE id='$id'";
    if ($mysqli->query($query)) {
        header("Location: index.php?page=pasien/pasien");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}