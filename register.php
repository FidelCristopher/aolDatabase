<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username  = $_POST['username'];
    $email     = $_POST['email'];
    $full_name = $_POST['full_name'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "Username sudah dipakai";
    } else {
        $query = mysqli_query($conn, "
            INSERT INTO users (username, password, email, full_name, role)
            VALUES ('$username', '$password', '$email', '$full_name', 'customer')
        ");

        if ($query) {
            echo "Registrasi berhasil, silakan login";
        } else {
            echo "Registrasi gagal";
        }
    }
}
?>

<h2>Register Akun</h2>
<form method="post">
    <input type="text" name="full_name" placeholder="Nama Lengkap" required><br><br>
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="register">Daftar</button>
</form>

<p>Sudah punya akun? <a href="login.php">Login</a></p>
