<?php
$data = json_decode(file_get_contents('db.json'), true);

$new = [
    'phone' => $_POST['phone'],
    'transaction' => $_POST['transaction'],
    'status' => 'Pending'
];

$data[] = $new;
file_put_contents('db.json', json_encode($data, JSON_PRETTY_PRINT));
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Submitted</title>
</head>
<body>
  <h2>✅ Payment Submitted Successfully!</h2>
  <p>Please wait for admin approval. You can check your status later.</p>
  <a href="index.html">🔙 Back to Home</a>
</body>
</html>
