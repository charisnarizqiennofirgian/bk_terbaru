<?php
include("C:/xampp/htdocs/poliklinik/db/koneksi.php");
?>

<div class="modal fade" id="pasienModal" tabindex="-1" aria-labelledby="pasienModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pasienModalLabel">Form Pasien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="index.php?page=pasien/aksi_pasien">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama">
          </div>
          <div class="mb-3">
            <label for="no_ktp" class="form-label">No ktp</label>
            <input type="text" class="form-control" id="no_ktp" name="no_ktp">
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="container mt-4" style="background-color: #ffffff;">
  <h3 class="mt-5 text-center">DAFTAR PASIEN</h3>
  <table class="table table-striped mt-3" id="daftar-pasien">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nomor ktp</th>
        <th>Nomor hp</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pasienModal">
    Tambah
  </button>
      <?php
      $result = mysqli_query($mysqli, "SELECT * FROM pasien");
      $no = 1;
      while ($data = mysqli_fetch_array($result)) {
      ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $data['nama'] ?></td>
          <td><?php echo $data['no_ktp'] ?></td>
          <td><?php echo $data['no_hp'] ?></td>
          <td>
            <a class="btn btn-warning" href="?page=pasien/pasien_edit&id=<?php echo $data['id']; ?>">Edit</a>
            <a class="btn btn-danger" href="?page=pasien/aksi_pasien&action=delete&id=<?php echo $data['id'] ?>">Hapus</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    var table = $('#daftar-pasien').DataTable({
      dom: 'Bfrtip', 
      buttons: [{
        extend: 'excel',
        text: 'Export to Excel', 
        title: 'Daftar Pasien', 
        className: 'btn btn-primary' 
      }],
    });
    $('#export-excel').on('click', function() {
      table.buttons('excel').trigger(); 
    });
  });
</script>