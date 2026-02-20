<?php
/** * ملف فك حماية البث وتمريره للمشغل
 */

// الرابط الأصلي المحمي
$target_url = "http://app.upsdo.me:8080/live/PCCQTZPXVCEG/041212071179/93914.ts";

// إعدادات cURL لمحاكاة متصفح حقيقي وتجاوز الحماية
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false); // إرسال البث مباشرة
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // تتبع الروابط المشفرة (Redirects)

// أهم جزء: محاكاة User-Agent لفك الحظر عن الأجهزة غير المصرح لها
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

// إرسال الهيدرز التي تطلبها سيرفرات IPTV عادةً
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: */*',
    'Connection: keep-alive',
    'Referer: http://app.upsdo.me:8080/'
]);

// إرسال الهيدرز المناسبة للمتصفح ليقرأ الملف كفيديو
header('Content-Type: video/mp2t');
header('Cache-Control: no-cache');

// تنفيذ الطلب وبدء دفق (Streaming) البيانات
curl_exec($ch);
curl_close($ch);
?>
