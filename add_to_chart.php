<?php
session_start();

// Hubungkan ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "shoesweb";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];

    // Cek apakah produk sudah ada di keranjang
    $sql_check = "SELECT * FROM cart WHERE user_id = ? AND product_id = ? AND size = ?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param("iis", $user_id, $product_id, $size);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika ada, tambahkan jumlah
        $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ? AND size = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("iis", $user_id, $product_id, $size);
        $stmt_update->execute();
    } else {
        // Jika belum ada, tambahkan ke keranjang
        $sql_insert = "INSERT INTO cart (user_id, product_id, size, quantity) VALUES (?, ?, ?, 1)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iis", $user_id, $product_id, $size);
        $stmt_insert->execute();
    }

    // Redirect ke halaman keranjang
    header("Location: cart.php");
    exit();
} else {
    echo "Metode request tidak valid.";
    exit();
}

$conn->close();
?>
