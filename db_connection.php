<?php
// إعداد تفاصيل الاتصال بقاعدة البيانات
$host = 'localhost'; // اسم المضيف
$dbname = 'booking_system'; // اسم قاعدة البيانات
$username = 'root'; // اسم المستخدم
$password = ''; // كلمة المرور

// محاولة الاتصال بقاعدة البيانات باستخدام MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// التحقق من نجاح الاتصال
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// إعداد الترميز الافتراضي لضمان دعم اللغة العربية
$conn->set_charset("utf8mb4");
?>

