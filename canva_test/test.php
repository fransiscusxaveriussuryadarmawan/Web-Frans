<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$title = "FransXeagle YouTube";
$csrfToken = "YM2OIKfwWytVKoQ3tAuDuYLtjEfc6Oo3jotAwza1";

require '../services/config.php';
require 'visitors.php';

// Daftar domain yang diizinkan
$allowed_domains = ['https://fransxeagle.com', 'http://localhost'];
$origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_HOST'] ?? '';

if (in_array($origin, $allowed_domains) || $_SERVER['HTTP_HOST'] === 'fransxeagle.com' || $_SERVER['HTTP_HOST'] === 'localhost') {
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
} else {
    header("HTTP/1.1 403 Forbidden");
    header("Location: https://fransxeagle.com");
    exit("Silakan Akses di https://fransxeagle.com");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .card {
            margin: 20px auto;
            max-width: 600px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .btn {
            border-radius: 25px;
        }

        #watch-status {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center my-5">Join FransXeagle Team</h1>
        <div class="row justify-content-center">
            <!-- Opsi 1 -->
            <div class="col-lg-4">
                <div class="card p-4">
                    <h3 class="text-center text-primary">Opsi 1</h3>
                    <p class="text-center">Join dengan Subscribe, Like, dan Follow.</p>
                    <a href="unlock_link" class="btn btn-primary btn-block">Join via Subscribe</a>
                </div>
            </div>
            <!-- Opsi 2 -->
            <div class="col-lg-4">
                <div class="card p-4">
                    <h3 class="text-center text-secondary">Opsi 2</h3>
                    <p class="text-center">Join dengan bayar Rp 1.000.</p>
                    <a href="join_instan" class="btn btn-secondary btn-block">Join via QRIS</a>
                </div>
            </div>
            <!-- Opsi 3 -->
            <div class="col-lg-4">
                <div class="card p-4">
                    <h3 class="text-center text-success">Opsi 3</h3>
                    <p class="text-center">Tonton video minimal <b>5 menit</b>.</p>
                    <button id="verify-watch" class="btn btn-success btn-block">Verify Watch Time</button>
                    <p id="watch-status" class="text-center mt-3 text-danger"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // API YouTube Configuration
        const API_KEY = 'YOUR_YOUTUBE_API_KEY'; // Ganti dengan API Key YouTube
        const VIDEO_ID = 'YOUR_VIDEO_ID'; // Ganti dengan ID video Anda
        const MIN_WATCH_TIME = 300; // Minimum waktu tonton dalam detik (5 menit)

        // Event Listener untuk Verifikasi Opsi 3
        document.getElementById('verify-watch').addEventListener('click', async () => {
            const watchStatus = document.getElementById('watch-status');
            watchStatus.style.display = 'none';

            try {
                // Panggil API YouTube
                const response = await fetch(`https://www.googleapis.com/youtube/v3/videos?part=statistics&id=${VIDEO_ID}&key=${API_KEY}`);
                const data = await response.json();

                // Validasi Data API
                if (data.items && data.items.length > 0) {
                    const viewCount = parseInt(data.items[0].statistics.viewCount, 10);
                    console.log(`Current View Count: ${viewCount}`);

                    // Simulasi validasi sederhana berdasarkan view count
                    if (viewCount > 0) {
                        alert('Berhasil! Anda telah memenuhi syarat untuk bergabung.');
                        window.location.href = 'redirectToCanva.php';
                    } else {
                        watchStatus.textContent = 'Silakan tonton video hingga 5 menit untuk melanjutkan.';
                        watchStatus.style.display = 'block';
                    }
                } else {
                    watchStatus.textContent = 'Gagal memverifikasi tontonan video. Coba lagi.';
                    watchStatus.style.display = 'block';
                }
            } catch (error) {
                console.error('Error fetching video data:', error);
                watchStatus.textContent = 'Terjadi kesalahan. Coba lagi.';
                watchStatus.style.display = 'block';
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>