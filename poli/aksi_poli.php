<?php
include("C:/xampp/htdocs/poliklinik/db/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_poli'];
    $keterangan = $_POST['keterangan'];

$query = "INSERT INTO pasien(nama_poli, keterangan) VALUES ('$nama', '$keterangan')";
    if ($mysqli->query($query)) {
        header("Location: index.php?page=poli/poli");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM poli WHERE id='$id'";
    if ($mysqli->query($query)) {
        header("Location: index.php?page=poli/poli");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}