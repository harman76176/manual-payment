<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = $_POST['index'];
    $status = $_POST['status'];
    $dataFile = "../db.json";

    if (file_exists($dataFile)) {
        $json = file_get_contents($dataFile);
        $data = json_decode($json, true);

        if (isset($data[$index])) {
            $data[$index]['status'] = $status;

            // Agar status Done hua to ek 4-digit random code add karo
            if ($status === 'Done') {
                // Agar already proof_code hai to use mat change karo
                if (!isset($data[$index]['proof_code'])) {
                    $data[$index]['proof_code'] = rand(1000, 9999);
                }
            }

            file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
        }
    }
}

header("Location: dashboard.php");
exit();
