<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
$host = 'localhost';
$dbname = 'bmi_lab2_step3';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]);
    exit;
}
?>
 <?php
header('Content-Type: application/json');
require 'config/database.php';

if (isset($_POST['name'], $_POST['weight'], $_POST['height'])) {
    $name = htmlspecialchars($_POST['name']);
    $weight = floatval(str_replace(',', '.', $_POST['weight']));
    $height = floatval(str_replace(',', '.', $_POST['height']));



    

    if ($weight <= 0 || $height <= 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid input values.'
        ]);
        exit;
    }

    $bmi = $weight / ($height * $height);
    $bmi = round($bmi, 2);

    if ($bmi < 18.5) {
        $status = "Underweight";
    } elseif ($bmi < 25) {
        $status = "Normal weight";
    } elseif ($bmi < 30) {
        $status = "Overweight";
    } else {
        $status = "Obese";
    }

    // حفظ البيانات في قاعدة البيانات
    $stmt = $db->prepare("INSERT INTO bmi_records (name, weight, height, bmi, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $weight, $height, $bmi, $status]);

    echo json_encode([
        'success' => true,
        'bmi' => $bmi,
        'message' => "Hello, $name. Your BMI is $bmi ($status)."
    ]);
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'Data not received.'
]);
exit;