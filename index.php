<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php';

// جلب البيانات من القاعدة وترتيبها من الأحدث للأقدم
try {
    $stmt = $pdo->query("SELECT * FROM mlazem ORDER BY created_at DESC");
    $mlazem = $stmt->fetchAll();
} catch (PDOException $e) {
    $mlazem = [];
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتبة الملازم الرقمية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f4f7f6; }
        .navbar { background-color: #2c3e50; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .hero-section { background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); color: white; padding: 60px 0; text-align: center; margin-bottom: 40px; }
        .card { border: none; border-radius: 15px; transition: transform 0.3s, box-shadow 0.3s; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .card:hover { transform: translateY(-10px); box-shadow: 0 12px 20px rgba(0,0,0,0.1); }
        .card-img-top { border-top-left-radius: 15px; border-top-right-radius: 15px; height: 350px; object-fit: cover; background-color: #ddd; }
        .btn-download { background-color: #27ae60; border: none; border-radius: 10px; padding: 10px; font-weight: bold; transition: background 0.2s; }
        .btn-download:hover { background-color: #219150; }
        .empty-state { text-align: center; padding: 100px 20px; color: #7f8c8d; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">📚 مكتبة الملازم</a>
        </div>
    </nav>

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold">أحدث الملازم والكتب</h1>
            <p class="lead">تحميل مباشر للملازم الوزارية عبر التليجرام</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-4">
            <?php if (count($mlazem) > 0): ?>
                <?php foreach ($mlazem as $row): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100">
                            <?php 
                                $image = !empty($row['image_url']) ? $row['image_url'] : 'https://via.placeholder.com/300x400?text=لا+يوجد+غلاف';
                            ?>
                            <img src="<?php echo $image; ?>" class="card-img-top" alt="غلاف الملزمة">
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark mb-3"><?php echo htmlspecialchars($row['title']); ?></h5>
                                <div class="mt-auto">
                                    <span class="badge bg-light text-dark mb-3">ملزمة وزارية</span>
                                    
                                    <?php if (!empty($row['file_url'])): ?>
                                        <a href="<?php echo $row['file_url']; ?>" class="btn btn-download w-100 text-white" target="_blank">
                                            📥 تحميل الملف (PDF)
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary w-100" disabled>الرابط غير متوفر</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="100" alt="فارغ" class="mb-4 opacity-50">
                    <h3>لا توجد ملازم مرفوعة حالياً</h3>
                    <p>ابدأ برفع الملازم عبر بوت التليجرام الخاص بك لتظهر هنا.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="py-5 mt-5 text-center text-muted border-top">
        &copy; 2026 مكتبة الملازم الرقمية - جميع الحقوق محفوظة
    </footer>

</body>
</html>
