<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'] ?? '';

    $dataFile = 'db.json';
    $found = false;

    if (file_exists($dataFile)) {
        $json = file_get_contents($dataFile);
        $data = json_decode($json, true);

        echo "<h3>Payment Status</h3>";

        foreach ($data as $entry) {
            if ($entry['phone'] === $phone) {
                echo "<div style='margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;'>";

                echo "<strong>Phone:</strong> " . htmlspecialchars($entry['phone']) . "<br>";
                echo "<strong>Txn:</strong> " . htmlspecialchars($entry['transaction']) . "<br>";
                echo "<strong>Status:</strong> " . htmlspecialchars($entry['status']) . "<br>";

                if ($entry['status'] === 'Done' && isset($entry['proof_code'])) {
                    echo "<strong>Proof Code:</strong> <span style='color: green; font-weight: bold;'>" . htmlspecialchars($entry['proof_code']) . "</span><br>";
                }

                echo "</div>";
                $found = true;
            }
        }

        if (!$found) {
            echo "<p>No transaction found for this phone number.</p>";
        }
    } else {
        echo "<p>No data file found.</p>";
    }
}
?>
