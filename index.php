<?php
include 'db.php'; // الاتصال بقاعدة البيانات

// جلب آخر 20 ملزمة تم رفعها من القاعدة
try {
    $stmt = $pdo->query("SELECT * FROM mlazem ORDER BY id DESC LIMIT 20");
    $items = $stmt->fetchAll();
} catch (Exception $e) {
    die("خطأ في جلب البيانات: " . $e->getMessage());
}

// دالة سحرية لتحويل الروابط أو المعرفات إلى روابط قابلة للعرض
function getTelegramLink($input) {
    // إذا كان المدخل رابطاً جاهزاً نتركه كما هو
    if (filter_var($input, FILTER_VALIDATE_URL)) {
        return $input;
    }
    // إذا كان معرف ملف (file_id)، نوجه المستخدم لفتح البوت أو القناة
    // ملاحظة: تليجرام لا يسمح بعرض file_id مباشرة كصورة دون "بوت وسيط"
    // لذا سنفترض أنك تضع رابط الرسالة العام أو سنعرض أيقونة افتراضية
    return "https://via.placeholder.com/250x300?text=Telegram+File"; 
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتبة الملازم الذكية</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #f0f2f5; margin: 0; padding: 20px; color: #333; }
        header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .container { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; max-width: 1200px; margin: 0 auto; }
        .card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: 0.3s; border: 1px solid #eee; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .card img { width: 100%; height: 250px; object-fit: cover; background: #ddd; }
        .card-content { padding: 15px; }
        .card h3 { font-size: 18px; margin: 0 0 10px 0; color: #2c3e50; }
        .badge { background: #3498db; color: white; padding: 3px 10px; border-radius: 20px; font-size: 12px; }
        .download-btn { display: block; background: #27ae60; color: white; text-align: center; padding: 12px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 15px; transition: 0.3s; }
        .download-btn:hover { background: #219150; }
        .empty-msg { grid-column: 1 / -1; padding: 50px; background: white; border-radius: 10px; }
    </style>
</head>
<body>

    <header>
        <h1>📚 مكتبة الملازم الرقمية</h1>
        <p>تحميل مباشر للملازم والأسئلة الوزارية عبر التليجرام</p>
    </header>

    <div class="container">
        <?php if (count($items) > 0): ?>
            <?php foreach ($items as $item): ?>
                <div class="card">
                    <img src="https://via.placeholder.com/250x300?text=PDF+Cover" alt="غلاف الملزمة">
                    
                    <div class="card-content">
                        <span class="badge"><?php echo htmlspecialchars($item['category']); ?></span>
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        
                        <a href="<?php echo $row['file_url']; ?>" class="btn-download" target="_blank">
                            📥 تحميل الملف
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-msg">
                <h3>لا توجد ملفات حالياً..</h3>
                <p>قم برفع أول ملزمة من خلال البوت الخاص بك لتظهر هنا!</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
