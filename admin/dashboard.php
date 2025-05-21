<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Read db.json
$dataFile = "../db.json";
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $data = json_decode($json, true);
    if (!is_array($data)) {
        $data = [];
    }
} else {
    $data = [];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
</head>
<body>
  <h2>🛠 Admin Dashboard</h2>

  <?php if (empty($data)): ?>
    <p>No payment records found.</p>
  <?php else: ?>
    <?php foreach ($data as $index => $entry): ?>
      <form action="update.php" method="POST" style="display:inline-block; margin-bottom: 10px;">
        <strong>Phone:</strong>
        <input type="text" name="phone" value="<?php echo isset($entry['phone']) ? htmlspecialchars($entry['phone']) : ''; ?>" readonly>
        <strong>Txn:</strong>
        <input type="text" name="transaction" value="<?php echo isset($entry['transaction']) ? htmlspecialchars($entry['transaction']) : ''; ?>" readonly>
        <strong>Status:</strong>
        <select name="status">
          <option value="Pending" <?php if (isset($entry['status']) && $entry['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
          <option value="Done" <?php if (isset($entry['status']) && $entry['status'] == 'Done') echo 'selected'; ?>>Done</option>
        </select>
        <input type="hidden" name="index" value="<?php echo $index; ?>">
        <button type="submit">✅ Update</button>
      </form>

      <form action="delete.php" method="POST" onsubmit="return confirm('Delete this transaction?');" style="display:inline-block;">
        <input type="hidden" name="index" value="<?php echo $index; ?>">
        <button type="submit" style="background:red; color:white;">🗑️ Delete</button>
      </form>
      <hr>
    <?php endforeach; ?>
  <?php endif; ?>

  <br><br>
  <a href="logout.php">🔓 Logout</a>
</body>
</html>
