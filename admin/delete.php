<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['index'])) {
    $index = $_POST['index'];
    $dataFile = "../db.json";

    if (file_exists($dataFile)) {
        $json = file_get_contents($dataFile);
        $data = json_decode($json, true);

        if (isset($data[$index])) {
            unset($data[$index]);
            $data = array_values($data); // re-index
            file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
        }
    }
}

header("Location: dashboard.php");
exit();
