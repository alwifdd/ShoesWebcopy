<?php
$host = "localhost";
$username = "root"; // default username di XAMPP
$password = ""; // default password di XAMPP
$dbname = "shoesweb";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
