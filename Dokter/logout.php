<?php
session_start();
if (isset($_SESSION['nip'])) {
    // Hapus session
    session_unset();
    session_destroy();
}

header("Location: index.php?page=loginDokter");
exit();
?>