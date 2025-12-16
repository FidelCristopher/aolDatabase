<?php
// C:\xampp\htdocs\LaundryYuk\login.php

// 1. Header CORS (Wajib)
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'koneksi.php'; // koneksi.php harus terhubung ke databaseelec

$response = array();

// 2. Ambil data JSON dari React/Axios
$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'] ?? '';
$password_input = $data['password'] ?? '';

if (empty($username) || empty($password_input)) {
    $response['success'] = false;
    $response['message'] = "Username atau password tidak boleh kosong.";
    echo json_encode($response);
    exit();
}

$username = mysqli_real_escape_string($conn, $username); // Gunakan $conn sesuai koneksi.php Anda

// 3. Query dan Verifikasi Password (menggunakan password_verify karena password di-hash)
$query = "SELECT id, username, password, role FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $hashed_password = $user['password'];
    
    if (password_verify($password_input, $hashed_password)) {
        // Login Berhasil
        $response['success'] = true;
        $response['message'] = "Login berhasil!";
        $response['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];
    } else {
        // Password salah
        $response['success'] = false;
        $response['message'] = "Username atau password salah.";
    }
} else {
    // User tidak ditemukan
    $response['success'] = false;
    $response['message'] = "Username tidak terdaftar.";
}

// 4. Kirim Respons JSON
echo json_encode($response);
mysqli_close($conn);
?>