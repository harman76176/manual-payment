<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['username'] === 'harman76176' && $_POST['password'] === 'Orbit@1234') {
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
    exit;
  } else {
    echo "Invalid login!";
  }
}
?>
<form method="post">
  <h2>Admin Login</h2>
  <input name="username" placeholder="Username"><br>
  <input type="password" name="password" placeholder="Password"><br>
  <button type="submit">Login</button>
</form>
