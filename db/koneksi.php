<?php
$host = "localhost";
$user = "root";  
$pass = "";      
$db = "polii";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die("Koneksi Gagal: " . $mysqli->connect_error);
}
