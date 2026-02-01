<?php
include 'db.php';

$data = $_POST['data'] ?? '';
$type = $_POST['type'] ?? '';

if (!empty($data) && !empty($type)) {
    try {
        if ($type == "title") {
            // إنشاء سجل جديد بالعنوان فقط
            $sql = "INSERT INTO mlazem (title, category) VALUES (?, ?)";
            $pdo->prepare($sql)->execute([$data, "ملازم"]);
            echo "Title saved";
        } 
        
        elseif ($type == "image") {
            // تحديث آخر سجل تم إنشاؤه بإضافة الصورة
            $sql = "UPDATE mlazem SET image_url = ? ORDER BY id DESC LIMIT 1";
            $pdo->prepare($sql)->execute([$data]);
            echo "Image updated";
        } 
        
        elseif ($type == "file") {
            // تحديث آخر سجل تم إنشاؤه بإضافة رابط الملف
            $sql = "UPDATE mlazem SET file_url = ? ORDER BY id DESC LIMIT 1";
            $pdo->prepare($sql)->execute([$data]);
            echo "File updated and saved successfully";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No data received";
}
?>
