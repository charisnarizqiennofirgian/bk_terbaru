<?php
include("C:/xampp/htdocs/poliklinik/inc/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $no_ktp = $_POST['no_ktp'];
  $no_hp = $_POST['no_hp'];

  $query = "UPDATE pasien SET nama='$nama', no_ktp='$no_ktp', no_hp='$no_hp' WHERE id=$id";
  if ($mysqli->query($query)) {
    header("Location: index.php?page=pasien/pasien");
    exit;  // Penting untuk mencegah eksekusi kode lebih lanjut setelah pengalihan header
  } else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($mysqli, "SELECT * FROM pasien WHERE id=$id");
  $row = mysqli_fetch_assoc($result);
}
?>

<div class="container mt-4">
  <h3>Edit pasien</h3>
  <form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
    </div>
    <div class="mb-3">
      <label for="no_ktp" class="form-label">no_ktp</label>
      <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="<?php echo $row['no_ktp']; ?>">
    </div>
    <div class="mb-3">
      <label for="no_hp" class="form-label">Nomor HP</label>
      <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>