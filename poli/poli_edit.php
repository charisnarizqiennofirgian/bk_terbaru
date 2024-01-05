<?php
include("C:/xampp/htdocs/poliklinik/db/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $nama_poli = $_POST['nama_poli'];
  $keterangan = $_POST['keterangan'];

  $query = "UPDATE pasien SET nama_poli='$nama_poli', keterangan='$keterangan' WHERE id=$id";
  if ($mysqli->query($query)) {
    header("Location: ?page=poli/poli");
    exit;  
  } else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($mysqli, "SELECT * FROM poli WHERE id=$id");
  $row = mysqli_fetch_assoc($result);
}
?>

<div class="container mt-4">
  <h3>Edit pasien</h3>
  <form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
      <label for="nama" class="form-label">nama</label>
      <input type="text" class="form-control" id="nama" name="nama_poli" value="<?php echo $row['nama_poli']; ?>">
    </div>
    <div class="mb-3">
      <label for="keterangan" class="form-label">keterangan</label>
      <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $row['keterangan']; ?>">
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
  </form>
</div>