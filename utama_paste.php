<!DOCTYPE html>

<html lang="id">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simpan Content</title>

    <link rel="shortcut icon" href="assets/images/logo2.png" type="image/x-icon">

    <link rel="stylesheet" href="styles.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->

    <link href="img/about.png" rel="icon">

    <style>
        body {

            font-family: 'Poppins', sans-serif;

            background: linear-gradient(to right, #74ebd5, #ACB6E5);

            margin: 0;

            padding: 0;

            display: flex;

            justify-content: center;

            align-items: center;

            height: 100vh;

        }



        .container {

            background: #fff;

            padding: 40px;

            border-radius: 15px;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);

            max-width: 500px;

            width: 100%;

            text-align: center;

        }



        .logo {

            width: 100px;

            height: 100px;

            background: url('logo.png') no-repeat center center;

            background-size: cover;

            border-radius: 50%;

            margin: 0 auto 20px auto;

        }



        h1 {

            font-size: 30px;

            margin-bottom: 20px;

            color: #333;

        }



        p {

            font-size: 18px;

            color: #666;

            margin-bottom: 20px;

        }



        textarea {

            width: 100%;

            height: 150px;

            padding: 15px;

            margin-bottom: 20px;

            border: 1px solid #ddd;

            border-radius: 10px;

            resize: vertical;

            font-size: 16px;

            font-family: 'Poppins', sans-serif;

        }



        button {

            width: 100%;

            padding: 15px;

            background-color: #ff6f61;

            border: none;

            color: white;

            font-size: 18px;

            cursor: pointer;

            border-radius: 10px;

            transition: background-color 0.3s, transform 0.3s;

        }



        button:hover {

            background-color: #ff4a3c;

            transform: translateY(-3px);

        }



        .message {

            text-align: center;

            margin-top: 20px;

            font-size: 16px;

            color: #28a745;

        }

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
    </style>

</head>



<body>

    <div class="container">

        <div class="logo"></div>

        <h1>Simpan FransXeagle</h1>

        <p>Masukkan teks yang ingin Anda simpan di bawah ini:</p>

        <form action="save_paste.php" method="POST">

            <label for="title">Judul:</label><br>

            <input type="text" id="title" name="title" required><br><br>

            <label for="content">Konten:</label><br>

            <textarea id="content" name="content" rows="10" cols="30" required></textarea><br><br>

            <input type="submit" value="Simpan Paste">

        </form>

        <?php

        if (isset($_GET['message'])) {

            echo '<div class="message">' . htmlspecialchars($_GET['message']) . '</div>';
        }

        ?>

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