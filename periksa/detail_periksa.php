<div class="container mt-5">
  <?php
  include("C:/xampp/htdocs/poliklinik/db/koneksi.php");

  // Periksa apakah parameter ID ada dalam URL
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buat query SQL untuk mengambil data periksa berdasarkan ID
    $query = "SELECT pr.id, p.nama AS nama_pasien, d.nama AS nama_dokter, pr.tanggal_periksa, pr.waktu, o.nama AS nama_obat, pr.catatan, o.harga AS harga_obat
                      FROM periksa pr 
                      JOIN pasien p ON pr.id_pasien = p.id 
                      JOIN dokter d ON pr.id_dokter = d.id 
                      JOIN obat o ON pr.id_obat = o.id 
                      WHERE pr.id = $id";

    $result = mysqli_query($mysqli, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_assoc($result);

      // Harga periksa
      $harga_periksa = 150000;

      // Harga obat dari database
      $harga_obat = $data['harga_obat'];

      // Hitung total harga
      $total_harga = $harga_periksa + $harga_obat;

      // Tampilkan data periksa dan total harga
      echo "<h2 class='text-center mb-5'>Rincian Periksa</h2>";
      echo "<table class='table table-striped'>";
      echo "<tr><th>Keterangan</th><th>Detail</th></tr>";
      echo "<tr><td>Nama Pasien</td><td>" . $data['nama_pasien'] . "</td></tr>";
      echo "<tr><td>Nama Dokter</td><td>" . $data['nama_dokter'] . "</td></tr>";
      echo "<tr><td>Tanggal Periksa</td><td>" . date('d M Y', strtotime($data['tanggal_periksa'])) . "</td></tr>";
      echo "<tr><td>Obat</td><td>" . $data['nama_obat'] . "</td></tr>";
      echo "<tr><td>Biaya Periksa</td><td>Rp " . number_format($harga_periksa, 0, ',', '.') . "</td></tr>";
      echo "<tr><td>Biaya Obat</td><td>Rp " . number_format($harga_obat, 0, ',', '.') . "</td></tr>";
      echo "<tr><td class='fw-bold'>Total Biaya</td><td class='fw-bold'>Rp " . number_format($total_harga, 0, ',', '.') . "</td></tr>";
      echo "</table>";
      echo "</br>";
      echo "</br>";
      echo "</br>";
      echo "</br>";
    } else {
      echo "Data periksa tidak ditemukan.";
    }
  } else {
    echo "Parameter ID tidak ditemukan.";
  }
  ?>
</div>