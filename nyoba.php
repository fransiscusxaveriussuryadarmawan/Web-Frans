<?php
session_start();

require_once 'services/config.php';

// Fungsi untuk mendapatkan informasi undangan (contoh sederhana)
function getInvitationInfo()
{
    // Simulasikan mendapatkan informasi token dari server
    return [
        'token' => 'IwKzLkwdK9ObmC3_LwA8ng'
    ];
}

// Dapatkan informasi undangan dari server
    $invitationInfo = getInvitationInfo();

    // JavaScript untuk membuka tab baru dan langsung mengembalikan fokus ke tab lama
    echo "
    <script>
        // Buka link Canva di tab baru
        var newTab = window.open('https://www.canva.com/brand/join?token=" . $invitationInfo['token'] . "', '_blank');

        // Kembalikan fokus ke tab lama
        setTimeout(function() {
            window.focus();
        }, 100); // Gunakan timeout singkat untuk memastikan fokus kembali ke tab lama

        // Segera ganti URL di tab asli untuk menghapus URL sensitif
        window.history.replaceState(null, null, '/hidden-url');
    </script>
    ";
    exit();

session_destroy();
