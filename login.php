<?php
include("db/koneksi.php");

$error = "";
$showSwal = false;
$swalType = '';
$swalTitle = '';
$swalText = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"]; // New line to get the selected role

    $stmt = $mysqli->prepare("SELECT * FROM user WHERE username=? AND role=?");
    $stmt->bind_param("ss", $username, $role); // Updated to include role
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div id="loginForm">
                            <h4 class="card-title text-center mb-4">Masuk</h4>
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="loginUsername" class="form-label font">Username</label>
                                    <input type="text" name="username" class="form-control" id="loginUsername" placeholder="Username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Anda masuk sebagai :</label>
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="user">Pengunjung</option>
                                        <option value="dokter">Dokter</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                                <p class="text-danger mt-2"><?php echo $error; ?></p>
                                <div class="text-center mt-3">
                                    Belum punya akun? <a href="register.php">Daftar sekarang</a>
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
