<?php
// Header untuk mencegah caching
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT"); // Tanggal masa lalu
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Set variabel yang digunakan dalam halaman
$title = "FransXeagle YouTube";
$csrfToken = "YM2OIKfwWytVKoQ3tAuDuYLtjEfc6Oo3jotAwza1";
session_start();
require 'services/config.php'; // Mengimpor file koneksi database
require 'pages_utama/visitors_index.php';

// Daftar domain yang diizinkan untuk mengakses halaman ini
$allowed_domains = ['https://fransxeagle.com'];

// Periksa HTTP_ORIGIN atau HOST
$origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_HOST'] ?? '';

if (in_array($origin, $allowed_domains) || $_SERVER['HTTP_HOST'] === 'fransxeagle.com') {
    // Jika domain diizinkan, kirim header Access-Control-Allow-Origin
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
} else {
    // Jika domain tidak diizinkan, kirim respon 403 Forbidden
    header("HTTP/1.1 403 Forbidden");
    exit("Access denied.");
}
?>


<!DOCTYPE html>
<html>

<head>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>

    <!-- CryptoJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <!-- Site made with Mobirise Website Builder v5.0.2, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.0.2, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/logo2.png" type="image/x-icon">
    <meta name="description" content="FransXeagle YouTube Free Informative Tutorial">

    <!-- Favicon -->
    <link href="assets/img/about.png" rel="icon">

    <title>FransXeagle YouTube</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/formstyler/jquery.formstyler.css">
    <link rel="stylesheet" href="assets/formstyler/jquery.formstyler.theme.css">
    <link rel="stylesheet" href="assets/datepicker/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <link rel="stylesheet" href="mobirise/style.css">

    <style>
        /* Tambahkan di dalam tag <style> yang sudah ada */
        .mouse-snowflake {
            position: fixed;
            background: white;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1000;
            animation: mouseFall linear forwards;
        }

        @keyframes mouseFall {
            to {
                transform: translateY(100vh);
                opacity: 0;
            }
        }

        .snowflake {
            position: fixed;
            top: -10px;
            z-index: 1000;
            color: white;
            font-size: 1.2em;
            pointer-events: none;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(0);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }

        /* Music Control Container Styling */
        .music-control,
        .volume-control,
        .music-time {
            background-color: #333;
            color: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        /* Music Icon Styling */
        .music-control i#music-icon {
            font-size: 1.5em;
            color: #1db954;
            /* Spotify-like green for play/pause icon */
            cursor: pointer;
        }

        /* Progress Bar Styling */
        #music-progress {
            width: 100%;
            height: 8px;
            background-color: #444;
            border-radius: 4px;
            appearance: none;
        }

        #music-progress::-webkit-progress-bar {
            background-color: #444;
            border-radius: 4px;
        }

        #music-progress::-webkit-progress-value {
            background-color: #1db954;
            border-radius: 4px;
        }

        #music-progress::-moz-progress-bar {
            background-color: #1db954;
            border-radius: 4px;
        }

        /* Volume Control Styling */
        .volume-control {
            width: 100%;
        }

        .volume-control input[type="range"] {
            width: 100%;
            accent-color: #1db954;
        }

        .volume-control i {
            color: #f9f9f9;
            font-size: 1.2em;
        }

        /* Time Display Styling */
        .music-time span {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-size: 1em;
        }
    </style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-44RND6686W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-44RND6686W');
    </script>

    <section class="menu cid-s1YNw91RvB" once="menu" id="menu1-1">

        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container">
                <div class="navbar-brand">
                    <img src="assets/img/about.png" alt="Logo" style="width: 50px; height: 50px; margin-right: 30px;">
                    <span class="navbar-caption-wrap">
                        <a class="navbar-caption text-white display-5" href="https://www.youtube.com/@fransxeagle">FransXeagle</a>
                    </span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="pages_utama/about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="pages_utama/apk.php">Link Apk</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="pages_utama/feature.php">Features</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="https://wa.me/6282110005254">Pricing</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="pages_utama/contacts.php">Contacts</a></li>
                        <!-- Tambahkan elemen Total Visitors di sini -->
                        <li class="nav-item">
                            <span class="nav-link link text-white display-4">
                                Visitors: <strong><?php echo $total_visitors; ?></strong>
                            </span>
                        </li>
                    </ul>
                    <div class="navbar-buttons mbr-section-btn">
                        <a class="btn btn-sm btn-primary-outline display-4" href="">GET STARTED</a>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <section class="header3 cid-s1YNmF9EpW mbr-parallax-background" id="header3-0">

        <div class="mbr-overlay" style="opacity: 0.9; background-color: rgb(0, 0, 0);"></div>
        <div class="container align-center">
            <div class="row justify-content-center">
                <div class="mbr-white col-md-12 col-lg-10">

                    <h1 class="mbr-section-title mbr-white pb-3 mbr-fonts-style display-1"><strong>FRANSXEAGLE YOUTUBE</strong><strong><br></strong></h1>
                    <p class="mbr-text pb-4 mbr-white mbr-regular mbr-fonts-style display-5">Free Informative Tutorial Such As Canva Premium | Github Student | Canva Education
                        | VCC | Virtual Number | Account Premium 💯<br>
                    </p>
                    <div class="mbr-section-btn"><a class="btn btn-sm btn-primary display-4" href="https://www.youtube.com/@fransxeagle"> SUBSCRIBE </a></div>
                    <p class="mbr-text pb-4 mbr-white mbr-regular mbr-fonts-style display-5"><br>
                    </p>
                    <p class="mbr-text pb-4 mbr-white mbr-regular mbr-fonts-style display-5">Scroll Down <br>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="features4 cid-s1YNzGfN84" id="features4-2">

        <div class="container mbr-white">
            <div class="row justify-content-center">
                <div class="card first col-12 col-md-6 col-lg-4">
                    <a href="pages_utama/canva.php" class="full-card-link">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <img src="assets/img/canva.jpeg" alt="TOD">
                            </div>
                            <div class="card-box align-center" style="margin-top: 15px;">
                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">CANVA TEAM PREMIUM</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    FREE CANVA TEAM FULL FEATURE
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card col-12 col-md-6 col-lg-4">
                    <a href="https://api.whatsapp.com/send?phone=620821-1000-5254&text=Halo%20Admin%20:)%20Saya%20Ingin%20Membeli%20Akun%20*Github%20Student%20.*%0A%0AHarga%20Satuan%20:%20Rp%20100.000%20" class="full-card-link">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <img src="assets/img/github.jpeg" alt="Github Student Pack">
                            </div>
                            <div class="card-box align-center" style="margin-top: 15px;">
                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">GITHUB STUDENT PACK</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    Full Benefit Github Student (Azure, Domain, DO, etc) @Rp 100.000
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card col-12 col-md-6 col-lg-4">
                    <a href="https://api.whatsapp.com/send?phone=620821-1000-5254&text=Halo%20Admin%20:)%20Saya%20Ingin%20Membeli%20*Virtual%20Number%20Negara%20Luar%20Negeri%20.*" class="full-card-link">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <img src="assets/img/virtual.jpg" alt="Virtual Number">
                            </div>
                            <div class="card-box align-center" style="margin-top: 15px;">
                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">VIRTUAL NUMBER</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    Get Virtual Number WhatsApp, Telegram, All APK @Rp 10.000 - @Rp 25.000
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card col-12 col-md-6 col-lg-4">
                    <a href="#" class="full-card-link">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <img src="assets/img/credit.jpeg" alt="Virtual Credit Card">
                            </div>
                            <div class="card-box align-center" style="margin-top: 15px;">
                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">VIRTUAL CREDIT CARD</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    Get Virtual Credit Card 2024 @Rp 15.000
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card col-12 col-md-6 col-lg-4">
                    <a href="https://api.whatsapp.com/send?phone=620821-1000-5254&text=Halo%20Admin%20:)%20Saya%20Ingin%20Membeli%20*Email%20Yang%20Education%20.*%0A%0AEmail%20Domain%20EDU%20:%20Rp%2015.000%20%0AEmail%20Domain%20AC.ID%20:%20Rp%2025.000" class="full-card-link">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <img src="assets/img/edu.png" alt="Email EDU">
                            </div>
                            <div class="card-box align-center" style="margin-top: 15px;">
                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">EMAIL EDU</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    domain.edu = Rp 15.000<br>domain.ac.id (indonesia) = Rp 25.000
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card col-12 col-md-6 col-lg-4">
                    <a href="https://api.whatsapp.com/send?phone=620821-1000-5254&text=Halo%20Admin%20:)%20Saya%20Ingin%20Membeli%20*Owner%20Canva%20Education%20.*%0A%0AHarga%20Satuan%20:%20Rp%20100.000%20" class="full-card-link">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <img src="assets/img/com.png" alt="Owner Canva EDU">
                            </div>
                            <div class="card-box align-center" style="margin-top: 15px;">
                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">OWNER CANVA EDU</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    Owner Canva Education Lifetime @Rp 100.000
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="content2 cid-s1YQ6E1SFC" id="content2-e">


        <section class="testimonials1 cid-s1YPV5pGou" id="testimonials1-c">



            <div class="container-fluid mbr-white">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-10 pb-5">
                        <h4 class="main-title align-center pb-3 mbr-bold mbr-black mbr-fonts-style display-2">Customer Testimonials</h4>
                        <h5 class="main-subtitle align-center mbr-regular mbr-black mbr-fonts-style display-7">Silakan cek testimoni untuk meningkatkan
                            kepercayaan (bagi yang masih ragu)</h5>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="card col-12 col-md-6 col-lg-4">
                        <a href="https://drive.google.com/drive/folders/1j1fqOTIg6M_o88ZiAeLZjByJ19EyJ04I?usp=sharing">
                            <div class="card-wrapper align-center">
                                <div class="card-box ">
                                    <h3 class="mbr-subtitle mbr-semibold mbr-fonts-style display-5">Click This Picture</h3>
                                </div>
                                <img src="assets/img/check.jpeg" alt="TOD">
                            </div>
                    </div>
                    </a>
                </div>
            </div>
            </div>
            </div>
        </section>



        <section class="map1 cid-s1YPq9DXRB" id="map1-6">



            <div class="google-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCy9r70T3NYf3PhvVflTo0_zdif2_IoIYs&amp;q=place_id:ChIJn6wOs6lZwokRLKy1iqRcoKw" allowfullscreen=""></iframe></div>
        </section>

        <section class="contacts2 cid-s1YPyUn2on" id="contacts2-9">


            <div class="container mbr-white">
                <div class="row justify-content-center">
                    <div class="card first col-12 col-md-6 col-lg-4">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <span class="mbr-iconfont mobi-mbri-phone mobi-mbri"></span>
                            </div>
                            <div class="card-box align-center">

                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">+62 821 3861 6235</h4>
                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">+62 821 1000 5254</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    Contact Me If You Need Help</p>

                                <div class="link-wrapper">
                                    <span class="mbr-iconfont mobi-mbri-right mobi-mbri"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 col-md-6 col-lg-4">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <span class="mbr-iconfont mobi-mbri-letter mobi-mbri"></span>
                            </div>
                            <div class="card-box align-center">

                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">admin@fransxeagle.com</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    Contact Me If You Need Help</p>

                                <div class="link-wrapper">
                                    <span class="mbr-iconfont mobi-mbri-right mobi-mbri"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card last col-12 col-md-6 col-lg-4">
                        <div class="card-wrapper align-center">
                            <div class="img-wrapper">
                                <span class="mbr-iconfont mobi-mbri-map-pin mobi-mbri"></span>
                            </div>
                            <div class="card-box align-center">

                                <h4 class="mbr-section-title pb-2 mbr-semibold mbr-fonts-style display-5">Office Street :XD</h4>
                                <p class="mbr-section-text align-center mbr-regular pb-2 mbr-fonts-style display-7">
                                    Privacy Address</p>

                                <div class="link-wrapper">
                                    <span class="mbr-iconfont mobi-mbri-right mobi-mbri"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kontrol musik -->
                    <div class="music-control text-center" onclick="toggleMusic()">
                        <i id="music-icon" class="fas fa-play-circle"></i> Music
                    </div>
                    <audio id="background-music" type="audio/mpeg"></audio>
                    <progress id="music-progress" value="0" max="100" style="width: 100%;"></progress>
                    <div class="music-time">
                        <span id="current-time">0:00</span>
                        <span id="duration">0:00</span>
                    </div>

                    <!-- Kontrol Volume -->
                    <div class="volume-control">
                        <i class="fas fa-volume-down"></i>
                        <input type="range" id="volume-control" min="0" max="1" step="0.1" value="0.5">
                        <i class="fas fa-volume-up"></i>
                    </div>
                </div>
            </div>
        </section>

        <section class="footer1 cid-s1YPqSpOCZ" once="footers" id="footer1-7">


            <div class="container">
                <div class="row mbr-white justify-content-center">
                    <div class="col-12 col-lg-6 col-md-6">
                        <p class="mbr-text1 align-left mbr-fonts-style align-left display-7">Happy Ending</p>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6">
                        <p class="mbr-text2 align-right mbr-fonts-style align-left display-7">© 2024 FransXeagle by <a href="#" class="text-secondary">Kiko</a></p>
                    </div>
                </div>
            </div>
        </section>


        <script src="assets/web/assets/jquery/jquery.min.js"></script>
        <script src="assets/popper/popper.min.js"></script>
        <script src="assets/tether/tether.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/smoothscroll/smooth-scroll.js"></script>
        <script src="assets/dropdown/js/nav-dropdown.js"></script>
        <script src="assets/dropdown/js/navbar-dropdown.js"></script>
        <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
        <script src="assets/parallax/jarallax.min.js"></script>
        <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
        <script src="assets/playervimeo/vimeo_player.js"></script>
        <script src="assets/formstyler/jquery.formstyler.js"></script>
        <script src="assets/formstyler/jquery.formstyler.min.js"></script>
        <script src="assets/datepicker/jquery.datetimepicker.full.js"></script>
        <script src="assets/theme/js/script.js"></script>
        <script src="assets/formoid/formoid.min.js"></script>

        <script>
            console.log = function() {};

            setInterval(function() {
                if (window.console && (console.__proto__.dir || console.__proto__.log)) {
                    const before = new Date();
                    debugger;
                    const after = new Date();
                    if (after - before > 100) {
                        alert("Developer Tools terdeteksi! Anda tidak diizinkan mengakses kode sumber ini.");
                    }
                }
            }, 1000);

            document.addEventListener("keydown", function(event) {
                if (event.ctrlKey && (event.key === "u" || event.key === "U")) {
                    event.preventDefault();
                }
                if ((event.ctrlKey && event.shiftKey && (event.key === "i" || event.key === "I")) || event.keyCode === 123) {
                    event.preventDefault();
                }
            });

            document.addEventListener("keydown", function(event) {

                if (event.ctrlKey) {
                    event.preventDefault();
                }

                if (event.keyCode == 123) {
                    event.preventDefault();
                }

            })

            document.addEventListener('contextmenu',
                event => event.preventDefault()
            )

            const playlist = [
                "assets/music/1.mp3",
                "assets/music/2.mp3",
                "assets/music/3.mp3",
                "assets/music/4.mp3",
                "assets/music/5.mp3",
                "assets/music/6.mp3"
            ];

            const backgroundMusic = document.getElementById("background-music");
            const musicIcon = document.getElementById("music-icon");
            const musicProgress = document.getElementById("music-progress");
            const currentTimeDisplay = document.getElementById("current-time");
            const durationDisplay = document.getElementById("duration");
            const volumeControl = document.getElementById("volume-control");

            let currentSongIndex = Math.floor(Math.random() * playlist.length); // Pilih lagu acak untuk awal

            // Atur volume awal
            backgroundMusic.volume = 0.5;

            function loadSong(index) {
                backgroundMusic.src = playlist[index];
                backgroundMusic.load();
                backgroundMusic.play().catch(error => {
                    console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.");
                });
                updateIcon();
            }

            function toggleMusic() {
                if (backgroundMusic.paused) {
                    backgroundMusic.play();
                } else {
                    backgroundMusic.pause();
                }
                updateIcon();
            }

            function updateIcon() {
                if (backgroundMusic.paused) {
                    musicIcon.classList.replace("fa-pause-circle", "fa-play-circle");
                } else {
                    musicIcon.classList.replace("fa-play-circle", "fa-pause-circle");
                }
            }

            backgroundMusic.onloadedmetadata = () => {
                durationDisplay.textContent = formatTime(backgroundMusic.duration);
            };

            backgroundMusic.ontimeupdate = () => {
                const progress = (backgroundMusic.currentTime / backgroundMusic.duration) * 100;
                musicProgress.value = progress;
                currentTimeDisplay.textContent = formatTime(backgroundMusic.currentTime);
            };

            backgroundMusic.onended = () => {
                currentSongIndex = (currentSongIndex + 1) % playlist.length; // Lanjut ke lagu berikutnya
                loadSong(currentSongIndex);
            };

            function formatTime(time) {
                const minutes = Math.floor(time / 60);
                const seconds = Math.floor(time % 60).toString().padStart(2, '0');
                return `${minutes}:${seconds}`;
            }

            volumeControl.addEventListener("input", () => {
                backgroundMusic.volume = volumeControl.value;
            });

            // Muat dan mainkan lagu pertama (acak)
            loadSong(currentSongIndex);

            // Coba otomatis memutar musik saat halaman dimuat
            window.onload = function() {
                backgroundMusic.play().catch(error => {
                    console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.");
                });
            };

            console.log = function() {};

            setInterval(function() {
                if (window.console && (console.__proto__.dir || console.__proto__.log)) {
                    const before = new Date();
                    debugger;
                    const after = new Date();
                    if (after - before > 100) {
                        alert("Developer Tools terdeteksi! Anda tidak diizinkan mengakses kode sumber ini.");
                    }
                }
            }, 1000);

            document.addEventListener("keydown", function(event) {
                if (event.ctrlKey && (event.key === "u" || event.key === "U")) {
                    event.preventDefault();
                }
                if ((event.ctrlKey && event.shiftKey && (event.key === "i" || event.key === "I")) || event.keyCode === 123) {
                    event.preventDefault();
                }
            });

            document.addEventListener("keydown", function(event) {

                if (event.ctrlKey) {
                    event.preventDefault();
                }

                if (event.keyCode == 123) {
                    event.preventDefault();
                }

            })

            document.addEventListener('contextmenu',
                event => event.preventDefault()
            )

            let snowflakeCount = 0; // Variabel global untuk menghitung kepingan salju
            const maxSnowflakes = 20; // Batas maksimal kepingan salju
            function createSnowflake() {
                if (snowflakeCount >= maxSnowflakes) return; // Cek batas maksimal

                const snowflake = document.createElement("div");
                snowflake.classList.add("snowflake");
                snowflake.innerHTML = "❄️";

                // Posisi awal dan ukuran acak
                snowflake.style.left = Math.random() * window.innerWidth + "px";
                snowflake.style.fontSize = Math.random() * 10 + 10 + "px"; // ukuran antara 10px - 20px
                snowflake.style.animationDuration = Math.random() * 5 + 5 + "s"; // 5s hingga 10s
                snowflake.style.animationDelay = Math.random() * 3 + "s"; // jeda acak antara 0s hingga 3s

                // Tambahkan elemen ke body dan hapus setelah animasi selesai
                document.body.appendChild(snowflake);
                snowflakeCount++; // Tambah hitungan kepingan salju

                snowflake.addEventListener("animationend", () => {
                    snowflake.remove();
                    snowflakeCount--; // Kurangi hitungan saat salju dihapus
                });
            }



            setInterval(createSnowflake, 1000);

            // Ganti script efek salju mouse yang sebelumnya dengan yang ini
            document.addEventListener('DOMContentLoaded', () => {
                const container = document.body;
                let mouseX = 0;
                let mouseY = 0;
                let lastCreateTime = 0;

                // Fungsi untuk membuat kepingan salju di sekitar mouse
                function createMouseSnowflake(x, y) {
                    const currentTime = Date.now();
                    // Tambahkan delay minimal 100ms antara pembuatan salju
                    if (currentTime - lastCreateTime < 100) return;

                    lastCreateTime = currentTime;

                    const snowflake = document.createElement('div');
                    snowflake.className = 'mouse-snowflake';

                    // Ukuran lebih kecil
                    const size = Math.random() * 3 + 1; // Ukuran 1-4px
                    snowflake.style.width = size + 'px';
                    snowflake.style.height = size + 'px';

                    // Offset yang lebih besar agar lebih tersebar
                    const offsetX = (Math.random() - 0.5) * 30;
                    const offsetY = (Math.random() - 0.5) * 10;
                    snowflake.style.left = (x + offsetX) + 'px';
                    snowflake.style.top = (y + offsetY) + 'px';

                    // Durasi jatuh yang lebih cepat
                    const duration = Math.random() * 2 + 1; // 1-3 detik
                    snowflake.style.animation = `mouseFall ${duration}s linear forwards`;

                    container.appendChild(snowflake);

                    setTimeout(() => {
                        snowflake.remove();
                    }, duration * 1000);
                }

                // Tambahkan throttling untuk mousemove
                let isThrottled = false;

                document.addEventListener('mousemove', (e) => {
                    if (isThrottled) return;

                    mouseX = e.clientX;
                    mouseY = e.clientY;

                    // Kurangi probabilitas pembuatan salju
                    if (Math.random() < 0.15) { // Dikurangi dari 0.3 menjadi 0.15
                        createMouseSnowflake(mouseX, mouseY);
                    }

                    // Throttle mouse movement
                    isThrottled = true;
                    setTimeout(() => {
                        isThrottled = false;
                    }, 50); // 50ms delay
                });
            });
        </script>

        </body>

</html>