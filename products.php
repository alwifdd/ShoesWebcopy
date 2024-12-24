<?php
$conn = new mysqli("localhost", "root", "", "shoesweb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Products</title>
</head>
<body>
    <h1>Our Products</h1>
    <div class="product-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product-item">
                <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h2><?php echo $row['name']; ?></h2>
                <p>$<?php echo number_format($row['price'], 2); ?></p>
                <a href="product_detail.php?id=<?php echo $row['id']; ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
