<?php
include 'koneksi.php';

$sql = "SELECT * FROM users";
$q = mysqli_query($conn, $sql);

if (!$q) {
    die("Query error: " . mysqli_error($conn));
}

while ($u = mysqli_fetch_assoc($q)) {
    echo $u['username'] . " - " . $u['role'] . "<br>";
}
