<?php
// Lakukan pengecekan koneksi ke database dan set session jika belum ada
if (!isset($_SESSION)) {
    session_start();
}

// Sisipkan file koneksi.php
include_once("../koneksi.php");

// Ambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirim dari form
    $tgl_periksa = date('Y-m-d');
    $id_daftar_poli = $_GET['id']; // Menggunakan $_GET['id'] dari URL
    $catatan = $_POST['catatan'];
    $biaya_periksa = $_POST['total_harga']; // Ganti 'total_harga' menjadi 'biaya_periksa'

    // Query INSERT untuk menyimpan data ke tabel 'periksa'
    $query_insert_periksa = "INSERT INTO periksa (tgl_periksa, id_daftar_poli, catatan, biaya_periksa) VALUES ('$tgl_periksa', '$id_daftar_poli', '$catatan', '$biaya_periksa')";

    // Lakukan operasi INSERT ke dalam database
    if ($mysqli->query($query_insert_periksa)) {
        // Ambil ID yang baru saja dimasukkan ke tabel 'periksa'
        $id_periksa = $mysqli->insert_id;
    
        // Ambil data obat yang dipilih dari form
        if (isset($_POST['obat']) && !empty($_POST['obat'])) {
            $obat_ids = $_POST['obat'];

            // Loop untuk setiap obat yang dipilih
            foreach ($obat_ids as $obat_id) {
                // Query untuk menyimpan ke tabel 'detail_periksa'
                $query_insert_detail = "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$id_periksa', '$obat_id')";

                // Lakukan operasi INSERT ke dalam database untuk setiap obat
                $mysqli->query($query_insert_detail);
            }
        }

        echo '<script>alert("Data berhasil disimpan");</script>';
        echo '<script>window.location.href = "antrean_pasien.php";</script>';
    }
} else {
    echo "Error: " . $query_insert_periksa . "<br>" . $mysqli->error;
}

// Tutup koneksi database
$mysqli->close();
?>