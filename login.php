<?php
include("inc/koneksi.php");

// Inisialisasi pesan error
$error = "";
$showSwal = false; // Flag to determine whether to show SweetAlert or not
$swalType = '';
$swalTitle = '';
$swalText = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (isset($_POST["signup"])) {
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $showSwal = true;
      $swalType = 'Error';
      $swalTitle = 'Username sudah digunakan';
      $swalText = 'Silakan pilih username lain.';
    } else {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $mysqli->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
      $stmt->bind_param("ss", $username, $hashed_password);
      if ($stmt->execute()) {
        $showSwal = true;
        $swalType = 'success';
        $swalTitle = 'Pendaftaran berhasil';
        $swalText = 'Anda dapat login sekarang.';
      } else {
        $error = "Error: " . $stmt->error;
      }
    }
    $stmt->close();
  } elseif (isset($_POST["login"])) {
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
      if (password_verify($password, $row["password"])) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        header("Location: index.php");
        exit;
      } else {
        $showSwal = true;
        $swalType = 'error';
        $swalTitle = 'Login gagal';
        $swalText = 'Username atau Password salah.';
      }
    } else {
      $showSwal = true;
      $swalType = 'error';
      $swalTitle = 'Login gagal';
      $swalText = 'Username atau Password salah.';
    }
    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
  <div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="signup">
      <form method="POST" action="">
        <label for="chk" aria-hidden="true">Sign up</label>
        <input type="text" name="username" placeholder="Username" required="">
        <input type="password" name="password" placeholder="Password" required="">
        <button type="submit" name="signup">Sign up</button>
        <p><?php echo $error; ?></p>
      </form>
    </div>

    <div class="login">
      <form method="POST" action="">
        <label for="chk" aria-hidden="true">Login</label>
        <input type="text" name="username" placeholder="Username" required="">
        <input type="password" name="password" placeholder="Password" required="">
        <button type="submit" name="login">Login</button>
        <p><?php echo $error; ?></p>
      </form>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

  <?php if ($showSwal) : ?>
    <script>
      Swal.fire({
        icon: '<?php echo $swalType; ?>',
        title: '<?php echo $swalTitle; ?>',
        text: '<?php echo $swalText; ?>'
      });
    </script>
  <?php endif; ?>


</body>

</html>