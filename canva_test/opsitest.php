<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch and Unlock</title>
    <script src="https://www.youtube.com/iframe_api"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            margin-top: 50px;
        }

        #unlock-button {
            display: none;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #unlock-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        #remaining-time {
            font-size: 1.2em;
            color: #333;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Tonton Video untuk Unlock Konten</h1>
    <p>Tonton video ini selama <strong>3 menit</strong> untuk melanjutkan ke langkah berikutnya.</p>

    <!-- YouTube Player -->
    <div id="player" style="margin: 0 auto; width: 80%; max-width: 600px;"></div>

    <!-- Remaining Time -->
    <p id="remaining-time">Sisa waktu: <span id="time-left">180</span> detik</p>

    <!-- Unlock Button -->
    <button id="unlock-button" onclick="unlockContent()">Unlock Content</button>

    <script>
        let player;
        let watchTime = 0; // Waktu yang telah ditonton (dalam detik)
        const requiredTime = 180; // Waktu minimal yang harus ditonton (3 menit)
        let interval;

        // Inisialisasi YouTube Player
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '360',
                width: '640',
                videoId: 'Ou6r01rWWBA', // Ganti dengan ID video Anda
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // Fungsi untuk melacak status video
        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.PLAYING) {
                startTracking(); // Mulai melacak waktu
            } else {
                stopTracking(); // Hentikan pelacakan
            }
        }

        // Mulai melacak waktu menonton
        function startTracking() {
            if (!interval) {
                interval = setInterval(() => {
                    watchTime++;
                    const remainingTime = Math.max(requiredTime - watchTime, 0); // Hitung sisa waktu
                    document.getElementById('time-left').textContent = remainingTime; // Tampilkan sisa waktu

                    if (watchTime >= requiredTime) {
                        clearInterval(interval); // Hentikan pelacakan
                        enableUnlockButton(); // Aktifkan tombol "Unlock"
                    }
                }, 1000); // Perbarui setiap detik
            }
        }

        // Hentikan pelacakan waktu menonton
        function stopTracking() {
            clearInterval(interval);
            interval = null;
        }

        // Aktifkan tombol "Unlock"
        function enableUnlockButton() {
            const unlockButton = document.getElementById('unlock-button');
            unlockButton.style.display = 'block'; // Tampilkan tombol
            unlockButton.disabled = false; // Aktifkan tombol

            // Sembunyikan informasi sisa waktu
            document.getElementById('remaining-time').style.display = 'none';
        }

        // Fungsi untuk unlock konten
        function unlockContent() {
            alert('Konten berhasil di-unlock!'); // Ganti dengan aksi lain, seperti redirect
            window.location.href = 'https://fransxeagle.com/unlocked-content'; // Redirect ke halaman konten
        }
    </script>
</body>

</html>