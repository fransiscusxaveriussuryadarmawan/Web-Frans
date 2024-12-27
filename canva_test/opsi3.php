<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT"); // Tanggal masa lalu
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$title = "FransXeagle YouTube - Opsi 3";
$csrfToken = "YM2OIKfwWytVKoQ3tAuDuYLtjEfc6Oo3jotAwza1";
$videoId = "fdkxJJSQZ6w"; // ID video YouTube Anda
$channelId = "UC_your_channel"; // Ganti dengan ID channel Anda

require '../services/config.php';
require 'visitors.php';

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
    <meta name="description" content="Tonton video terbaru dari FransXeagle YouTube.">
    <meta name="keywords" content="YouTube, FransXeagle, Canva Pro">
    <meta http-equiv="origin-trial" content="your-origin-trial-token">
    <meta name="monetization" content="$ilp.uphold.com/your-payment-pointer">
    <meta name="google-adsense-account" content="ca-pub-your-adsense-id">

    <!-- Open Graph Tags untuk Social Media -->
    <meta property="og:title" content="<?php echo $title; ?>">
    <meta property="og:description" content="Tonton video terbaru dari FransXeagle YouTube">
    <meta property="og:image" content="https://img.youtube.com/vi/<?php echo $videoId; ?>/maxresdefault.jpg">
    <meta property="og:url" content="<?php echo $origin; ?>">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbody.js?client=ca-pub-your-adsense-id"
        crossorigin="anonymous"></script>

    <title><?php echo $title; ?></title>

    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .ad-container {
            min-height: 90px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Top Ad Container -->
    <div class="ad-container">
        <!-- AdSense Ad Unit -->
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-primary">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center">Opsi 3: Tonton Video FransXeagle</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Silakan tonton video terbaru kami untuk mendapatkan informasi lebih lanjut!</p>

                        <!-- YouTube Video Container -->
                        <div class="video-container">
                            <iframe id="youtubePlayer"
                                src="https://www.youtube.com/embed/<?php echo $videoId; ?>?enablejsapi=1&autoplay=1&rel=0&showinfo=1&controls=1&modestbranding=1"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <!-- Mid Ad Container -->
                        <div class="ad-container mt-4">
                            <!-- AdSense Ad Unit -->
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <p>Terima kasih telah mendukung channel kami! Jangan lupa like dan subscribe. 😊</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="https://www.youtube.com/channel/<?php echo $channelId; ?>?sub_confirmation=1"
                                target="_blank"
                                class="btn btn-danger me-2">
                                <i class="fab fa-youtube"></i> Subscribe Sekarang
                            </a>
                            <a href="#"
                                class="btn btn-primary"
                                onclick="shareVideo()">
                                <i class="fas fa-share"></i> Bagikan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Ad Container -->
    <div class="ad-container">
        <!-- AdSense Ad Unit -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- YouTube API dan Custom Scripts -->
    <script>
        // Load YouTube API
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var player;
        var videoStartTime;
        var minimumWatchTime = 30000; // 30 detik dalam milidetik

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('youtubePlayer', {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        function onPlayerReady(event) {
            // Mulai video secara otomatis
            event.target.playVideo();
            videoStartTime = new Date().getTime();
        }

        function onPlayerStateChange(event) {
            // Monitor status pemutaran video
            if (event.data == YT.PlayerState.PLAYING) {
                console.log('Video sedang diputar');
                if (!videoStartTime) {
                    videoStartTime = new Date().getTime();
                }
            } else if (event.data == YT.PlayerState.ENDED) {
                var watchTime = new Date().getTime() - videoStartTime;
                if (watchTime >= minimumWatchTime) {
                    console.log('Video selesai ditonton dengan durasi minimum terpenuhi');
                    // Di sini Anda bisa menambahkan kode untuk tracking atau analytics
                }
            }
        }

        // Fungsi untuk berbagi video
        function shareVideo() {
            if (navigator.share) {
                navigator.share({
                        title: '<?php echo $title; ?>',
                        text: 'Tonton video terbaru dari FransXeagle YouTube',
                        url: window.location.href
                    })
                    .then(() => console.log('Berhasil membagikan'))
                    .catch((error) => console.log('Error sharing:', error));
            } else {
                // Fallback untuk browser yang tidak mendukung Web Share API
                alert('Salin link ini: ' + window.location.href);
            }
        }

        // Fungsi untuk mencegah AdBlock
        function detectAdBlock() {
            var adBlockEnabled = false;
            var testAd = document.createElement('div');
            testAd.innerHTML = '&nbsp;';
            testAd.className = 'adsbox';
            document.body.appendChild(testAd);
            window.setTimeout(function() {
                if (testAd.offsetHeight === 0) {
                    adBlockEnabled = true;
                }
                testAd.remove();
                if (adBlockEnabled) {
                    alert('Mohon matikan AdBlock untuk menonton video ini');
                }
            }, 100);
        }

        // Jalankan deteksi AdBlock saat halaman dimuat
        window.addEventListener('load', detectAdBlock);
    </script>
</body>

</html>