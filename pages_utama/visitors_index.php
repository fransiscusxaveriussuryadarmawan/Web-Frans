<?php
// Fungsi untuk mendapatkan IP address pengunjung
function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Dapatkan alamat IP pengunjung
$ip_address = getUserIP();

// Cek apakah alamat IP ini sudah dikunjungi dalam sesi ini
if (!isset($_SESSION['visited'])) {
    // Masukkan data ke dalam database
    $stmt = $conn->prepare("INSERT INTO visitors (ip_address) VALUES (?)");
    $stmt->bind_param("s", $ip_address);
    $stmt->execute();
    $stmt->close();

    // Set sesi untuk mencegah pencatatan berulang dalam sesi yang sama
    $_SESSION['visited'] = true;
}

// Query untuk menghitung jumlah total visitors
$result = $conn->query("SELECT COUNT(*) AS total_visitors FROM visitors");
$row = $result->fetch_assoc();
$total_visitors = $row['total_visitors'];

$conn->close();
