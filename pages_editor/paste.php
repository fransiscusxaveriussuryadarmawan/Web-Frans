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

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: left;
            margin: 20px;
            position: relative;
            animation: fadeIn 1s ease-in-out;
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
            line-height: 1.6;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            overflow-y: auto;
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
    </style>
</head>

<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <h1>Konten FransXeagle</h1>

        <?php
        require_once 'config.php';
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
                    echo '<div class="content">' . nl2br(htmlspecialchars($paste['content'])) . '</div>';
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
    </script>
</body>

</html>