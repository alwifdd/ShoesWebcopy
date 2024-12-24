<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoesweb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID produk dari URL
$product_id = $_GET['id'];

// Query detail produk
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Detail Produk</title>
</head>
<body>
    <div class="product-detail">
        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <h1><?php echo $product['name']; ?></h1>
        <p>Rp <?php echo number_format($product['price'], 2, ',', '.'); ?></p>
        <p><?php echo $product['description']; ?></p>
        <form action="add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="size">Pilih Ukuran:</label>
            <select name="size" id="size" required>
                <?php foreach (explode(',', $product['sizes']) as $size): ?>
                    <option value="<?php echo $size; ?>"><?php echo $size; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Tambah ke Keranjang</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
