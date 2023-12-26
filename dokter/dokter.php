<?php
include("C:/xampp/htdocs/poliklinik/inc/koneksi.php");
?>

<div class="modal fade" id="dokterModal" tabindex="-1" aria-labelledby="dokterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dokterModalLabel">Form Dokter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="index.php?page=dokter/aksi_dokter">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
          </div>
          <div class="mb-3">
            <label for="nomor_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container mt-5 mb-5">
  <h3 class="mt-5 text-center">DAFTAR DOKTER</h3>
  <table class="table table-striped mt-3" id="daftar-dokter">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = mysqli_query($mysqli, "SELECT * FROM dokter");
      $no = 1;
      while ($data = mysqli_fetch_array($result)) {
      ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $data['nama'] ?></td>
          <td><?php echo $data['alamat'] ?></td>
          <td><?php echo $data['nomor_hp'] ?></td>
          <td>
            <a class="btn btn-warning" href="index.php?page=dokter/dokter_edit&id=<?php echo $data['id']; ?>">Edit</a>
            <a class="btn btn-danger" href="index.php?page=dokter/aksi_dokter&action=delete&id=<?php echo $data['id'] ?>">Hapus</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dokterModal">
    Tambah
  </button>
</div>

<script>
  $(document).ready(function() {
    var table = $('#daftar-dokter').DataTable({
      dom: 'Bfrtip', // Show buttons in the specified location
      buttons: [{
        extend: 'excel', // Use the Excel export button
        text: 'Export to Excel', // Set the custom text for the button
        title: 'Daftar Dokter', // Set the title for the Excel sheet
        className: 'btn btn-primary' // Add Bootstrap 5 button classes
      }],
    });

    // Add a click event handler for the export button
    $('#export-excel').on('click', function() {
      table.buttons('excel').trigger(); // Trigger the Excel export action
    });
  });
</script>