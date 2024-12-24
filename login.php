<?php
session_start();
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login-style.css">
  <title>Login</title>
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <!-- Form login mengarah ke process-login.php -->
    <form action="process_login.php" method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <?php if ($error_message): ?>
      <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
  </div>
</body>
</html>
