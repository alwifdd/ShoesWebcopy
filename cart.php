<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "shoesweb";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.quantity, products.name, products.image, products.price 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Keranjang Belanja</h1>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($row = $result->fetch_assoc()):
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
            ?>
            <tr>
                <td><img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>"></td>
                <td><?php echo $row['name']; ?></td>
                <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">Total</td>
                <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>
    <a href="checkout.php">Checkout</a>
</body>
</html>

<?php
$conn->close();
?>
