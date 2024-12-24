<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // username default XAMPP
$password = ""; // password default XAMPP (kosong)
$dbname = "shoesweb"; // Nama database yang sudah dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form disubmit dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi jika email kosong
    if (empty($email)) {
        die("Email tidak boleh kosong.");
    }

    // Validasi jika password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        die("Password dan konfirmasi password tidak cocok.");
    }

    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil. <a href='login.php'>Login di sini</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
