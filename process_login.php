<?php
session_start();

$servername = "localhost";
$username = "root";  // Ganti sesuai dengan username database Anda
$password = "";      // Ganti sesuai dengan password database Anda
$dbname = "shoesweb";  // Ganti dengan nama database yang sesuai

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form login
$email = $_POST['email'];
$password_input = $_POST['password'];

// Query untuk memeriksa email
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

// Cek apakah email ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verifikasi password dengan hash yang tersimpan
    if (password_verify($password_input, $row['password'])) {
        // Simpan session jika login berhasil
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
        
        // Redirect ke halaman utama (index.php)
        header("Location: index.php");
        exit();
    } else {
        // Jika password salah
        $_SESSION['error'] = 'Password salah.';
        header("Location: login.php"); // Kembali ke halaman login
        exit();
    }
} else {
    // Jika email tidak ditemukan
    $_SESSION['error'] = 'Email belum terdaftar.';
    header("Location: login.php"); // Kembali ke halaman login
    exit();
}

$conn->close();
?>
