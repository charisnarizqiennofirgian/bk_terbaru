<?php
if (!isset($_SESSION)) {
    session_start();
}

// Lakukan koneksi ke database
include_once("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id_pasien'])) {
        // Ambil data yang dikirimkan dari formulir
        $id_pasien = $_SESSION['id_pasien'];
        $id_jadwal = $_POST['id_jadwal'];
        $keluhan = $_POST['keluhan'];
        $no_antrian = $_POST['no_antrian'];

        // Lakukan query untuk memeriksa keberadaan id_pasien dalam tabel pasien
        $queryCheckPasien = "SELECT id FROM pasien WHERE id = ?";
        $stmtCheckPasien = $mysqli->prepare($queryCheckPasien);
        $stmtCheckPasien->bind_param("i", $id_pasien);
        $stmtCheckPasien->execute();
        $resultCheckPasien = $stmtCheckPasien->get_result();

        if ($resultCheckPasien->num_rows === 0) {
            echo "Id pasien tidak ditemukan dalam tabel pasien.";
            // Lakukan tindakan lain jika diperlukan
        } else {
            // Lakukan query untuk menyimpan data ke dalam tabel daftar_poli
            $query = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES (?, ?, ?, ?)";
            
            // Eksekusi query INSERT
            $stmt = $mysqli->prepare($query);
            if ($stmt === false) {
                die("Error: " . $mysqli->error); // Tampilkan pesan kesalahan jika query gagal
            }

            // Bind parameter dan lanjutkan dengan eksekusi
            $stmt->bind_param("iiss", $id_pasien, $id_jadwal, $keluhan, $no_antrian);
            if ($stmt->execute()) {
                // Penyimpanan berhasil
                echo "Keluhan telah disimpan.";
                // Lanjutkan dengan tindakan lain jika diperlukan
            } else {
                // Jika ada kesalahan dalam eksekusi query
                echo "Terjadi kesalahan: " . $stmt->error;
            }
        }
    } else {
        echo "ID Pasien tidak tersedia.";
    }
} else {
    // Jika tidak ada data POST yang dikirimkan
    echo "Aksi tidak diizinkan.";
}
?>