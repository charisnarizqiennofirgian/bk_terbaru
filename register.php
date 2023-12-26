<?php
include("inc/koneksi.php");

$error = "";
$showSwal = false; 
$swalType = '';
$swalTitle = '';
$swalText = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $stmt = $mysqli->prepare("SELECT * FROM user WHERE username=?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $showSwal = true;
    $swalType = 'error';
    $swalTitle = 'Username sudah digunakan';
    $swalText = 'Silakan pilih username lain.';
  } else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    if ($stmt->execute()) {
      header("Location: login.php"); // Redirect to login page after successful registration
      exit;
    } else {
      $error = "Error: " . $stmt->error;
    }
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">

            <div id="signupForm">
              <h4 class="card-title text-center mb-4">Daftar Akun</h4>
              <form method="POST" action="">
                <div class="mb-3">
                  <label for="signupUsername" class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" id="signupUsername" placeholder="Username" required>
                </div>
                <div class="mb-3">
                  <label for="signupPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="signupPassword" placeholder="Password" required>
                </div>
                <button type="submit" name="signup" class="btn btn-success w-100">Sign up</button>
                <p class="text-danger mt-2"><?php echo $error; ?></p>
                <div class="text-center mt-3">
                  Sudah punya akun? <a href="login.php">Login sekarang</a>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
