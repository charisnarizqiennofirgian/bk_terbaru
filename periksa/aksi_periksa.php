<?php
include("C:/xampp/htdocs/poliklinik/db/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_dokter = $_POST['id_dokter'];
    $id_pasien = $_POST['id_pasien'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $waktu = $_POST['waktu'];
    $id_obat = $_POST['id_obat']; 
    $catatan = $_POST['catatan'];

    $query = "INSERT INTO periksa(id_dokter, id_pasien, tanggal_periksa, waktu, id_obat, catatan) VALUES ('$id_dokter', '$id_pasien', '$tanggal_periksa', '$waktu', '$id_obat', '$catatan')";


    if ($mysqli->query($query)) {
        header("Location: index.php?page=periksa/periksa");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM periksa WHERE id='$id'";

    if ($mysqli->query($query)) {
        header("Location: index.php?page=periksa/periksa");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
