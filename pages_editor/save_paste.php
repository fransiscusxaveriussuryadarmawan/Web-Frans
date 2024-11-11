<?php
require_once 'config.php';
session_start();

function savePaste($title, $content, $conn)
{
    // Generate UUID yang aman
    $id = bin2hex(random_bytes(16));
    $last_ip_login = $_SERVER['REMOTE_ADDR'];
    $stmt = $conn->prepare("INSERT INTO content_simpan (id, title, content, last_ip_login) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $title, $content, $last_ip_login);
    return $stmt->execute() ? $id : false;
}

if (isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    // Sanitasi judul dan konten
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    $paste_id = savePaste($title, $content, $conn);
    if ($paste_id) {
        echo "Paste disimpan dengan ID: " . $paste_id . "<br>";
        echo "Untuk akses lebih lanjut, Anda dapat membuka tautan berikut ini:<br>";
        echo "<a href='https://fransxeagle.com/paste.php?id=" . $paste_id . "'>https://fransxeagle.com/paste.php?id=" . $paste_id . "</a>";
    } else {
        echo "Terjadi kesalahan saat menyimpan paste.";
    }
} else {
    echo "Judul dan konten tidak disediakan.";
}
?>
