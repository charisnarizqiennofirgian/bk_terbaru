<?php
include("C:/xampp/htdocs/poliklinik/inc/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $nomor_hp = $_POST['nomor_hp'];

  $query = "UPDATE dokter SET nama='$nama', alamat='$alamat', nomor_hp='$nomor_hp' WHERE id=$id";
  if ($mysqli->query($query)) {
    header("Location: index.php?page=dokter/dokter");
    exit;  // Penting untuk mencegah eksekusi kode lebih lanjut setelah pengalihan header
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
      <label for="nomor_hp" class="form-label">Nomor HP</label>
      <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?php echo $row['nomor_hp']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>