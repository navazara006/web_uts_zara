<?php
session_start();

require 'function.php';

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");

    // Cek username
    if(mysqli_num_rows($result) === 1) {

        // Cek password
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            // Set session
            $_SESSION['session_login'] = true;
            $_SESSION['username'] = $username;

            header('Location: index.php');
            exit;

        } else {
            echo "<script>
                alert('Password yang kamu masukkan salah!');
            </script>";
        }

    } else {
        echo "<script>
            alert('Username yang kamu masukkan salah atau tidak ditemukan!');
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="style.css">
</head>

<body class="page-register form-background">
    <div class="container">
        <div class="form-card form-card-register">
            <h2>Login</h2>
            <form action="" method="post">
                
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <!-- Button -->
                <div class="button-group">
                    <button type="submit" name="login" class="btn btn-edit btn-submit">
                        Login
                    </button>
                    <a href="registrasi.php" class="btn btn-kembali btn-kembali-form">
                        Registrasi
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>