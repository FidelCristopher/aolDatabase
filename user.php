<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
    header("Location: login.php");
    exit;
}
?>

<h1>DASHBOARD USER</h1>
<p>Halo, <?php echo $_SESSION['username']; ?></p>
<a href="logout.php">Logout</a>
