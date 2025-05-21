<?php
file_put_contents("../db.json", json_encode([]));
header("Location: dashboard.php?cleared=true");
?>
