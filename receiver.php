<?php
include 'db.php'; // الاتصال بقاعدة البيانات

// استلام البيانات القادمة من بايثون
$data = $_POST['data'] ?? '';
$type = $_POST['type'] ?? '';

if (!empty($data) && !empty($type)) {
    
    // سنستخدم ملف نصي صغير "كمؤقت" لربط العنوان بالصورة والملف
    // لأن البيانات تصل في طلبات منفصلة من البوت
    
    if ($type == "title") {
        file_put_contents("temp_title.txt", $data);
        echo "تم استلام العنوان";
    } 
    
    elseif ($type == "image") {
        file_put_contents("temp_image.txt", $data);
        echo "تم استلام معرف الصورة";
    } 
    
    elseif ($type == "file") {
        // عندما يصل الملف، نجمع كل البيانات السابقة ونخزنها في القاعدة
        $title = file_get_contents("temp_title.txt") ?: "بدون عنوان";
        $image = file_get_contents("temp_image.txt") ?: "";
        $file_id = $data;

        try {
            $sql = "INSERT INTO mlazem (title, category, image_url, file_url) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, "ملازم", $image, $file_id]);
            
            // تنظيف الملفات المؤقتة بعد الحفظ
            unlink("temp_title.txt");
            unlink("temp_image.txt");
            
            echo "تم حفظ الملزمة بنجاح في قاعدة البيانات";
        } catch (Exception $e) {
            echo "خطأ في الحفظ: " . $e->getMessage();
        }
    }
} else {
    echo "لا توجد بيانات مستلمة";
}
?>
