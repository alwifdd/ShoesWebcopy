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

// Ambil detail produk berdasarkan ID
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Produk tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak ditemukan.";
    exit();
}
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
    <nav>
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="logo.png" alt="Logo"></a>
            </div>
            <div class="links">
                <a href="index.php">Home</a>
                <a href="products.php">Produk</a>
                <a href="cart.php">Keranjang</a>
            </div>
        </div>
    </nav>

    <section>
        <div class="product-detail">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">

            <div class="product-info">
                <h1><?php echo $product['name']; ?></h1>
                <p>Harga: <span>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span></p>
                <p>Stok: <span><?php echo $product['stock']; ?></span></p>
                <p>Deskripsi:</p>
                <p><?php echo $product['description']; ?></p>

                <!-- Form Tambahkan ke Keranjang -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <label for="size">Pilih Ukuran:</label>
                    <select name="size" id="size" required>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                    </select>
                    <button type="submit">Tambahkan ke Keranjang</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 ShoesWeb. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
