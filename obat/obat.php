<?php
include("C:/xampp/htdocs/poliklinik/db/koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="path/to/datatables/css/dataTables.bootstrap4.min.css">
  <!-- Add any additional stylesheets you might have -->

  <!-- Add the following styles for light mode -->
  <style>
    body.light-mode {
      background-color: #ffffff; /* Set background color to white */
      color: #000000; /* Set text color to black */
    }
  </style>

  <script src="path/to/jquery.min.js"></script>
  <script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="path/to/datatables/js/jquery.dataTables.min.js"></script>
  <script src="path/to/datatables/js/dataTables.bootstrap4.min.js"></script>
  <script src="path/to/datatables/js/dataTables.buttons.min.js"></script>
  <script src="path/to/datatables/js/buttons.bootstrap4.min.js"></script>
</head>

<body class="light-mode">

  <div class="modal fade" id="obatModal" tabindex="-1" aria-labelledby="obatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="obatModalLabel">Form obat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="index.php?page=obat/aksi_obat">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="kemasan" class="form-label">kemasan</label>
              <input type="text" class="form-control" id="kemasan" name="kemasan" required>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="text" class="form-control" id="harga" name="harga" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<div class="container mt-5 mb-5" style="background-color: #ffffff;">
  <h3 class="mt-5 text-center">DAFTAR OBAT</h3>
  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="daftar-obat">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>kemasan</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
    <div class="pb-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#obatModal">
        Tambah
      </button>
    </div>
        <?php
        $result = mysqli_query($mysqli, "SELECT * FROM obat");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['nama'] ?></td>
            <td><?php echo $data['kemasan'] ?></td>
            <td><?php echo 'Rp ' . number_format($data['harga'], 0, ',', '.') ?></td>
            <td>
              <a class="btn btn-warning" href="?page=obat/obat_edit&id=<?php echo $data['id']; ?>">Edit</a>
              <a class="btn btn-danger" href="?page=obat/aksi_obat&action=delete&id=<?php echo $data['id'] ?>">Hapus</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


</body>

</html>
