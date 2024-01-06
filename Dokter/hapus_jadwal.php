<?php
// Sisipkan file koneksi.php
include_once("../koneksi.php");

// Periksa apakah ada permintaan penghapusan yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Tangkap ID jadwal yang dikirimkan dari formulir
    $id_jadwal_to_delete = $_POST['id'];

    // Query untuk menghapus jadwal periksa berdasarkan ID jadwal
    $delete_query = "DELETE FROM jadwal_periksa WHERE id = '$id_jadwal_to_delete'";
    if ($mysqli->query($delete_query)) {
        // Jika penghapusan berhasil, kembalikan respons ke halaman sebelumnya
        echo '<script>alert("Jadwal periksa berhasil dihapus."); window.location.href = "atur_jadwal.php";</script>';
    } else {
        // Jika terjadi kesalahan saat penghapusan, tampilkan pesan kesalahan
        echo '<script>alert("Gagal menghapus jadwal periksa: ' . $mysqli->error . '"); window.location.href = "atur_jadwal.php";</script>';
    }
} else {
    // Jika tidak ada permintaan penghapusan yang valid, tampilkan pesan
    echo '<script>alert("Permintaan penghapusan tidak valid."); window.location.href = "atur_jadwal.php";</script>';
}
?>
