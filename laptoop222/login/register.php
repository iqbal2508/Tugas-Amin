<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="../css/log.css">

</head>

<body>
    <div class="alert alert-warning" role="alert">
        <?php
        include '../database/koneksi.php';

        error_reporting(0);
        echo $_SESSION['error'];

        session_start();  

        if (isset($_SESSION['username'])) {
            if ($_SESSION['username'] == 'admin') {
                header('Location:../admin/dashboard.php');
            } else {
                header('Location:../');
            }
        }

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($koneksi, $sql);
            if ($result) {
                echo "<script>alert('Pendaftaran berhasil. Silakan login!')</script>";
            } else {
                echo "<script>alert('Pendaftaran gagal. Silakan coba lagi!')</script>";
            }
        }
        ?>
    </div>

    <div class="container">
        <form action="" method="POST" class="login-email">
            <div class="title">Register Form</div>
            <br>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
                <a href="index.php" class="link" >Kembali</a>
            </div>
        </form>
    </div>
</body>

</html>
