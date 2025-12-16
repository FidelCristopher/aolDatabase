<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>

<h1>DASHBOARD ADMIN</h1>
<p>Selamat datang, <?php echo $_SESSION['username']; ?></p>
<a href="logout.php">Logout</a>
