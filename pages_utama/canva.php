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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- CryptoJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <meta charset="utf-8">
    <title>FransXeagle YouTube</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../assets/img/about.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">

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
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0">FransXeagle YouTube </h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="https://www.youtube.com/@fransxeagle" class="nav-item nav-link">👉Subscribe👈</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Link</a>
                            <div class="dropdown-menu m-0">
                                <a href="contact.php" class="dropdown-item">Group WhatsApp</a>
                                <a href="https://api.whatsapp.com/send/?phone=%2B6282138616235&text&type=phone_number&app_absent=0" class="dropdown-item">PC WhatsApp</a>
                                <a href="index.php" class="dropdown-item">Happy Page</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                        <span class="nav-link link text-white display-4">
                            Visitors: <strong><?php echo $total_visitors; ?></strong>
                        </span>
                    </div>
                    <a href="" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Always Smile</a>
                </div>
            </nav>





            <div class="container-xxl bg-primary hero-header">
                <div class="container px-lg-5">
                    <h2 class="text-white mb-4 animated slideInDown">😉</h2>
                    <div class="row g-5 align-items-center">

                        <!-- Bagian Deskripsi -->
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="text-white mb-4 animated slideInDown">
                                Version Canva Pro (30 Days) --- Expired 10 December 2024 Premium<br> ⭐⭐⭐⭐⭐
                            </h1>
                            <p class="text-white pb-3 animated slideInDown">
                                SPECIAL NOVEMBER 2024! Bergabung sekarang untuk akses instan ke semua fitur Canva Pro seperti unlock all templates, effects, dan banyak lagi. Terima kasih atas dukungan Anda!
                            </p>
                        </div>

                        <!-- Bagian Gambar Hero -->
                        <div class="col-lg-6 text-center text-lg-start">
                            <img class="img-fluid animated zoomIn" src="../assets/img/hero.png" alt="Gambar Hero">
                        </div>

                    </div>

                    <!-- Bagian Opsi 1 dan Opsi 2 -->
                    <div class="row justify-content-center mt-5">
                        <!-- Opsi 1 -->
                        <div class="col-lg-5 mb-4">
                            <div class="card shadow-sm p-4 bg-light border-primary">
                                <h3 class="text-primary text-center mb-3">Opsi 1: Join via Link Subscribe</h3>
                                <p class="text-center">(Cocok untuk orang yang sudah paham sesuai video di YouTube).</p>
                                <div class="text-center mt-4">
                                    <a href="unlock_link.php" class="btn btn-primary btn-lg">Click This For Join</a>
                                </div>
                            </div>
                        </div>

                        <!-- Opsi 2 -->
                        <div class="col-lg-5 mb-4">
                            <div class="card shadow-sm p-4 bg-light border-secondary">
                                <h3 class="text-secondary text-center mb-3">Opsi 2: Join via QRIS WA</h3>
                                <p class="text-center">(Cocok untuk orang yang ingin mode INSTANS 1 detik hanya <b>Rp 1.000</b>).</p>
                                <div class="text-center mt-4">
                                    <a href="join_instan.php" class="btn btn-secondary btn-lg">Join via QRIS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>









        </div>
        <!-- Navbar & Hero End -->


        <!-- Feature Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="row g-4">
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item bg-light rounded text-center p-4">
                            <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i>
                            <h5 class="mb-3">Canva Pro</h5>
                            <p class="m-0">Canva Pro ditujukan untuk pengguna profesional atau bisnis yang membutuhkan
                                akses ke fitur-fitur kreatif dan kolaboratif tambahan serta berbagai pilihan template,
                                gambar, dan elemen desain yang lebih luas.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item bg-light rounded text-center p-4">
                            <i class="fa fa-3x fa-search text-primary mb-4"></i>
                            <h5 class="mb-3">Canva Edu</h5>
                            <p class="m-0">Canva Edu memberikan akses ke semua fitur Canva Pro serta beberapa fitur
                                tambahan yang berguna dalam konteks pendidikan, seperti folder dan kelompok kolaboratif,
                                kemampuan mengunggah font institusi, integrasi dengan LMS (Learning Management System),
                                dan kebijakan privasi yang sesuai dengan kebutuhan pendidikan.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item bg-light rounded text-center p-4">
                            <i class="fa fa-3x fa-laptop-code text-primary mb-4"></i>
                            <h5 class="mb-3">GiveAway</h5>
                            <p class="m-0">Seseorang memberikan akses penuh ke semua fitur dan konten premium Canva Pro
                                kepada penerima hadiah, yang biasanya memerlukan pembayaran langganan bulanan atau
                                tahunan. Giveaway Canva Pro bisa dilakukan sebagai hadiah, promosi, atau untuk tujuan
                                lainnya yang ditentukan oleh pemberi hadiah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <p class="section-title text-secondary">About Us<span></span></p>
                        <h1 class="mb-5">#1 Channel Kisara Xavier Created Since 02/02/2022</h1>
                        <p class="mb-4">Membagikan team secara gratis sejak 2 Februari tahun 2022, dan mulai saat itu
                            banyak channel YouTube yang sering terbanned dikarenakan gratisan</p>
                        <div class="skill mb-4">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Canva Pro</p>
                                <p class="mb-2">97%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="skill mb-4">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Group WhatsApp</p>
                                <p class="mb-2">90%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="skill mb-4">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Subsribe</p>
                                <p class="mb-2">100%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a href="" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill mt-3">Read More</a>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="../assets/img/about.jpg">
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Facts Start -->
        <div class="container-xxl bg-primary fact py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-certificate fa-3x text-secondary mb-3"></i>
                        <h1 class="text-white mb-2" data-toggle="counter-up">2</h1>
                        <p class="text-white mb-0">Years Experience</p>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-users-cog fa-3x text-secondary mb-3"></i>
                        <h1 class="text-white mb-2" data-toggle="counter-up">3</h1>
                        <p class="text-white mb-0">Team Members</p>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-users fa-3x text-secondary mb-3"></i>
                        <h1 class="text-white mb-2" data-toggle="counter-up">2</h1>
                        <p class="text-white mb-0">Satisfied Clients</p>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                        <i class="fa fa-check fa-3x text-secondary mb-3"></i>
                        <h1 class="text-white mb-2" data-toggle="counter-up">4</h1>
                        <p class="text-white mb-0">Complete Projects</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Facts End -->


        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary justify-content-center"><span></span>Our
                        Services<span></span></p>
                    <h1 class="text-center mb-5">Canva Pro Feature</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fa fa-search fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Templates</h5>
                            <p class="m-0">Akses ke lebih dari 75 juta gambar, foto, dan ilustrasi berkualitas tinggi
                                dalam perpustakaan Canva.</p>
                            <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fa fa-laptop-code fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Web Design</h5>
                            <p class="m-0">Kemampuan mengunggah font khusus, sehingga pengguna dapat menggunakan font
                                yang spesifik dan sesuai dengan merek atau kebutuhan desain mereka..</p>
                            <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fab fa-facebook-f fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Colaboration</h5>
                            <p class="m-0">Kolaborasi tim dalam waktu nyata, yang memungkinkan pengguna untuk bekerja
                                bersama dengan tim atau rekan kerja dalam membuat dan mengedit desain.</p>
                            <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fa fa-mail-bulk fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Full HD</h5>
                            <p class="m-0">Pilihan untuk mengunduh desain dalam format PDF dengan kualitas cetak yang
                                tinggi.</p>
                            <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fa fa-thumbs-up fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Remove BG</h5>
                            <p class="m-0">Pengguna untuk menghapus latar belakang pada gambar dan menggantinya dengan
                                latar belakang transparan atau yang baru.</p>
                            <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fab fa-android fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Organisasi</h5>
                            <p class="m-0">Folder dan kelompok kolaboratif, yang membantu pengguna mengatur
                                proyek-proyek desain mereka dengan lebih efisien.</p>
                            <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->


        <!-- Newsletter Start -->
        <div class="container-xxl bg-primary newsletter py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center">
                        <p class="section-title text-white justify-content-center"><span></span>Stay Safe<span></span>
                        </p>
                        <h1 class="text-center text-white mb-4">Stay Always In Touch</h1>
                        <p class="text-white mb-4">Kalau Kebingungan Bisa Chat Pribadi WhatsApp atau Join Grup WhatsApp
                            (Pada Menu Contact)</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Semoga Dengan Team Ini Membantu Kebutuhan Kalian | Good Luck" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter End -->


        <!-- Projects Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary justify-content-center"><span></span>Our
                        Projects<span></span></p>
                    <h1 class="text-center mb-5">Recently Completed Projects</h1>
                </div>
                <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-12 text-center">
                        <ul class="list-inline mb-5" id="portfolio-flters">
                            <li class="mx-2 active" data-filter="*">All</li>
                            <li class="mx-2" data-filter=".first">Web Design</li>
                            <li class="mx-2" data-filter=".second">Graphic Design</li>
                        </ul>
                    </div>
                </div>
                <div class="row g-4 portfolio-container">
                    <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="../assets/img/portfolio-1.png" alt="">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="../assets/img/portfolio-1.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2">UI / UX Design</p>
                                <h5 class="lh-base mb-0">Digital Agency Website Design And Development</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.3s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="../assets/img/portfolio-2.png" alt="">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="../assets/img/portfolio-2.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2">UI / UX Design</p>
                                <h5 class="lh-base mb-0">Digital Agency Website Design And Development</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.5s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="../assets/img/portfolio-3.png" alt="">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="../assets/img/portfolio-3.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2">UI / UX Design</p>
                                <h5 class="lh-base mb-0">Digital Agency Website Design And Development</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="../assets/img/portfolio-4.png" alt="">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="../assets/img/portfolio-4.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2">UI / UX Design</p>
                                <h5 class="lh-base mb-0">Digital Agency Website Design And Development</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.3s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="../assets/img/portfolio-5.png" alt="">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="../assets/img/portfolio-5.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2">UI / UX Design</p>
                                <h5 class="lh-base mb-0">Digital Agency Website Design And Development</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.5s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="../assets/img/portfolio-6.png" alt="">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="../assets/img/portfolio-6.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2">UI / UX Design</p>
                                <h5 class="lh-base mb-0">Digital Agency Website Design And Development</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Projects End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <p class="section-title text-secondary justify-content-center"><span></span>Testimonial<span></span></p>
                <h1 class="text-center mb-5">What Say Our Clients!</h1>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"><i class="fa fa-quote-left fa-4x text-primary mt-n4 me-3"></i>Saya sangat
                            terkesan dengan kesempatan untuk menggunakan Canva Premium secara gratis! Fitur-fitur
                            tambahan yang diberikan sangat membantu dalam membuat desain yang lebih profesional dan
                            menarik. Terima kasih Fransiscus.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="../assets/img/testimonial-1.jpg" style="width: 65px; height: 65px;">
                            <div class="ps-4">
                                <h5 class="mb-1">Felisha Revinda</h5>
                                <span>Profession</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"><i class="fa fa-quote-left fa-4x text-primary mt-n4 me-3"></i>Saya merasa sangat
                            beruntung dapat mengakses Canva Premium secara gratis. Tidak hanya saya dapat menghemat
                            biaya berlangganan, tetapi juga mendapatkan akses ke ribuan template, elemen desain, dan
                            foto berkualitas tinggi.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="../assets/img/testimonial-2.jpg" style="width: 65px; height: 65px;">
                            <div class="ps-4">
                                <h5 class="mb-1">Michael Lawrence</h5>
                                <span>Profession</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"><i class="fa fa-quote-left fa-4x text-primary mt-n4 me-3"></i>Saya sangat senang
                            dengan kesempatan untuk menggunakan Canva Premium secara gratis. Dengan akses ke berbagai
                            fitur tambahan, seperti latar belakang transparan, penghapusan latar belakang, dan
                            eksportasi ke format berkualitas tinggi.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="../assets/img/testimonial-3.jpg" style="width: 65px; height: 65px;">
                            <div class="ps-4">
                                <h5 class="mb-1">Laurent Hans</h5>
                                <span>Profession</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->


        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary justify-content-center"><span></span>Our Team<span></span>
                    </p>
                    <h1 class="text-center mb-5">Our Team Members</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item bg-light rounded">
                            <div class="text-center border-bottom p-4">
                                <img class="img-fluid rounded-circle mb-4" src="../assets/img/team-1.jpg" alt="">
                                <h5>Fransiscus Xaverius Surya Darmawan</h5>
                                <span>CEO & Founder</span>
                            </div>
                            <div class="d-flex justify-content-center p-4">
                                <a class="btn btn-square mx-1" href=https://www.facebook.com/fxsurya27><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=https://twitter.com/fransxeagle><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=https://www.instagram.com/suryasidarmawan /><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-square mx-1" href=https://www.linkedin.com/in/fransiscus-xaverius-surya-darmawan-a34325280 /><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item bg-light rounded">
                            <div class="text-center border-bottom p-4">
                                <img class="img-fluid rounded-circle mb-4" src="../assets/img/team-2.jpg" alt="">
                                <h5>Steffi Revinda Mely</h5>
                                <span>Web Designer</span>
                            </div>
                            <div class="d-flex justify-content-center p-4">
                                <a class="btn btn-square mx-1" href=https://www.facebook.com/fxsurya27><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=https://twitter.com/fransxeagle><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=https://www.instagram.com/suryasidarmawan /><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-square mx-1" href=https://www.linkedin.com/in/fransiscus-xaverius-surya-darmawan-a34325280 /><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item bg-light rounded">
                            <div class="text-center border-bottom p-4">
                                <img class="img-fluid rounded-circle mb-4" src="../assets/img/team-3.jpg" alt="">
                                <h5>Parker John</h5>
                                <span>SEO Expert</span>
                            </div>
                            <div class="d-flex justify-content-center p-4">
                                <a class="btn btn-square mx-1" href=https://www.facebook.com/fxsurya27><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=https://twitter.com/fransxeagle><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=https://www.instagram.com/suryasidarmawan /><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-square mx-1" href=https://www.linkedin.com/in/fransiscus-xaverius-surya-darmawan-a34325280 /><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Address<span></span></p>
                        <p><i class="fa fa-map-marker-alt me-3"></i>45 St John, California</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+62 821 3861 6235</p>
                        <p><i class="fa fa-envelope me-3"></i>admin@fransxeagle.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=https://twitter.com/fransxeagle><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=https://www.facebook.com/fxsurya27><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=https://www.instagram.com/suryasidarmawan /><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=https://www.linkedin.com/in/fransiscus-xaverius-surya-darmawan-a34325280 /><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Quick Link<span></span></p>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                        <a class="btn btn-link" href="">Career</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Gallery<span></span></p>
                        <div class="row g-2">
                            <div class="col-4">
                                <img class="img-fluid" src="../assets/img/portfolio-1.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="../assets/img/portfolio-2.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="../assets/img/portfolio-3.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="../assets/img/portfolio-4.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="../assets/img/portfolio-5.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="../assets/img/portfolio-6.jpg" alt="Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Stay Safe<span></span></p>
                        <p>Kalau Kebingungan Bisa Chat Pribadi WhatsApp atau Join Grup WhatsApp (Pada Menu Contact)</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Always Happy" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="https://fransxeagle.com/">https://fransxeagle.com/</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://fransxeagle.com/">My GF (Gabriella)</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
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
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

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
    </script>

    <script>
        const playlist = [
            "music/1.mp3",
            "music/2.mp3",
            "music/3.mp3",
            "music/4.mp3",
            "music/5.mp3",
            "music/6.mp3"
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
    </script>

    <script>
        function createSnowflake() {
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
            snowflake.addEventListener("animationend", () => snowflake.remove());
        }

        // Interval untuk membuat efek salju secara berkala
        setInterval(createSnowflake, 700); // 700ms untuk efek salju yang lembut

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