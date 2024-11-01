<?php
session_start();

// Periksa apakah parameter action ada
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $_SESSION[$action] = true; // Tandai action sebagai selesai dalam sesi

    // Cek apakah semua action selesai
    if (isset($_SESSION['subscribe'], $_SESSION['like'], $_SESSION['instagram'])) {
        echo json_encode(['success' => true, 'url' => 'https://fransxeagle.com/']);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
