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
$allowed_domains = ['https://fransxeagle.com', 'http://localhost'];

// Periksa HTTP_ORIGIN atau HOST
$origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_HOST'] ?? '';

if (in_array($origin, $allowed_domains) || $_SERVER['HTTP_HOST'] === 'fransxeagle.com' || $_SERVER['HTTP_HOST'] === 'localhost') {
    // Jika domain diizinkan, kirim header Access-Control-Allow-Origin
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
} else {
    // Jika domain tidak diizinkan, kirim respon 403 Forbidden
    header("HTTP/1.1 403 Forbidden");
    header("Location: https://fransxeagle.com");
    exit("Silakan Akses di https://fransxeagle.com");
}
?>

<!doctypehtml>

    <head>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6567701292496187"
            crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel=stylesheet>
        <link href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css rel=stylesheet>
        <link href=https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css rel=stylesheet>
        <script src=https://code.jquery.com/jquery-3.6.0.min.js></script>
        <script src=https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js></script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js></script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js></script>
        <meta charset=UTF-8>
        <meta content="IE=edge" http-equiv=X-UA-Compatible>
        <meta content="Mobirise v5.0.2, mobirise.com" name=generator>
        <meta content="width=device-width,initial-scale=1,minimum-scale=1" name=viewport>
        <link href=assets/images/logo2.png rel="shortcut icon" type=image/x-icon>
        <meta content="FransXeagle YouTube Free Informative Tutorial" name=description>
        <link href=assets/img/about.png rel=icon>
        <title>FransXeagle YouTube</title>
        <link href=assets/web/assets/mobirise-icons/mobirise-icons.css rel=stylesheet>
        <link href=assets/web/assets/mobirise-icons2/mobirise2.css rel=stylesheet>
        <link href=assets/tether/tether.min.css rel=stylesheet>
        <link href=assets/bootstrap/css/bootstrap.min.css rel=stylesheet>
        <link href=assets/bootstrap/css/bootstrap-grid.min.css rel=stylesheet>
        <link href=assets/bootstrap/css/bootstrap-reboot.min.css rel=stylesheet>
        <link href=assets/dropdown/css/style.css rel=stylesheet>
        <link href=assets/formstyler/jquery.formstyler.css rel=stylesheet>
        <link href=assets/formstyler/jquery.formstyler.theme.css rel=stylesheet>
        <link href=assets/datepicker/jquery.datetimepicker.min.css rel=stylesheet>
        <link href=assets/socicon/css/styles.css rel=stylesheet>
        <link href=assets/theme/css/style.css rel=stylesheet>
        <link href=assets/mobirise/css/mbr-additional.css rel=preload as=style>
        <link href=assets/mobirise/css/mbr-additional.css rel=stylesheet>
        <link href=mobirise/style.css rel=stylesheet>
    </head>

    <style>
        .mouse-snowflake {
            position: fixed;
            background: #fff;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1000;
            animation: mouseFall linear forwards
        }

        @keyframes mouseFall {
            to {
                transform: translateY(100vh);
                opacity: 0
            }
        }

        .snowflake {
            position: fixed;
            top: -10px;
            z-index: 1000;
            color: #fff;
            font-size: 1.2em;
            pointer-events: none;
            animation: fall linear infinite
        }

        @keyframes fall {
            0% {
                transform: translateY(0);
                opacity: 1
            }

            100% {
                transform: translateY(100vh);
                opacity: 0
            }
        }

        .music-control,
        .music-time,
        .volume-control {
            background-color: #333;
            color: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px
        }

        .music-control i#music-icon {
            font-size: 1.5em;
            color: #1db954;
            cursor: pointer
        }

        #music-progress {
            width: 100%;
            height: 8px;
            background-color: #444;
            border-radius: 4px;
            appearance: none
        }

        #music-progress::-webkit-progress-bar {
            background-color: #444;
            border-radius: 4px
        }

        #music-progress::-webkit-progress-value {
            background-color: #1db954;
            border-radius: 4px
        }

        #music-progress::-moz-progress-bar {
            background-color: #1db954;
            border-radius: 4px
        }

        .volume-control {
            width: 100%
        }

        .volume-control input[type=range] {
            width: 100%;
            accent-color: #1db954
        }

        .volume-control i {
            color: #f9f9f9;
            font-size: 1.2em
        }

        .music-time span {
            font-family: Poppins, sans-serif;
            font-weight: 600;
            font-size: 1em
        }
    </style>
    <script src="https://www.googletagmanager.com/gtag/js?id=G-44RND6686W" async></script>
    <script>
        function gtag() {
            dataLayer.push(arguments)
        }
        window.dataLayer = window.dataLayer || [], gtag("js", new Date), gtag("config", "G-44RND6686W")
    </script>
    <section class="cid-s1YNw91RvB menu" id=menu1-1 once=menu>
        <nav class="navbar navbar-dropdown navbar-expand-lg navbar-fixed-top">
            <div class=container>
                <div class=navbar-brand><img alt=Logo src=assets/img/about.png style=width:50px;height:50px;margin-right:30px> <span class=navbar-caption-wrap><a href=https://www.youtube.com/@fransxeagle class="display-5 navbar-caption text-white">FransXeagle</a></span></div><button aria-controls=navbarNavAltMarkup aria-expanded=false aria-label="Toggle navigation" class=navbar-toggler data-target=#navbarSupportedContent data-toggle=collapse type=button>
                    <div class=hamburger><span></span> <span></span> <span></span> <span></span></div>
                </button>
                <div class="collapse navbar-collapse" id=navbarSupportedContent>
                    <ul class="nav-dropdown navbar-nav" data-app-modern-menu=true>
                        <li class=nav-item><a href="" class="display-4 link nav-link text-white">Home</a>
                        <li class=nav-item><a href=about class="display-4 link nav-link text-white">About</a>
                        <li class=nav-item><a href=apk class="display-4 link nav-link text-white">Link Apk</a>
                        <li class=nav-item><a href=feature class="display-4 link nav-link text-white">Features</a>
                        <li class=nav-item><a href=https://wa.me/6282110005254 class="display-4 link nav-link text-white">Pricing</a>
                        <li class=nav-item><a href=contacts class="display-4 link nav-link text-white">Contacts</a>
                        <li class=nav-item><span class="display-4 link nav-link text-white">Visitors: <strong><?php echo $total_visitors; ?></strong></span>
                    </ul>
                    <div class="mbr-section-btn navbar-buttons"><a href="" class="display-4 btn btn-sm btn-primary-outline">GET STARTED</a></div>
                </div>
            </div>
        </nav>
    </section>
    <section class="cid-s1YNmF9EpW header3 mbr-parallax-background" id=header3-0>
        <div class=mbr-overlay style=opacity:.9;background-color:#000></div>
        <div class="align-center container">
            <div class="justify-content-center row">
                <div class="mbr-white col-lg-10 col-md-12">
                    <h1 class="mbr-fonts-style pb-3 display-1 mbr-section-title mbr-white"><strong>FRANSXEAGLE YOUTUBE</strong><strong><br></strong></h1>
                    <p class="mbr-fonts-style display-5 mbr-regular mbr-text mbr-white pb-4">Free Informative Tutorial Such As Canva Premium | Github Student | Canva Education | VCC | Virtual Number | Account Premium 💯<br>
                    <div class=mbr-section-btn><a href=https://www.youtube.com/@fransxeagle class="display-4 btn btn-sm btn-primary">SUBSCRIBE</a></div>
                    <p class="mbr-fonts-style display-5 mbr-regular mbr-text mbr-white pb-4"><br>
                    <p class="mbr-fonts-style display-5 mbr-regular mbr-text mbr-white pb-4">Scroll Down<br>
                </div>
            </div>
        </div>
    </section>
    <section class="cid-s1YNzGfN84 features4" id=features4-2>
        <div class="mbr-white container">
            <div class="justify-content-center row">
                <div class="col-12 col-md-6 card col-lg-4 first"><a href=canva class=full-card-link>
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><img alt=TOD src=assets/img/canva.jpeg></div>
                            <div class="align-center card-box" style=margin-top:15px>
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">CANVA TEAM PREMIUM</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">FREE CANVA TEAM FULL FEATURE
                            </div>
                        </div>
                    </a></div>
                <div class="col-12 col-md-6 card col-lg-4"><a href="https://api.whatsapp.com/send?phone=620821-1000-5254&text=Halo%20Admin%20:)%20Saya%20Ingin%20Membeli%20Akun%20*Github%20Student%20.*%0A%0AHarga%20Satuan%20:%20Rp%20100.000%20" class=full-card-link>
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><img alt="Github Student Pack" src=assets/img/github.jpeg></div>
                            <div class="align-center card-box" style=margin-top:15px>
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">GITHUB STUDENT PACK</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">Full Benefit Github Student (Azure, Domain, DO, etc) @Rp 100.000
                            </div>
                        </div>
                    </a></div>
                <div class="col-12 col-md-6 card col-lg-4"><a href="https://api.whatsapp.com/send?phone=620821-1000-5254&text=Halo%20Admin%20:)%20Saya%20Ingin%20Membeli%20*Virtual%20Number%20Negara%20Luar%20Negeri%20.*" class=full-card-link>
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><img alt="Virtual Number" src=assets/img/virtual.jpg></div>
                            <div class="align-center card-box" style=margin-top:15px>
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">VIRTUAL NUMBER</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">Get Virtual Number WhatsApp, Telegram, All APK @Rp 10.000 - @Rp 25.000
                            </div>
                        </div>
                    </a></div>
                <div class="col-12 col-md-6 card col-lg-4"><a href=# class=full-card-link>
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><img alt="Virtual Credit Card" src=assets/img/credit.jpeg></div>
                            <div class="align-center card-box" style=margin-top:15px>
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">VIRTUAL CREDIT CARD</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">Get Virtual Credit Card 2024 @Rp 15.000
                            </div>
                        </div>
                    </a></div>
                <div class="col-12 col-md-6 card col-lg-4"><a href="https://api.whatsapp.com/send?phone=620821-1000-5254&text=Halo%20Admin%20:)%20Saya%20Ingin%20Membeli%20Email%20Yang%20Education%20.%0A%0ASilakan%20pilih%20email%20yang%20ingin%20Anda%20beli%20:%0A1.%20Domain%20EDU%20(Rp%2020.000)%0A2.%20Domain%20AC.ID%20(Rp%2015.000)%0A%0AMohon%20konfirmasinya.%20Terima%20kasih!)" class=full-card-link>
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><img alt="Email EDU" src=assets/img/edu.png></div>
                            <div class="align-center card-box" style=margin-top:15px>
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">EMAIL EDU</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">domain.edu = Rp 20.000<br>domain.ac.id (indonesia) = Rp 15.000
                            </div>
                        </div>
                    </a></div>
                <div class="col-12 col-md-6 card col-lg-4"><a href="https://api.whatsapp.com/send?phone=620821-1000-5254&text=Halo%20Admin%20:)%20Saya%20Ingin%20Membeli%20*Owner%20Canva%20Education%20.*%0A%0AHarga%20Satuan%20:%20Rp%20200.000%20" class=full-card-link>
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><img alt="Owner Canva EDU" src=assets/img/com.png></div>
                            <div class="align-center card-box" style=margin-top:15px>
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">OWNER CANVA EDU</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">Owner Canva Education Lifetime @Rp 200.000
                            </div>
                        </div>
                    </a></div>
            </div>
        </div>
    </section>
    <section class="cid-s1YQ6E1SFC content2" id=content2-e>
        <section class="cid-s1YPV5pGou testimonials1" id=testimonials1-c>
            <div class="mbr-white container-fluid">
                <div class="justify-content-center row">
                    <div class="col-12 col-lg-10 col-md-12 pb-5">
                        <h4 class="align-center mbr-fonts-style mbr-black display-2 main-title mbr-bold pb-3">Customer Testimonials</h4>
                        <h5 class="align-center mbr-fonts-style display-7 mbr-regular main-subtitle mbr-black">Silakan cek testimoni untuk meningkatkan kepercayaan (bagi yang masih ragu)</h5>
                    </div>
                </div>
                <div class="justify-content-center row">
                    <div class="col-12 col-md-6 card col-lg-4"><a href="https://drive.google.com/drive/folders/1j1fqOTIg6M_o88ZiAeLZjByJ19EyJ04I?usp=sharing">
                            <div class="align-center card-wrapper">
                                <div class=card-box>
                                    <h3 class="mbr-fonts-style display-5 mbr-semibold mbr-subtitle">Click This Picture</h3>
                                </div><img alt=TOD src=assets/img/check.jpeg>
                            </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- AdSense Code Start -->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6567701292496187"
            crossorigin="anonymous"></script>
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-6567701292496187"
            data-ad-slot="9068773057"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        <!-- AdSense Code End -->

        <section class="cid-s1YPq9DXRB map1" id=map1-6>
            <div class=google-map><iframe allowfullscreen frameborder=0 src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCy9r70T3NYf3PhvVflTo0_zdif2_IoIYs&q=place_id:ChIJn6wOs6lZwokRLKy1iqRcoKw" style=border:0></iframe></div>
        </section>
        <section class="cid-s1YPyUn2on contacts2" id=contacts2-9>
            <div class="mbr-white container">
                <div class="justify-content-center row">
                    <div class="col-12 col-md-6 card col-lg-4 first">
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><span class="mbr-iconfont mobi-mbri mobi-mbri-phone"></span></div>
                            <div class="align-center card-box">
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">+62 821 3861 6235</h4>
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">+62 821 1000 5254</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">Contact Me If You Need Help
                                <div class=link-wrapper><span class="mbr-iconfont mobi-mbri mobi-mbri-right"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 card col-lg-4">
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><span class="mbr-iconfont mobi-mbri mobi-mbri-letter"></span></div>
                            <div class="align-center card-box">
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">admin@fransxeagle.com</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">Contact Me If You Need Help
                                <div class=link-wrapper><span class="mbr-iconfont mobi-mbri mobi-mbri-right"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 card col-lg-4 last">
                        <div class="align-center card-wrapper">
                            <div class=img-wrapper><span class="mbr-iconfont mobi-mbri mobi-mbri-map-pin"></span></div>
                            <div class="align-center card-box">
                                <h4 class="mbr-fonts-style pb-2 display-5 mbr-section-title mbr-semibold">Office Street :XD</h4>
                                <p class="align-center mbr-fonts-style display-7 mbr-regular mbr-section-text pb-2">Privacy Address
                                <div class=link-wrapper><span class="mbr-iconfont mobi-mbri mobi-mbri-right"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="music-control text-center" onclick=toggleMusic()><i class="fas fa-play-circle" id=music-icon></i> Music</div><audio id=background-music type=audio/mpeg></audio><progress id=music-progress max=100 style=width:100% value=0></progress>
                    <div class=music-time><span id=current-time>0:00</span> <span id=duration>0:00</span></div>
                    <div class=volume-control><i class="fas fa-volume-down"></i> <input id=volume-control max=1 min=0 step=0.1 type=range value=0.5> <i class="fas fa-volume-up"></i></div>
                </div>
            </div>
        </section>
        <section class="cid-s1YPqSpOCZ footer1" id=footer1-7 once=footers>
            <div class=container>
                <div class="mbr-white justify-content-center row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <p class="mbr-fonts-style align-left align-left display-7 mbr-text1">Happy Ending
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <p class="mbr-fonts-style align-left display-7 align-right mbr-text2">© 2024 FransXeagle by <a href=# class=text-secondary>Kiko</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->

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

        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->
        <!-- MADE BY GABRIELA (MY GF) -->

        <script>
            console.log = function() {}, setInterval((function() {
                if (window.console && (console.__proto__.dir || console.__proto__.log)) {
                    const e = new Date;
                    new Date - e > 100 && alert("Developer Tools terdeteksi! Anda tidak diizinkan mengakses kode sumber ini.")
                }
            }), 1e3), document.addEventListener("keydown", (function(e) {
                !e.ctrlKey || "u" !== e.key && "U" !== e.key || e.preventDefault(), (e.ctrlKey && e.shiftKey && ("i" === e.key || "I" === e.key) || 123 === e.keyCode) && e.preventDefault()
            })), document.addEventListener("keydown", (function(e) {
                e.ctrlKey && e.preventDefault(), 123 == e.keyCode && e.preventDefault()
            })), document.addEventListener("contextmenu", (e => e.preventDefault()));
            const playlist = ["assets/music/1.mp3", "assets/music/2.mp3", "assets/music/3.mp3", "assets/music/4.mp3", "assets/music/5.mp3", "assets/music/6.mp3"],
                backgroundMusic = document.getElementById("background-music"),
                musicIcon = document.getElementById("music-icon"),
                musicProgress = document.getElementById("music-progress"),
                currentTimeDisplay = document.getElementById("current-time"),
                durationDisplay = document.getElementById("duration"),
                volumeControl = document.getElementById("volume-control");
            let currentSongIndex = Math.floor(Math.random() * playlist.length);

            function loadSong(e) {
                backgroundMusic.src = playlist[e], backgroundMusic.load(), backgroundMusic.play().catch((e => {
                    console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.")
                })), updateIcon()
            }

            function toggleMusic() {
                backgroundMusic.paused ? backgroundMusic.play() : backgroundMusic.pause(), updateIcon()
            }

            function updateIcon() {
                backgroundMusic.paused ? musicIcon.classList.replace("fa-pause-circle", "fa-play-circle") : musicIcon.classList.replace("fa-play-circle", "fa-pause-circle")
            }

            function formatTime(e) {
                return `${Math.floor(e/60)}:${Math.floor(e%60).toString().padStart(2,"0")}`
            }
            backgroundMusic.volume = .5, backgroundMusic.onloadedmetadata = () => {
                durationDisplay.textContent = formatTime(backgroundMusic.duration)
            }, backgroundMusic.ontimeupdate = () => {
                const e = backgroundMusic.currentTime / backgroundMusic.duration * 100;
                musicProgress.value = e, currentTimeDisplay.textContent = formatTime(backgroundMusic.currentTime)
            }, backgroundMusic.onended = () => {
                currentSongIndex = (currentSongIndex + 1) % playlist.length, loadSong(currentSongIndex)
            }, volumeControl.addEventListener("input", (() => {
                backgroundMusic.volume = volumeControl.value
            })), loadSong(currentSongIndex), window.onload = function() {
                backgroundMusic.play().catch((e => {
                    console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.")
                }))
            }, console.log = function() {}, setInterval((function() {
                if (window.console && (console.__proto__.dir || console.__proto__.log)) {
                    const e = new Date;
                    new Date - e > 100 && alert("Developer Tools terdeteksi! Anda tidak diizinkan mengakses kode sumber ini.")
                }
            }), 1e3), document.addEventListener("keydown", (function(e) {
                !e.ctrlKey || "u" !== e.key && "U" !== e.key || e.preventDefault(), (e.ctrlKey && e.shiftKey && ("i" === e.key || "I" === e.key) || 123 === e.keyCode) && e.preventDefault()
            })), document.addEventListener("keydown", (function(e) {
                e.ctrlKey && e.preventDefault(), 123 == e.keyCode && e.preventDefault()
            })), document.addEventListener("contextmenu", (e => e.preventDefault()));
            let snowflakeCount = 0;
            const maxSnowflakes = 20;

            function createSnowflake() {
                if (snowflakeCount >= 20) return;
                const e = document.createElement("div");
                e.classList.add("snowflake"), e.innerHTML = "❄️", e.style.left = Math.random() * window.innerWidth + "px", e.style.fontSize = 10 * Math.random() + 10 + "px", e.style.animationDuration = 5 * Math.random() + 5 + "s", e.style.animationDelay = 3 * Math.random() + "s", document.body.appendChild(e), snowflakeCount++, e.addEventListener("animationend", (() => {
                    e.remove(), snowflakeCount--
                }))
            }
            setInterval(createSnowflake, 1e3), document.addEventListener("DOMContentLoaded", (() => {
                const e = document.body;
                let n = 0,
                    t = 0,
                    o = 0;
                let a = !1;
                document.addEventListener("mousemove", (c => {
                    a || (n = c.clientX, t = c.clientY, Math.random() < .15 && function(n, t) {
                        const a = Date.now();
                        if (a - o < 100) return;
                        o = a;
                        const c = document.createElement("div");
                        c.className = "mouse-snowflake";
                        const s = 3 * Math.random() + 1;
                        c.style.width = s + "px", c.style.height = s + "px";
                        const u = 30 * (Math.random() - .5),
                            r = 10 * (Math.random() - .5);
                        c.style.left = n + u + "px", c.style.top = t + r + "px";
                        const i = 2 * Math.random() + 1;
                        c.style.animation = `mouseFall ${i}s linear forwards`, e.appendChild(c), setTimeout((() => {
                            c.remove()
                        }), 1e3 * i)
                    }(n, t), a = !0, setTimeout((() => {
                        a = !1
                    }), 50))
                }))
            }));
        </script>

        </body>

        </html>