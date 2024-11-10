<?php
session_start();

// Periksa apakah token ada di sesi dan cocok dengan token dari URL
if (isset($_SESSION['token']) && isset($_GET['token']) && $_GET['token'] === $_SESSION['token']) {
    // Token valid, arahkan ke link Canva
    header("Location: https://www.canva.com/brand/join?token=W0YLvTjWOL99oJXR-GTWxQ&referrer=team-invite");
    exit();
} else {
    // Token tidak valid, tampilkan pesan kesalahan
    echo "HAYO KAMU MAU NGAPAIN WKWKWKWK";
    echo "MINIMAL EFFORT LAH DEK";
}

session_destroy();
