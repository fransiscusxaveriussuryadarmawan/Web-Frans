<?php
session_start();

require_once '../services/config.php';

// Fungsi untuk mendapatkan informasi undangan (contoh sederhana)
function getInvitationInfo()
{
    // Simulasikan mendapatkan informasi token dari server
    return [
        'token' => 'XmEJucIIvs9AOUsbLdsoMg'
    ];
}


// QRIS 6 = mt6zy@vinakop.com / Miih97312j



// XmEJucIIvs9AOUsbLdsoMg = FRANS49 TITIK 85 = zaile@taxibmt.net / H3nM4oP5qR6s
// DObC9WxzuNxOk4aevnXntA = FRANS49 TITIK 86 = zaqv7wjx@datadudi.com / T7uV8wX9yZ0a 
// bPNEK2LirRnr49kdwDfevg = FRANS49 TITIK 87 = czn4icz@libinit.com / B1cD2eF3gH4i
// 2hwk9hm5RXegwKrtZJZKeA = FRANS49 TITIK 88 = tmrthirkw@vinakoop.com / P5qR6sT7uV8w
// BLFKwbMCAwC5MR9lsNU0pw = FRANS49 TITIK 89 = mt974iq@vinakop.com / L9mN0oP1qR2s
// Nat0Cyc53G0fag8bDuryAA = FRANS49 TITIK 90 = zae7kbma@datadudi.com / A3bC4dE5fG6h
// bYdVOW2SvyYx6IHwjrUNIA = FRANS49 TITIK 91 = m99onzef@libinit.com / J7kL8mN9oP0q
// nRQPhs7QYES1wqx8rGLVaw = FRANS49 TITIK 92 = azlkcm@vinakoop.com / X1yZ2aB3cD4e
// _kVTVXq8pRuKPgl5DmXUFQ = FRANS49 TITIK 93 = azv1kyc@vinakop.com / Q5wEr6tY7uI8
// ZBNk-DePQekrm0towviKgg = FRANS49 TITIK 94 = io9vctj@datadudi.com / H9nM0oP1qR2s
// Xwv0r2eOATFOe9N7URl7lA = FRANS49 TITIK 95 = akx5rk@taxibmt.net / T3uV4wX5yZ6a
// Mj4GHw6jN7Kwe0me1fK-8w = FRANS49 TITIK 96 = akw4pduf@libinit.com / B7cD8eF9gH0i
// JrKOXKccNZjmiUBXXtfc0Q = FRANS49 TITIK 97 = m9ksvx@vinakop.com / P1qR2sT3uV4w
// E6fzeacwn6Bf9ZmGyHuCTg = FRANS49 TITIK 98 = akuxga@vinakoop.com / L5mN6oP7qR8s
// i9TgLKQn8rfP9dMD6hMgxw = FRANS49 TITIK 99 = m4vn4fiux@taxibmt.net / A9bC0dE1fG2h
// y891xEQqWDlM2cMGSxU2Jg = FRANS49 TITIK 100 = az05celo@datadudi.com / J3kL4mN5oP6q


// Periksa apakah pengguna telah menyelesaikan tindakan yang diperlukan
if (isset($_SESSION['token']) && isset($_GET['token']) && $_GET['token'] === $_SESSION['token']) {
    // Dapatkan informasi undangan dari server
    $invitationInfo = getInvitationInfo();

    // Redirect ke link Canva tanpa parameter referrer
    header("Location: https://www.canva.com/brand/join?token=" . $invitationInfo['token']);
    exit();
} else {

    // Ambil alamat IP pengguna
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $waktu = date("Y-m-d H:i:s");

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO gagal_effort (ip, waktu) VALUES (?, ?)");
    $stmt->bind_param("ss", $ip_address, $waktu);
    $stmt->execute();
    $stmt->close();

    // Hitung jumlah orang yang gagal akses
    $result = $conn->query("SELECT COUNT(*) AS total FROM gagal_effort");
    $row = $result->fetch_assoc();
    $total_failed_attempts = $row['total'];

    // Ambil lokasi berdasarkan IP (gunakan API ipinfo.io)
    $location_data = @file_get_contents("http://ipinfo.io/{$ip_address}/json");
    $location_info = json_decode($location_data, true);

    $city = $location_info['city'] ?? 'Unknown City';
    $region = $location_info['region'] ?? 'Unknown Region';
    $country = $location_info['country'] ?? 'Unknown Country';

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
            background-image: linear-gradient(135deg, #ffcccc 0%, #ff9999 100%);
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
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(153, 0, 0, 0.2);
            max-width: 450px;
            margin: auto;
            transform: translateY(0);
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        h1 {
            font-size: 2.2em;
            margin-bottom: 15px;
            color: #ff3333;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        p {
            font-size: 1.3em;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        .laugh-emoji {
            font-size: 4em;
            margin-bottom: 20px;
            animation: shake 1s ease-in-out infinite;
        }
        @keyframes shake {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
            100% { transform: rotate(0deg); }
        }
        .location-info {
            font-size: 1.1rem;
            color: #ff3300;
            background-color: #fff0e6;
            padding: 20px;
            border: 3px solid #ff3300;
            border-radius: 15px;
            margin-top: 20px;
            font-weight: bold;
            line-height: 1.8;
            box-shadow: 0 5px 15px rgba(255, 51, 0, 0.15);
            transition: transform 0.3s ease;
        }
        .location-info:hover {
            transform: scale(1.02);
        }
        .info-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0;
            padding: 8px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
        }
        .info-item i {
            margin-right: 10px;
            font-size: 1.2em;
            color: #ff3300;
        }
        .effort-link {
            color: #990000;
            text-decoration: none;
            font-weight: bold;
            margin-top: 25px;
            display: inline-block;
            padding: 12px 25px;
            background-color: #ff6666;
            color: white;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 102, 102, 0.3);
        }
        .effort-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 102, 102, 0.4);
            background-color: #ff4444;
            text-decoration: none;
        }
        .effort-link i {
            margin-left: 8px;
        }
    </style>
    </head>
    <body>
        <div class='error-container'>
        <div class='laugh-emoji'>😂</div>
        <h1><i class='fas fa-exclamation-triangle'></i> HAYO, KETAHUAN!</h1>
        <p>Ngapain coba curang-curang gini? WKWKWK.<br>Usaha dong, minimal effort lah dek!</p>
        <div class='location-info'>
            <div class='info-item'>
                <i class='fas fa-network-wired'></i>
                <span><strong>Alamat IP Anda:</strong> $ip_address</span>
            </div>
            <div class='info-item'>
                <i class='fas fa-map-marker-alt'></i>
                <span><strong>Lokasi:</strong> $city, $region, $country</span>
            </div>
            <div class='info-item'>
                    <i class='fas fa-user-slash'></i>
                    <span><strong>Jumlah Orang Gagal Akses:</strong> $total_failed_attempts</span>
                </div>
        </div>
        <a href='https://www.youtube.com/@fransxeagle' target='_blank' class='effort-link'>
            Coba belajar dulu di sini
            <i class='fas fa-external-link-alt'></i>
        </a>
    </div>
    </body>
    </html>";
}

session_destroy();
