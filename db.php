<?php
$host = 'sql111.ezyro.com'; // ضع الهوست الخاص بك هنا
$db   = 'ezyro_41026468_Mlzmtei';    // اسم قاعدة البيانات
$user = 'ezyro_41026468';         // اسم المستخدم
$pass = 'a2decca79';         // كلمة المرور
$charset = 'utf8mb4';            // لدعم اللغة العربية بشكل صحيح

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     // echo "الاتصال ناجح!"; // يمكنك تفعيل هذا السطر للتأكد من الاتصال ثم حذفه
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
