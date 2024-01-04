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

    $stmt = $mysqli->prepare("SELECT * FROM user WHERE username=? AND role=?");
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            $showSwal = true;
            $swalType = 'success';
            $swalTitle = 'Login berhasil';
            $swalText = 'Selamat datang, ' . $row['username'] . '!';

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
                <h4 class="card-title">Masuk</h4>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="loginUsername" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="loginUsername" placeholder="Email atau Telepon" required>
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
                    <div class="mb-3">
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    </div>
                    <p class="text-danger mt-2"><?php echo $error; ?></p>
                    <div class="text-center mt-3">
                        Belum punya akun? <a href="register.php">Daftar sekarang</a>
                    </div>
                                <div class="text-center mt-3">
                <a href="index.php" class="btn btn-primary">Kembali ke Dashboard</a>
            </div>
                </form>
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



