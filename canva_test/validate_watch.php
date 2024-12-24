<?php
// Konfigurasi API Key YouTube
$apiKey = "AIzaSyAAxDwSET5Aoi2_sHWEVB4TXgSZELK7uZI";

// Fungsi untuk memvalidasi durasi tonton
function validateWatchTime($watchedTime, $requiredTime = 60)
{
    return $watchedTime >= $requiredTime;
}

// Ambil data dari query parameter
$watchedTime = isset($_GET['watched_time']) ? intval($_GET['watched_time']) : 0;
$videoId = isset($_GET['video_id']) ? $_GET['video_id'] : '';

// Validasi durasi tonton
if (validateWatchTime($watchedTime)) {
    // Jika validasi berhasil, tampilkan link team
    header("Location: https://www.canva.com/brand/join?token=DObC9WxzuNxOk4aevnXntA");
    exit();
} else {
    // Jika gagal, tampilkan pesan kesalahan
    echo "
    <html>
    <body>
        <h1>Gagal!</h1>
        <p>Anda belum menonton video selama waktu yang cukup. Silakan kembali dan tonton lagi.</p>
    </body>
    </html>";
}
