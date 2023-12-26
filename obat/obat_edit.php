<?php
include("C:/xampp/htdocs/poliklinik/inc/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $kemasan = $_POST['kemasan'];
  $harga = $_POST['harga'];

  $query = "UPDATE obat SET nama='$nama', kemasan='$kemasan', harga='$harga' WHERE id=$id";
  if ($mysqli->query($query)) {
    header("Location: index.php?page=obat/obat");
    exit;  // Penting untuk mencegah eksekusi kode lebih lanjut setelah pengalihan header
  } else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($mysqli, "SELECT * FROM obat WHERE id=$id");
  $row = mysqli_fetch_assoc($result);
}
?>

<div class="container mt-4">
  <h3>Edit obat</h3>
  <form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
    </div>
    <div class="mb-3">
      <label for="kemasan" class="form-label">kemasan</label>
      <input type="text" class="form-control" id="kemasan" name="kemasan" value="<?php echo $row['kemasan']; ?>">
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">Nomor HP</label>
      <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>