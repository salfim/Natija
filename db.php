<?php
$host = 'mysql.railway.internal'; // غالباً يكون something.railway.app
$db   = 'railway'; 
$user = 'root'; 
$pass = 'pvZgbRLcFTscAsDeXFcbYYkrZnboYMiF'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
