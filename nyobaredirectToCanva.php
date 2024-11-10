<?php
session_start();

// Fungsi untuk mendapatkan informasi undangan (contoh sederhana)
function getInvitationInfo()
{
    // Simulasikan mendapatkan informasi token dari server
    return [
        'token' => 'W0YLvTjWOL99oJXR-GTWxQ'
    ];
}

// Periksa apakah pengguna telah menyelesaikan tindakan yang diperlukan
// Dapatkan informasi undangan dari server
$invitationInfo = getInvitationInfo();

// Tampilkan halaman HTML dengan JavaScript untuk membuka pop-up
echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Redirect to Canva</title>
        <script>
            window.onload = function() {
                // Buka link Canva dalam jendela baru yang kecil
                window.open('https://www.canva.com/brand/join?token=" . $invitationInfo['token'] . "', '_blank', 'width=800,height=600');
                
                // // Opsional: Tunda redirect ke halaman lain selama beberapa detik
                // setTimeout(function() {
                //     window.location.href = 'https://www.canva.com'; // Ganti dengan URL tujuan Anda
                // }, 3000); // 3000 ms = 3 detik
            };
        </script>
    </head>
    <body>
        <p>Harap tunggu, Anda akan segera diarahkan ke Canva...</p>
    </body>
    </html>";


session_destroy();
