<!DOCTYPE html>
<html>

<head>
    <style>
        .snowflake {
            position: fixed;
            top: -10px;
            color: white;
            font-size: 1em;
            font-family: Arial, sans-serif;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
            user-select: none;
            z-index: 1000;
            animation: fall linear forwards;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh);
            }
        }

        /* Container untuk mengontrol area salju */
        .snow-container {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 100;
        }
    </style>
</head>

<body>

    <div class="snow-container" id="snow-container"></div>

    <script>
        const snowContainer = document.getElementById('snow-container');
        const snowflakes = ['❅', '❆', '❄']; // Variasi bentuk salju
        const maxSnowflakes = 30; // Jumlah maksimal kepingan salju yang tampil
        let activeSnowflakes = 0;

        function createSnowflake() {
            if (activeSnowflakes >= maxSnowflakes) return;

            const snowflake = document.createElement('div');
            snowflake.className = 'snowflake';
            snowflake.textContent = snowflakes[Math.floor(Math.random() * snowflakes.length)];

            // Posisi horizontal acak
            const startPos = Math.random() * window.innerWidth;
            snowflake.style.left = startPos + 'px';

            // Kecepatan jatuh acak (4-8 detik)
            const fallDuration = 4 + Math.random() * 4;
            snowflake.style.animationDuration = fallDuration + 's';

            // Ukuran acak
            const size = 10 + Math.random() * 10;
            snowflake.style.fontSize = size + 'px';

            snowContainer.appendChild(snowflake);
            activeSnowflakes++;

            // Hapus snowflake setelah animasi selesai
            snowflake.addEventListener('animationend', () => {
                snowflake.remove();
                activeSnowflakes--;
            });
        }

        // Buat snowflake baru setiap 300ms
        setInterval(createSnowflake, 300);
    </script>

</body>

</html>