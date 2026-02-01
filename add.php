<?php
include 'db.php'; // استدعاء ملف الاتصال

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];
    $file_url = $_POST['file_url'];

    // كود الحماية والإضافة باستخدام PDO لمنع الاختراق
    $sql = "INSERT INTO mlazem (title, category, image_url, file_url) VALUES (?, ?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    if ($stmt->execute([$title, $category, $image_url, $file_url])) {
        echo "<p style='color:green;'>تمت إضافة الملزمة بنجاح!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة ملزمة جديدة</title>
</head>
<body>
    <h2>إضافة محتوى جديد لموقعك</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="عنوان الملزمة (مثلاً: كيمياء ثالث)" required><br><br>
        <select name="category">
            <option value="ملازم">ملازم</option>
            <option value="أسئلة">أسئلة</option>
            <option value="نتائج">نتائج</option>
        </select><br><br>
        <input type="text" name="image_url" placeholder="رابط صورة الغلاف من تليجرام" required><br><br>
        <input type="text" name="file_url" placeholder="رابط الملف PDF من تليجرام" required><br><br>
        <button type="submit">نشر الآن</button>
    </form>
</body>
</html>
