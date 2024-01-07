<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_rm = $_POST['no_rm'];
    $query = "SELECT * FROM pasien WHERE no_rm = '$no_rm'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($no_rm === $row['no_rm']) {
            $_SESSION['nama_pasien'] = $row['nama_pasien'];
            $_SESSION['id_pasien'] = $row['id_pasien'];
            $_SESSION['id_pasien'] = $row['id'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Nomor Rekam Medis salah";
        }
        
    } else {
        $error = "Nomor Rekam Medis Tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .mycare-login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .mycare-login-card {
            width: 300px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .mycare-login-card-header {
            text-align: center;
            font-weight: bold;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .mycare-login-input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ced4da; 
            border-radius: 4px;
        }

        .mycare-login-button {
            width: 100%;
            padding: 12px;
            background-color: #4267b2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .mycare-login-button:hover {
            background-color: #3a5795;
        }
    </style>
</head>

<body>
    <div class="mycare-login-container">
        <div class="mycare-login-card">
            <div class="mycare-login-card-header">Login Pasien</div>
            <form method="POST" action="index.php?page=loginPasien">
                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger">' . $error . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                }
                ?>
                <div class="form-group">
                    <input type="text" name="no_rm" class="mycare-login-input" required
                        placeholder="Nomor Rekam Medis">
                </div>
                <button type="submit" class="mycare-login-button">Login</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXyST6ozvATL6u0DTdP4QF+eP9IhIjLgi5x6"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
