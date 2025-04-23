<?php
$host = 'localhost';
$dbname = 'bmi_mvc';
$username = 'root';
$password = ''; // لو تستخدم XAMPP تأكد أنه بدون باسوورد

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}