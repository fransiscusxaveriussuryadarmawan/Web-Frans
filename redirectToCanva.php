<?php
session_start();

// Fungsi untuk mendapatkan informasi undangan (contoh sederhana)
function getInvitationInfo()
{
    // Simulasikan mendapatkan informasi token dari server
    return [
        'token' => 'Snm3y-sT0IwIM9Z7U8mUKQ'
    ];
}

// Periksa apakah pengguna telah menyelesaikan tindakan yang diperlukan
if (isset($_SESSION['token']) && isset($_GET['token']) && $_GET['token'] === $_SESSION['token']) {
    // Dapatkan informasi undangan dari server
    $invitationInfo = getInvitationInfo();

    // Redirect ke link Canva tanpa parameter referrer
    header("Location: https://www.canva.com/brand/join?token=" . $invitationInfo['token']);
    exit();
} else {
    // Token tidak valid atau tindakan belum selesai, tampilkan pesan kesalahan
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Kesalahan - Tidak Boleh Curang!</title>
        <style>
            body {
                background-color: #ffcccc;
                color: #990000;
                font-family: 'Arial', sans-serif;
                text-align: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .error-container {
                background-color: #fff;
                border: 5px dashed #ff6666;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                margin: auto;
            }
            h1 {
                font-size: 2em;
                margin-bottom: 10px;
            }
            p {
                font-size: 1.2em;
                margin-bottom: 20px;
            }
            .laugh-emoji {
                font-size: 3em;
            }
            .effort-link {
                color: #990000;
                text-decoration: none;
                font-weight: bold;
            }
            .effort-link:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class='error-container'>
            <div class='laugh-emoji'>😂</div>
            <h1>HAYO, KETAHUAN!</h1>
            <p>Ngapain coba curang-curang gini? WKWKWK.<br>Usaha dong, minimal effort lah dek!</p>
            <a href='https://www.youtube.com/@fransxeagle' target='_blank' class='effort-link'>Coba belajar dulu di sini</a>
        </div>
    </body>
    </html>";
}

session_destroy();
