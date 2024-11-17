<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Paste</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
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

html, body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #74ebd5, #ACB6E5);
    margin: 0;
    padding: 0;
    height: 100%; /* Pastikan body dan html memiliki tinggi 100% */
}

.container {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
    width: 100%;
    text-align: left;
    margin: 20px auto;
    position: relative;
    animation: fadeIn 1s ease-in-out;
    height: auto; /* Tambahkan ini untuk membuat konten otomatis menyesuaikan */
}


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .content-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
        }

.content {
    font-size: 18px;
    color: #555;
    white-space: pre-wrap;
    line-height: 1.6; /* Sesuaikan jarak antar baris */
    background: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    max-height: 600px; /* Atur tinggi maksimum untuk mengontrol ruang */
    overflow-y: scroll; /* Pastikan scrollbar vertikal ditampilkan */
}

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .edit-button {
            padding: 10px 20px;
            background-color: #ff6f61;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .edit-button:hover {
            background-color: #ff4a3c;
            transform: translateY(-3px);
        }

        .logo {
            width: 100px;
            height: 100px;
            background: url('logo.png') no-repeat center center;
            background-size: cover;
            border-radius: 50%;
            margin: 0 auto 20px auto;
            display: block;
        }
        
        .navbar {
    background-color: #333;
    padding: 10px 20px;
    color: white;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}

.navbar-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.nav-link {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
    transition: color 0.3s;
}

.nav-link:hover {
    color: #ff6f61; /* Warna saat hover */
}

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="../index.php" class="nav-link">Halaman Utama (KLIK INI)</a>
        </div>
    </nav>
    
    <div class="container">
        <img src="../assets/img/about.png" alt="Logo" class="logo">
        <h1>Konten FransXeagle</h1>

        <?php
        require_once '../services/config.php';
        session_start();

        function getPaste($id, $conn)
        {
            $stmt = $conn->prepare("SELECT * FROM content_simpan WHERE id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        function updateLastIP($id, $conn)
        {
            $last_ip_login = $_SERVER['REMOTE_ADDR'];
            $stmt = $conn->prepare("UPDATE content_simpan SET last_ip_login = ? WHERE id = ?");
            $stmt->bind_param("ss", $last_ip_login, $id);
            $stmt->execute();
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (preg_match('/^[a-f0-9]{32}$/', $id)) {
                $paste = getPaste($id, $conn);

               if ($paste) {
                    updateLastIP($id, $conn);
                    echo '<div class="content-title">' . htmlspecialchars($paste['title']) . ' ✅</div>';
                    
                    // Menggunakan htmlspecialchars_decode untuk menampilkan tanda kutip ganda secara harfiah
                    $decodedContent = htmlspecialchars_decode($paste['content'], ENT_QUOTES);
                    echo '<div class="content">' . nl2br($decodedContent) . '</div>';
                
                    echo '<div class="created-at">Dibuat pada: ' . htmlspecialchars($paste['created_at']) . '</div>';
                } else {
                    echo '<div class="content">Paste tidak ditemukan.</div>';
                }

            } else {
                echo '<div class="content">ID tidak valid.</div>';
            }
        } else {
            echo '<div class="content">ID tidak disediakan.</div>';
        }
        ?>

        <!-- Button to go to edit page -->
        <div class="button-container">
            <a href="edit_paste.php?id=<?php echo $id; ?>" class="edit-button">Edit Paste</a>
        </div>

        <div class="footer">&copy; 2024 FransXeagle. All rights reserved.</div>
    </div>

    <script>
        let snowflakeCount = 0; // Variabel global untuk menghitung kepingan salju
        const maxSnowflakes = 20; // Batas maksimal kepingan salju
        function createSnowflake() {
            if (snowflakeCount >= maxSnowflakes) return; // Cek batas maksimal

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
            snowflakeCount++; // Tambah hitungan kepingan salju

            snowflake.addEventListener("animationend", () => {
                snowflake.remove();
                snowflakeCount--; // Kurangi hitungan saat salju dihapus
            });
        }

        // Interval untuk membuat efek salju secara berkala
        setInterval(createSnowflake, 1000); // 700ms untuk efek salju yang lembut

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