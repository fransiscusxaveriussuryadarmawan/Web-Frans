<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

header("Expires: Sat, 1 Jan 2000 00:00:00 GMT"); // Tanggal masa lalu

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");



$title = "FransXeagle YouTube";

$csrfToken = "YM2OIKfwWytVKoQ3tAuDuYLtjEfc6Oo3jotAwza1";

require '../services/config.php';

require 'visitors.php';



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



<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel=stylesheet>
<link href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css rel=stylesheet>
<link href=https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css rel=stylesheet>
<script src=https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js></script>
<meta charset=utf-8>
<title>FransXeagle YouTube</title>
<meta content="width=device-width,initial-scale=1" name=viewport>
<meta content="" name=keywords>
<meta content="" name=description>
<link href=../assets/img/about.png rel=icon>
<link href=https://fonts.googleapis.com rel=preconnect>
<link href=https://fonts.gstatic.com rel=preconnect crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel=stylesheet>
<link href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css rel=stylesheet>
<link href=https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css rel=stylesheet>
<link href=lib/animate/animate.min.css rel=stylesheet>
<link href=lib/owlcarousel/assets/owl.carousel.min.css rel=stylesheet>
<link href=lib/lightbox/css/lightbox.min.css rel=stylesheet>
<link href=css/bootstrap.min.css rel=stylesheet>
<link href=css/style.css rel=stylesheet>
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
<div class="p-0 container-xxl bg-white">
    <div class="d-flex align-items-center bg-white justify-content-center position-fixed show start-50 top-50 translate-middle vh-100 w-100" id=spinner>
        <div class="spinner-grow text-primary" role=status style=width:3rem;height:3rem><span class=sr-only>Loading...</span></div>
    </div>
    <div class="position-relative container-xxl p-0">
        <nav class="px-lg-5 navbar navbar-expand-lg navbar-light px-4 py-3 py-lg-0"><a href="" class="p-0 navbar-brand">
                <h1 class=m-0>FransXeagle YouTube</h1>
            </a><button class=navbar-toggler type=button data-bs-target=#navbarCollapse data-bs-toggle=collapse><span class="fa fa-bars"></span></button>
            <div class="collapse navbar-collapse" id=navbarCollapse>
                <div class="mx-auto navbar-nav py-0"><a href=https://fransxeagle.com/ class="nav-link nav-item active">Home</a> <a href=about class="nav-link nav-item">About</a> <a href=https://www.youtube.com/@fransxeagle class="nav-link nav-item">👉Subscribe👈</a>
                    <div class="nav-item dropdown"><a href=# class="nav-link dropdown-toggle" data-bs-toggle=dropdown>Link</a>
                        <div class="m-0 dropdown-menu"><a href=contact class=dropdown-item>Group WhatsApp</a> <a href="https://api.whatsapp.com/send/?phone=%2B6282138616235&text&type=phone_number&app_absent=0" class=dropdown-item>PC WhatsApp</a> <a href=https://fransxeagle.com/ class=dropdown-item>Happy Page</a></div>
                    </div><a href=contact class="nav-link nav-item">Contact</a> <span class="text-white display-4 link nav-link">Visitors: <strong><?php echo $total_visitors; ?></strong></span>
                </div><a href="" class="btn rounded-pill d-lg-block d-none ms-3 px-4 py-2">Always Smile</a>
            </div>
        </nav>
        <div class="hero-header bg-primary container-xxl">
            <div class="px-lg-5 container">
                <h2 class="mb-4 text-white animated slideInDown">😉</h2>
                <div class="row g-5 align-items-center">
                    <div class="text-center col-lg-6 text-lg-start">
                        <h1 class="mb-4 text-white animated slideInDown">Version Canva Pro (30 Days) --- Expired 17 January 2025 Premium<br>⭐⭐⭐⭐⭐</h1>
                        <p class="text-white animated slideInDown pb-3">SPECIAL DESEMBER 2024! Bergabung sekarang untuk akses instan ke semua fitur Canva Pro seperti unlock all templates, effects, dan banyak lagi. Terima kasih atas dukungan Anda!
                    </div>
                    <div class="text-center col-lg-6 text-lg-start"><img class="img-fluid zoomIn animated" src=../assets/img/hero.png alt="Gambar Hero"></div>
                </div>
                <div class="row justify-content-center mt-5">
                    <!-- Opsi 1 -->
                    <div class="mb-4 col-lg-5">
                        <div class="bg-light p-4 card shadow-sm border-primary">
                            <h3 class="text-center mb-3 text-primary">Opsi 1: Join via Link Subscribe</h3>
                            <p class=text-center>(Cocok untuk orang yang sudah paham sesuai video di YouTube).
                            <div class="text-center mt-4"><a href=unlock_link class="btn btn-lg btn-primary">Click This For Join</a></div>
                            <div class="text-center mt-4"><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-lg btn-primary">Watch Tutorial</a></div>
                        </div>
                    </div>
                    <!-- Opsi 2 -->
                    <div class="mb-4 col-lg-5">
                        <div class="bg-light p-4 card shadow-sm border-secondary">
                            <h3 class="text-center mb-3 text-secondary">Opsi 2: Join via QRIS WA</h3>
                            <p class=text-center>(Cocok untuk orang yang ingin mode INSTANS 1 detik hanya <b>Rp 1.000</b>).
                            <div class="text-center mt-4"><a href=join_instan class="btn btn-lg btn-secondary">Join via QRIS</a></div>
                        </div>
                    </div>
                    <!-- Opsi 3 -->
                    <div class="mb-4 col-lg-4">
                        <div class="bg-light p-4 card shadow-sm border-success">
                            <h3 class="text-center mb-3 text-success">Opsi 3: Tonton Video</h3>
                            <p class="text-center">(Tonton video minimal 5 menit untuk mendapatkan akses Canva Pro).</p>
                            <div class="text-center mt-4"><a href="opsi3.php" class="btn btn-lg btn-success">Menuju Opsi 3</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 container-xxl">
        <div class="py-5 container px-lg-5">
            <div class="row g-4">
                <div class="wow fadeInUp col-lg-4" data-wow-delay=0.1s>
                    <div class="text-center rounded bg-light feature-item p-4"><i class="fa text-primary fa-3x mb-4 fa-mail-bulk"></i>
                        <h5 class=mb-3>Canva Pro</h5>
                        <p class=m-0>Canva Pro ditujukan untuk pengguna profesional atau bisnis yang membutuhkan akses ke fitur-fitur kreatif dan kolaboratif tambahan serta berbagai pilihan template, gambar, dan elemen desain yang lebih luas.
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4" data-wow-delay=0.3s>
                    <div class="text-center rounded bg-light feature-item p-4"><i class="fa text-primary fa-3x mb-4 fa-search"></i>
                        <h5 class=mb-3>Canva Edu</h5>
                        <p class=m-0>Canva Edu memberikan akses ke semua fitur Canva Pro serta beberapa fitur tambahan yang berguna dalam konteks pendidikan, seperti folder dan kelompok kolaboratif, kemampuan mengunggah font institusi, integrasi dengan LMS (Learning Management System), dan kebijakan privasi yang sesuai dengan kebutuhan pendidikan.
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4" data-wow-delay=0.5s>
                    <div class="text-center rounded bg-light feature-item p-4"><i class="fa text-primary fa-3x mb-4 fa-laptop-code"></i>
                        <h5 class=mb-3>GiveAway</h5>
                        <p class=m-0>Seseorang memberikan akses penuh ke semua fitur dan konten premium Canva Pro kepada penerima hadiah, yang biasanya memerlukan pembayaran langganan bulanan atau tahunan. Giveaway Canva Pro bisa dilakukan sebagai hadiah, promosi, atau untuk tujuan lainnya yang ditentukan oleh pemberi hadiah.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 container-xxl">
        <div class="py-5 container px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="wow fadeInUp col-lg-6" data-wow-delay=0.1s>
                    <p class="section-title text-secondary">About Us<span></span>
                    <h1 class=mb-5>#1 Channel Kisara Xavier Created Since 02/02/2022</h1>
                    <p class=mb-4>Membagikan team secara gratis sejak 2 Februari tahun 2022, dan mulai saat itu banyak channel YouTube yang sering terbanned dikarenakan gratisan
                    <div class="mb-4 skill">
                        <div class="d-flex justify-content-between">
                            <p class=mb-2>Canva Pro
                            <p class=mb-2>97%
                        </div>
                        <div class=progress>
                            <div class="progress-bar bg-primary" role=progressbar aria-valuemax=100 aria-valuemin=0 aria-valuenow=85></div>
                        </div>
                    </div>
                    <div class="mb-4 skill">
                        <div class="d-flex justify-content-between">
                            <p class=mb-2>Group WhatsApp
                            <p class=mb-2>90%
                        </div>
                        <div class=progress>
                            <div class="progress-bar bg-secondary" role=progressbar aria-valuemax=100 aria-valuemin=0 aria-valuenow=90></div>
                        </div>
                    </div>
                    <div class="mb-4 skill">
                        <div class="d-flex justify-content-between">
                            <p class=mb-2>Subsribe
                            <p class=mb-2>100%
                        </div>
                        <div class=progress>
                            <div class="progress-bar bg-dark" role=progressbar aria-valuemax=100 aria-valuemin=0 aria-valuenow=95></div>
                        </div>
                    </div><a href="" class="btn btn-primary mt-3 px-sm-5 py-sm-3 rounded-pill">Read More</a>
                </div>
                <div class=col-lg-6><img class="wow img-fluid zoomIn" src=../assets/img/about.jpg data-wow-delay=0.5s></div>
            </div>
        </div>
    </div>
    <div class="wow fadeInUp container-xxl py-5 bg-primary fact" data-wow-delay=0.1s>
        <div class="py-5 container px-lg-5">
            <div class="row g-4">
                <div class="text-center col-md-6 col-lg-3 fadeIn wow" data-wow-delay=0.1s><i class="fa fa-3x mb-3 text-secondary fa-certificate"></i>
                    <h1 class="text-white mb-2" data-toggle=counter-up>2</h1>
                    <p class="text-white mb-0">Years Experience
                </div>
                <div class="text-center col-md-6 col-lg-3 fadeIn wow" data-wow-delay=0.3s><i class="fa fa-3x mb-3 text-secondary fa-users-cog"></i>
                    <h1 class="text-white mb-2" data-toggle=counter-up>3</h1>
                    <p class="text-white mb-0">Team Members
                </div>
                <div class="text-center col-md-6 col-lg-3 fadeIn wow" data-wow-delay=0.5s><i class="fa fa-3x mb-3 text-secondary fa-users"></i>
                    <h1 class="text-white mb-2" data-toggle=counter-up>2</h1>
                    <p class="text-white mb-0">Satisfied Clients
                </div>
                <div class="text-center col-md-6 col-lg-3 fadeIn wow" data-wow-delay=0.7s><i class="fa fa-3x mb-3 text-secondary fa-check"></i>
                    <h1 class="text-white mb-2" data-toggle=counter-up>4</h1>
                    <p class="text-white mb-0">Complete Projects
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 container-xxl">
        <div class="py-5 container px-lg-5">
            <div class="wow fadeInUp" data-wow-delay=0.1s>
                <p class="justify-content-center section-title text-secondary"><span></span>Our Services<span></span>
                <h1 class="text-center mb-5">Canva Pro Feature</h1>
            </div>
            <div class="row g-4">
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.1s>
                    <div class="text-center rounded d-flex flex-column service-item">
                        <div class="flex-shrink-0 service-icon"><i class="fa fa-2x fa-search"></i></div>
                        <h5 class=mb-3>Templates</h5>
                        <p class=m-0>Akses ke lebih dari 75 juta gambar, foto, dan ilustrasi berkualitas tinggi dalam perpustakaan Canva.</p><a href="" class="btn btn-square"><i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.3s>
                    <div class="text-center rounded d-flex flex-column service-item">
                        <div class="flex-shrink-0 service-icon"><i class="fa fa-2x fa-laptop-code"></i></div>
                        <h5 class=mb-3>Web Design</h5>
                        <p class=m-0>Kemampuan mengunggah font khusus, sehingga pengguna dapat menggunakan font yang spesifik dan sesuai dengan merek atau kebutuhan desain mereka..</p><a href="" class="btn btn-square"><i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.5s>
                    <div class="text-center rounded d-flex flex-column service-item">
                        <div class="flex-shrink-0 service-icon"><i class="fab fa-facebook-f fa-2x"></i></div>
                        <h5 class=mb-3>Colaboration</h5>
                        <p class=m-0>Kolaborasi tim dalam waktu nyata, yang memungkinkan pengguna untuk bekerja bersama dengan tim atau rekan kerja dalam membuat dan mengedit desain.</p><a href="" class="btn btn-square"><i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.1s>
                    <div class="text-center rounded d-flex flex-column service-item">
                        <div class="flex-shrink-0 service-icon"><i class="fa fa-2x fa-mail-bulk"></i></div>
                        <h5 class=mb-3>Full HD</h5>
                        <p class=m-0>Pilihan untuk mengunduh desain dalam format PDF dengan kualitas cetak yang tinggi.</p><a href="" class="btn btn-square"><i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.3s>
                    <div class="text-center rounded d-flex flex-column service-item">
                        <div class="flex-shrink-0 service-icon"><i class="fa fa-2x fa-thumbs-up"></i></div>
                        <h5 class=mb-3>Remove BG</h5>
                        <p class=m-0>Pengguna untuk menghapus latar belakang pada gambar dan menggantinya dengan latar belakang transparan atau yang baru.</p><a href="" class="btn btn-square"><i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.5s>
                    <div class="text-center rounded d-flex flex-column service-item">
                        <div class="flex-shrink-0 service-icon"><i class="fab fa-2x fa-android"></i></div>
                        <h5 class=mb-3>Organisasi</h5>
                        <p class=m-0>Folder dan kelompok kolaboratif, yang membantu pengguna mengatur proyek-proyek desain mereka dengan lebih efisien.</p><a href="" class="btn btn-square"><i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wow fadeInUp container-xxl py-5 bg-primary newsletter" data-wow-delay=0.1s>
        <div class="py-5 container px-lg-5">
            <div class="row justify-content-center">
                <div class="text-center col-lg-7">
                    <p class="text-white section-title justify-content-center"><span></span>Stay Safe<span></span>
                    <h1 class="text-center mb-4 text-white">Stay Always In Touch</h1>
                    <p class="mb-4 text-white">Kalau Kebingungan Bisa Chat Pribadi WhatsApp atau Join Grup WhatsApp (Pada Menu Contact)
                    <div class="w-100 mt-3 position-relative"><input class="w-100 border-0 form-control pe-5 ps-4 rounded-pill" placeholder="Semoga Dengan Team Ini Membantu Kebutuhan Kalian | Good Luck" style=height:48px> <button class="btn end-0 me-2 mt-1 position-absolute shadow-none top-0" type=button><i class="fa text-primary fa-paper-plane fs-4"></i></button></div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 container-xxl">
        <div class="py-5 container px-lg-5">
            <div class="wow fadeInUp" data-wow-delay=0.1s>
                <p class="justify-content-center section-title text-secondary"><span></span>Our Projects<span></span>
                <h1 class="text-center mb-5">Recently Completed Projects</h1>
            </div>
            <div class="wow fadeInUp mt-n2 row" data-wow-delay=0.3s>
                <div class="text-center col-12">
                    <ul class="mb-5 list-inline" id=portfolio-flters>
                        <li class="mx-2 active" data-filter=*>All
                        <li class=mx-2 data-filter=.first>Web Design
                        <li class=mx-2 data-filter=.second>Graphic Design
                    </ul>
                </div>
            </div>
            <div class="row g-4 portfolio-container">
                <div class="wow fadeInUp col-lg-4 col-md-6 portfolio-item first" data-wow-delay=0.1s>
                    <div class="rounded overflow-hidden">
                        <div class="overflow-hidden position-relative"><img class="img-fluid w-100" src=../assets/img/portfolio-1.png alt="">
                            <div class=portfolio-overlay><a href=../assets/img/portfolio-1.jpg class="btn btn-square mx-1 btn-outline-light" data-lightbox=portfolio><i class="fa fa-eye"></i></a> <a href="" class="btn btn-square mx-1 btn-outline-light"><i class="fa fa-link"></i></a></div>
                        </div>
                        <div class="bg-light p-4">
                            <p class="mb-2 fw-medium text-primary">UI / UX Design
                            <h5 class="mb-0 lh-base">Digital Agency Website Design And Development
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6 portfolio-item second" data-wow-delay=0.3s>
                    <div class="rounded overflow-hidden">
                        <div class="overflow-hidden position-relative"><img class="img-fluid w-100" src=../assets/img/portfolio-2.png alt="">
                            <div class=portfolio-overlay><a href=../assets/img/portfolio-2.jpg class="btn btn-square mx-1 btn-outline-light" data-lightbox=portfolio><i class="fa fa-eye"></i></a> <a href="" class="btn btn-square mx-1 btn-outline-light"><i class="fa fa-link"></i></a></div>
                        </div>
                        <div class="bg-light p-4">
                            <p class="mb-2 fw-medium text-primary">UI / UX Design
                            <h5 class="mb-0 lh-base">Digital Agency Website Design And Development
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6 portfolio-item first" data-wow-delay=0.5s>
                    <div class="rounded overflow-hidden">
                        <div class="overflow-hidden position-relative"><img class="img-fluid w-100" src=../assets/img/portfolio-3.png alt="">
                            <div class=portfolio-overlay><a href=../assets/img/portfolio-3.jpg class="btn btn-square mx-1 btn-outline-light" data-lightbox=portfolio><i class="fa fa-eye"></i></a> <a href="" class="btn btn-square mx-1 btn-outline-light"><i class="fa fa-link"></i></a></div>
                        </div>
                        <div class="bg-light p-4">
                            <p class="mb-2 fw-medium text-primary">UI / UX Design
                            <h5 class="mb-0 lh-base">Digital Agency Website Design And Development
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6 portfolio-item second" data-wow-delay=0.1s>
                    <div class="rounded overflow-hidden">
                        <div class="overflow-hidden position-relative"><img class="img-fluid w-100" src=../assets/img/portfolio-4.png alt="">
                            <div class=portfolio-overlay><a href=../assets/img/portfolio-4.jpg class="btn btn-square mx-1 btn-outline-light" data-lightbox=portfolio><i class="fa fa-eye"></i></a> <a href="" class="btn btn-square mx-1 btn-outline-light"><i class="fa fa-link"></i></a></div>
                        </div>
                        <div class="bg-light p-4">
                            <p class="mb-2 fw-medium text-primary">UI / UX Design
                            <h5 class="mb-0 lh-base">Digital Agency Website Design And Development
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6 portfolio-item first" data-wow-delay=0.3s>
                    <div class="rounded overflow-hidden">
                        <div class="overflow-hidden position-relative"><img class="img-fluid w-100" src=../assets/img/portfolio-5.png alt="">
                            <div class=portfolio-overlay><a href=../assets/img/portfolio-5.jpg class="btn btn-square mx-1 btn-outline-light" data-lightbox=portfolio><i class="fa fa-eye"></i></a> <a href="" class="btn btn-square mx-1 btn-outline-light"><i class="fa fa-link"></i></a></div>
                        </div>
                        <div class="bg-light p-4">
                            <p class="mb-2 fw-medium text-primary">UI / UX Design
                            <h5 class="mb-0 lh-base">Digital Agency Website Design And Development
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6 portfolio-item second" data-wow-delay=0.5s>
                    <div class="rounded overflow-hidden">
                        <div class="overflow-hidden position-relative"><img class="img-fluid w-100" src=../assets/img/portfolio-6.png alt="">
                            <div class=portfolio-overlay><a href=../assets/img/portfolio-6.jpg class="btn btn-square mx-1 btn-outline-light" data-lightbox=portfolio><i class="fa fa-eye"></i></a> <a href="" class="btn btn-square mx-1 btn-outline-light"><i class="fa fa-link"></i></a></div>
                        </div>
                        <div class="bg-light p-4">
                            <p class="mb-2 fw-medium text-primary">UI / UX Design
                            <h5 class="mb-0 lh-base">Digital Agency Website Design And Development
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wow fadeInUp container-xxl py-5" data-wow-delay=0.1s>
        <div class="py-5 container px-lg-5">
            <p class="justify-content-center section-title text-secondary"><span></span>Testimonial<span></span>
            <h1 class="text-center mb-5">What Say Our Clients!</h1>
            <div class="owl-carousel testimonial-carousel">
                <div class="rounded bg-light my-4 testimonial-item">
                    <p class=fs-5><i class="fa text-primary fa-4x fa-quote-left me-3 mt-n4"></i>Saya sangat terkesan dengan kesempatan untuk menggunakan Canva Premium secara gratis! Fitur-fitur tambahan yang diberikan sangat membantu dalam membuat desain yang lebih profesional dan menarik. Terima kasih Fransiscus.
                    <div class="d-flex align-items-center"><img class="img-fluid rounded-circle flex-shrink-0" src=../assets/img/testimonial-1.jpg style=width:65px;height:65px>
                        <div class=ps-4>
                            <h5 class=mb-1>Felisha Revinda</h5><span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="rounded bg-light my-4 testimonial-item">
                    <p class=fs-5><i class="fa text-primary fa-4x fa-quote-left me-3 mt-n4"></i>Saya merasa sangat beruntung dapat mengakses Canva Premium secara gratis. Tidak hanya saya dapat menghemat biaya berlangganan, tetapi juga mendapatkan akses ke ribuan template, elemen desain, dan foto berkualitas tinggi.
                    <div class="d-flex align-items-center"><img class="img-fluid rounded-circle flex-shrink-0" src=../assets/img/testimonial-2.jpg style=width:65px;height:65px>
                        <div class=ps-4>
                            <h5 class=mb-1>Michael Lawrence</h5><span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="rounded bg-light my-4 testimonial-item">
                    <p class=fs-5><i class="fa text-primary fa-4x fa-quote-left me-3 mt-n4"></i>Saya sangat senang dengan kesempatan untuk menggunakan Canva Premium secara gratis. Dengan akses ke berbagai fitur tambahan, seperti latar belakang transparan, penghapusan latar belakang, dan eksportasi ke format berkualitas tinggi.
                    <div class="d-flex align-items-center"><img class="img-fluid rounded-circle flex-shrink-0" src=../assets/img/testimonial-3.jpg style=width:65px;height:65px>
                        <div class=ps-4>
                            <h5 class=mb-1>Laurent Hans</h5><span>Profession</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 container-xxl">
        <div class="py-5 container px-lg-5">
            <div class="wow fadeInUp" data-wow-delay=0.1s>
                <p class="justify-content-center section-title text-secondary"><span></span>Our Team<span></span>
                <h1 class="text-center mb-5">Our Team Members</h1>
            </div>
            <div class="row g-4">
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.1s>
                    <div class="rounded bg-light team-item">
                        <div class="text-center p-4 border-bottom"><img class="img-fluid rounded-circle mb-4" src=../assets/img/team-1.jpg alt="">
                            <h5>Fransiscus Xaverius Surya Darmawan</h5><span>CEO & Founder</span>
                        </div>
                        <div class="d-flex justify-content-center p-4"><a href=https://www.facebook.com/fxsurya27 class="btn btn-square mx-1"><i class="fab fa-facebook-f"></i></a> <a href=https://twitter.com/fransxeagle class="btn btn-square mx-1"><i class="fab fa-twitter"></i></a> <a href=https://www.instagram.com/fransxdarmawan class="btn btn-square mx-1"><i class="fab fa-instagram"></i> <a href=https://www.linkedin.com/in/fransiscus-xaverius-surya-darmawan-a34325280 class="btn btn-square mx-1"><i class="fab fa-linkedin-in"></i></div>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.3s>
                    <div class="rounded bg-light team-item">
                        <div class="text-center p-4 border-bottom"><img class="img-fluid rounded-circle mb-4" src=../assets/img/team-2.jpg alt="">
                            <h5>Steffi Revinda Mely</h5><span>Web Designer</span>
                        </div>
                        <div class="d-flex justify-content-center p-4"><a href=https://www.facebook.com/fxsurya27 class="btn btn-square mx-1"><i class="fab fa-facebook-f"></i></a> <a href=https://twitter.com/fransxeagle class="btn btn-square mx-1"><i class="fab fa-twitter"></i></a> <a href=https://www.instagram.com/fransxdarmawan class="btn btn-square mx-1"><i class="fab fa-instagram"></i> <a href=https://www.linkedin.com/in/fransiscus-xaverius-surya-darmawan-a34325280 class="btn btn-square mx-1"><i class="fab fa-linkedin-in"></i></div>
                    </div>
                </div>
                <div class="wow fadeInUp col-lg-4 col-md-6" data-wow-delay=0.5s>
                    <div class="rounded bg-light team-item">
                        <div class="text-center p-4 border-bottom"><img class="img-fluid rounded-circle mb-4" src=../assets/img/team-3.jpg alt="">
                            <h5>Parker John</h5><span>SEO Expert</span>
                        </div>
                        <div class="d-flex justify-content-center p-4"><a href=https://www.facebook.com/fxsurya27 class="btn btn-square mx-1"><i class="fab fa-facebook-f"></i></a> <a href=https://twitter.com/fransxeagle class="btn btn-square mx-1"><i class="fab fa-twitter"></i></a> <a href=https://www.instagram.com/fransxdarmawan class="btn btn-square mx-1"><i class="fab fa-instagram"></i> <a href=https://www.linkedin.com/in/fransiscus-xaverius-surya-darmawan-a34325280 class="btn btn-square mx-1"><i class="fab fa-linkedin-in"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wow fadeIn bg-primary container-fluid footer text-light" data-wow-delay=0.1s>
        <div class="py-5 container px-lg-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3">
                    <p class="mb-4 text-white h5 section-title">Address<span></span>
                    <p><i class="fa me-3 fa-map-marker-alt"></i>45 St John, California
                    <p><i class="fa me-3 fa-phone-alt"></i>+62 821 3861 6235
                    <p><i class="fa me-3 fa-envelope"></i>admin@fransxeagle.com
                    <div class="d-flex pt-2"><a href=https://twitter.com/fransxeagle class="btn btn-outline-light btn-social"><i class="fab fa-twitter"></i></a> <a href=https://www.facebook.com/fxsurya27 class="btn btn-outline-light btn-social"><i class="fab fa-facebook-f"></i></a> <a href=https://www.instagram.com/suryasidarmawan class="btn btn-outline-light btn-social"><i class="fab fa-instagram"></i> <a href=https://www.linkedin.com/in/fransiscus-xaverius-surya-darmawan-a34325280 class="btn btn-outline-light btn-social"><i class="fab fa-linkedin-in"></i></div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <p class="mb-4 text-white h5 section-title">Quick Link<span></span></p><a href="" class="btn btn-link">About Us</a> <a href="" class="btn btn-link">Contact Us</a> <a href="" class="btn btn-link">Privacy Policy</a> <a href="" class="btn btn-link">Terms & Condition</a> <a href="" class="btn btn-link">Career</a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <p class="mb-4 text-white h5 section-title">Gallery<span></span>
                    <div class="row g-2">
                        <div class=col-4><img class=img-fluid src=../assets/img/portfolio-1.jpg alt=Image></div>
                        <div class=col-4><img class=img-fluid src=../assets/img/portfolio-2.jpg alt=Image></div>
                        <div class=col-4><img class=img-fluid src=../assets/img/portfolio-3.jpg alt=Image></div>
                        <div class=col-4><img class=img-fluid src=../assets/img/portfolio-4.jpg alt=Image></div>
                        <div class=col-4><img class=img-fluid src=../assets/img/portfolio-5.jpg alt=Image></div>
                        <div class=col-4><img class=img-fluid src=../assets/img/portfolio-6.jpg alt=Image></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <p class="mb-4 text-white h5 section-title">Stay Safe<span></span>
                    <p>Kalau Kebingungan Bisa Chat Pribadi WhatsApp atau Join Grup WhatsApp (Pada Menu Contact)
                    <div class="w-100 mt-3 position-relative"><input class="w-100 border-0 form-control pe-5 ps-4 rounded-pill" placeholder="Always Happy" style=height:48px> <button class="btn end-0 me-2 mt-1 position-absolute shadow-none top-0" type=button><i class="fa text-primary fa-paper-plane fs-4"></i></button></div>
                </div>
            </div>
        </div>
        <div class="px-lg-5 container">
            <div class=copyright>
                <div class=row>
                    <div class="text-center col-md-6 mb-3 mb-md-0 text-md-start">© <a href=https://fransxeagle.com/ class=border-bottom>https://fransxeagle.com/</a>, All Right Reserved. Designed By <a href=https://fransxeagle.com/ class=border-bottom>My GF (Gabriela)</a></div>
                    <div class="text-center col-md-6 text-md-end">
                        <div class=footer-menu><a href="">Home</a> <a href="">Cookies</a> <a href="">Help</a> <a href="">FQAs</a></div>
                    </div>
                </div>
                <div class="text-center music-control" onclick=toggleMusic()><i class="fas fa-play-circle" id=music-icon></i> Music</div><audio id=background-music type=audio/mpeg></audio><progress id=music-progress max=100 style=width:100% value=0></progress>
                <div class=music-time><span id=current-time>0:00</span> <span id=duration>0:00</span></div>
                <div class=volume-control><i class="fas fa-volume-down"></i> <input id=volume-control max=1 min=0 step=0.1 type=range value=0.5> <i class="fas fa-volume-up"></i></div>
            </div>
        </div>
    </div><a href=# class="btn btn-lg btn-secondary back-to-top btn-lg-square"><i class="bi bi-arrow-up"></i></a>
</div>



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



<!-- JavaScript Libraries -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="lib/wow/wow.min.js"></script>

<script src="lib/easing/easing.min.js"></script>

<script src="lib/waypoints/waypoints.min.js"></script>

<script src="lib/counterup/counterup.min.js"></script>

<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<script src="lib/isotope/isotope.pkgd.min.js"></script>

<script src="lib/lightbox/js/lightbox.min.js"></script>



<!-- Template Javascript -->

<script src="js/main.js"></script>



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
    const playlist = ["../assets/music/1.mp3", "../assets/music/2.mp3", "../assets/music/3.mp3", "../assets/music/4.mp3", "../assets/music/5.mp3", "../assets/music/6.mp3"],
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
    };
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
        document.addEventListener("mousemove", (s => {
            a || (n = s.clientX, t = s.clientY, Math.random() < .15 && function(n, t) {
                const a = Date.now();
                if (a - o < 100) return;
                o = a;
                const s = document.createElement("div");
                s.className = "mouse-snowflake";
                const c = 3 * Math.random() + 1;
                s.style.width = c + "px", s.style.height = c + "px";
                const u = 30 * (Math.random() - .5),
                    r = 10 * (Math.random() - .5);
                s.style.left = n + u + "px", s.style.top = t + r + "px";
                const i = 2 * Math.random() + 1;
                s.style.animation = `mouseFall ${i}s linear forwards`, e.appendChild(s), setTimeout((() => {
                    s.remove()
                }), 1e3 * i)
            }(n, t), a = !0, setTimeout((() => {
                a = !1
            }), 50))
        }))
    }));
</script>





</body>



</html>