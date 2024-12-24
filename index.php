<?php
// Memulai sesi
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

// Ambil data semua produk
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="style.css" />
    <title>Shoes Store</title>
</head>
<body>
    <nav>
      <div class="container">
        <div class="logo">
          <img src="logo.png" alt="Logo" />
        </div>
        <div class="links">
          <a href="#">MEN</a>
          <a href="#">WOMEN</a>
          <a href="#">KIDS</a>
          <a href="#">CUSTOMIZE</a>
          <a href="#">COLLECTION</a>
        </div>
        <div class="search-login">
          <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
          <div class="login-btn">
            <?php if (isset($_SESSION['user_email'])): ?>
                <span>Welcome, <?php echo $_SESSION['user_email']; ?>!</span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>
    <section>
      <div class="content">
        <div class="main-content">
          <h1>Nike</h1>
          <h2>Air Max Plus</h2>
          <h4>MAKE THE GROUND SHAKE</h4>
          <p>Nike Air Max Plus
          Step boldly into a future where style meets innovation. Inspired by the raw power of nature, this iconic design combines striking aesthetics with cutting-edge comfort. Every stride you take resonates with confidence, redefining what it means to move effortlessly. Whether you’re conquering the streets, hitting the gym, or expressing your unique style, Nike Air Max Plus ensures you stand out and stay comfortable. Make every moment count, leave your mark, and let the world feel your presence.</p>
          <div class="order">
            <div class="order-btn">
              <button>Our Collection</button>
            </div>
          </div>
        </div>
        <div class="image">
          <img src="shoes.png" alt="Shoes" />
        </div>
      </div>
      <section class="products">
        <h2>Our Product</h2>
        <div class="product-list">
          <?php while ($product = $result->fetch_assoc()): ?>
            <div class="product-item">
              <a href="detail.php?id=<?php echo $product['id']; ?>">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
                <h3><?php echo $product['name']; ?></h3>
              </a>
              <p>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
            </div>
          <?php endwhile; ?>
        </div>
      </section>
    </section>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
     offset:1 
    });
  </script>
</body>
</html>

<?php
$conn->close();
?>
