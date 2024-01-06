<?php
session_start();
if (isset($_SESSION['nama_pasien'])) {
    // Hapus session
    session_unset();
    session_destroy();
}

header("Location: index.php?page=loginPasien");
exit();
?>