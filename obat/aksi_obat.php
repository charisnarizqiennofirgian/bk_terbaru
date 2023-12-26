<?php
include("C:/xampp/htdocs/poliklinik/inc/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $kemasan = $_POST['kemasan'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO obat(nama, kemasan, harga) VALUES ('$nama', '$kemasan', '$harga')";
    if ($mysqli->query($query)) {
        header("Location: index.php?page=obat/obat");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM obat WHERE id='$id'";
    if ($mysqli->query($query)) {
        header("Location: index.php?page=obat/obat");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
