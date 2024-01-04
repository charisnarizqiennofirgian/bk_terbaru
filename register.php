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
    $role = $_POST["role"];

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
        $stmt = $mysqli->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);
        if ($stmt->execute()) {
            $showSwal = true;
            $swalType = 'success';
            $swalTitle = 'Pendaftaran berhasil';
            $swalText = 'Akun berhasil dibuat. Silakan login untuk mengakses akun Anda.';

            header("Location: login.php");
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
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            background-color: #f0f2f5;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .form-control {
            height: 40px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #1877f2;
            border: none;
            height: 40px;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0e5a8a;
        }

        .text-danger {
            font-size: 14px;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .mt-3 {
            margin-top: 15px;
        }

        a {
            color: #1877f2;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar</h4>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="signupUsername" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="signupUsername" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="signupPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="signupPassword" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="user">Pengunjung</option>
                        <option value="dokter">Dokter</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" name="signup" class="btn btn-success w-100">Sign up</button>
                <p class="text-danger mt-2"><?php echo $error; ?></p>
                <div class="text-center mt-3">
                    Sudah punya akun? <a href="login.php">Login sekarang</a>
                </div>
            </form>
            
            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-primary">Kembali ke Dashboard
                </a>
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
