<?php
include("C:/xampp/htdocs/poliklinik/db/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];

  $query = "UPDATE dokter SET nama='$nama', alamat='$alamat', no_hp='$no_hp' WHERE id=$id";
  if ($mysqli->query($query)) {
    header("Location: ?page=dokter/dokter");
    exit;
  } else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id=$id");
  $row = mysqli_fetch_assoc($result);
}
?>

<div class="container mt-4">
  <h3>Edit Dokter</h3>
  <form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
    </div>
    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>">
    </div>
    <div class="mb-3">
      <label for="no_hp" class="form-label">Nomor HP</label>
      <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>