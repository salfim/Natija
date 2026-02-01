<?php
$host = 'turntable.proxy.rlwy.net';
$db   = 'railway';
$user = 'root';
$pass = 'pvZgbRLcFTscAsDeXFcbYYkrZnboYMiF';
$port = '29794';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // إذا وصلنا هنا يعني الاتصال نجح
} catch (PDOException $e) {
    die("خطأ في الاتصال: " . $e->getMessage());
}
?>
