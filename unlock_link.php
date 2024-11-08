<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
require 'config.php';
require 'visitors.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unlock Content - Frans X Eagle</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- CryptoJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <!-- Favicon -->
    <link href="img/about.png" rel="icon">

    <!-- Custom CSS -->
    <style>
        /* Tambahkan di dalam tag <style> yang sudah ada */
        .mouse-snowflake {
            position: fixed;
            background: white;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1000;
            animation: mouseFall linear forwards;
        }

        @keyframes mouseFall {
            to {
                transform: translateY(100vh);
                opacity: 0;
            }
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6D5BBA, #8D58BF, #9E4FCC);
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 700px;
            padding: 2rem 1rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            background: #fff;
            padding: 2rem;
            text-align: center;
        }

        .card h1 {
            font-size: 2rem;
            color: #8D58BF;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .card p {
            color: #666;
            margin-bottom: 2rem;
        }

        .updated-at {
            font-size: 0.9rem;
            color: #888;
            margin-top: 1.5rem;
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            transition: all 0.3s;
            margin-bottom: 1rem;
            cursor: pointer;
            border: 1px solid #ddd;
            position: relative;
            overflow: hidden;
        }

        .action-btn:not(.disabled):hover {
            background: #8D58BF;
            color: #fff;
            border: 1px solid #8D58BF;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(141, 88, 191, 0.2);
        }

        .action-btn i {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .action-btn.done {
            background: #6D5BBA;
            color: #fff;
            border-color: #6D5BBA;
            cursor: not-allowed;
        }

        .action-btn.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #f0f0f0;
        }

        .unlock-btn {
            display: none;
            margin-top: 2rem;
            padding: 1rem 2.5rem;
            border-radius: 25px;
            font-size: 1.1rem;
            background: linear-gradient(45deg, #6D5BBA, #8D58BF);
            border: none;
            color: white;
            transition: all 0.3s;
        }

        .snowflake {
            position: absolute;
            top: 0;
            color: #FFF;
            font-size: 20px;
            animation: fall linear;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100px);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh);
                opacity: 0.5;
            }
        }


        .unlock-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(141, 88, 191, 0.3);
        }

        .timer {
            color: #666;
            font-size: 0.9rem;
            margin-left: 10px;
            display: none;
            font-weight: 600;
        }

        .progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: #8D58BF;
            width: 0;
            transition: width 1s linear;
        }

        .music-control {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #8D58BF;
            cursor: pointer;
        }

        .note {
            display: block;
            background-color: #ffebcc;
            border-left: 5px solid #ffa500;
            padding: 15px;
            margin: 20px 0;
            font-size: 1rem;
            color: #8d4b00;
            border-radius: 5px;
        }

        .note a {
            font-weight: bold;
            color: #ff6600;
            text-decoration: none;
        }

        .note a:hover {
            text-decoration: underline;
        }

        .note-designer {
            display: block;
            background-color: #e6f7ff;
            border-left: 5px solid #3399ff;
            padding: 15px;
            margin: 20px 0;
            font-size: 1rem;
            color: #006699;
            border-radius: 5px;
        }

        .note-designer a {
            color: #0066cc;
            text-decoration: none;
        }

        .note-designer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Notifikasi Tim Penuh -->
        <div class="note">
            <strong>JIKA</strong>Tim Canva penuh, silakan <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20bergabung%20di%20tim%20Canva">chat admin (Klik Disini)</a> untuk bantuan lebih lanjut dan kirimkan buktinya.
        </div>

        <span class="nav-link link text-white display-4">
            Visitors: <strong><?php echo $total_visitors; ?></strong>
        </span>

        <div class="card">
            <h1>Unlock Exclusive Content (F48 TITIK 55)</h1>
            <p>Complete all steps below to access the exclusive content!</p>

            <div id="actions">
                <div id="action-subscribe" class="action-btn" onclick="startAction('subscribe')">
                    <div>
                        <i class="fab fa-youtube text-danger"></i>
                        <span>Subscribe to Frans X Eagle YouTube Channel</span>
                        <span id="timer-subscribe" class="timer"></span>
                    </div>
                    <i class="fas fa-check-circle" style="display: none;"></i>
                    <div class="progress-bar" id="progress-subscribe"></div>
                </div>
                <div id="action-like" class="action-btn disabled" onclick="startAction('like')">
                    <div>
                        <i class="fas fa-thumbs-up text-danger"></i>
                        <span>Like Our Featured Video</span>
                        <span id="timer-like" class="timer"></span>
                    </div>
                    <i class="fas fa-check-circle" style="display: none;"></i>
                    <div class="progress-bar" id="progress-like"></div>
                </div>
                <div id="action-instagram" class="action-btn disabled" onclick="startAction('instagram')">
                    <div>
                        <i class="fab fa-instagram text-danger"></i>
                        <span>Follow on Instagram</span>
                        <span id="timer-instagram" class="timer"></span>
                    </div>
                    <i class="fas fa-check-circle" style="display: none;"></i>
                    <div class="progress-bar" id="progress-instagram"></div>
                </div>
            </div>

            <button id="unlock-btn" class="btn unlock-btn" onclick="unlockLink()">
                Access Exclusive Content
            </button>

            <!-- Kontrol musik -->
            <div class="music-control text-center" onclick="toggleMusic()">
                <i id="music-icon" class="fas fa-play-circle"></i> Music
            </div>
            <audio id="background-music" type="audio/mpeg"></audio>
            <progress id="music-progress" value="0" max="100" style="width: 100%;"></progress>
            <div class="music-time">
                <span id="current-time">0:00</span>
                <span id="duration">0:00</span>
            </div>

            <!-- Kontrol Volume -->
            <div class="volume-control">
                <i class="fas fa-volume-down"></i>
                <input type="range" id="volume-control" min="0" max="1" step="0.1" value="0.5">
                <i class="fas fa-volume-up"></i>
            </div>

            <!-- Updated At Timestamp -->
            <div class="updated-at">
                <span>Updated At: <span id="update-timestamp">2024-11-05 21:30:06 WIB</span></span>
            </div>

        </div>

        <!-- Notifikasi Brand Designer -->
        <div class="note-designer">
            Jika ingin menjadi Brand Designer, <strong>kirim alamat email dan infokan tim Anda ke</strong> <a href="https://wa.me/6281234567890"><strong>chat admin (Klik Disini)</strong></a>. Kami akan tambahkan Anda ke dalam tim sebagai Brand Designer.
        </div>
    </div>

    <script>
        console.log = function() {};

        setInterval(function() {
            if (window.console && (console.__proto__.dir || console.__proto__.log)) {
                const before = new Date();
                debugger;
                const after = new Date();
                if (after - before > 100) {
                    alert("Developer Tools terdeteksi! Anda tidak diizinkan mengakses kode sumber ini.");
                }
            }
        }, 1000);

        document.addEventListener("keydown", function(event) {
            if (event.ctrlKey && (event.key === "u" || event.key === "U")) {
                event.preventDefault();
            }
            if ((event.ctrlKey && event.shiftKey && (event.key === "i" || event.key === "I")) || event.keyCode === 123) {
                event.preventDefault();
            }
        });

        document.addEventListener("keydown", function(event) {
            if (event.ctrlKey) {
                event.preventDefault();
            }
            if (event.keyCode == 123) {
                event.preventDefault();
            }
        });

        document.addEventListener('contextmenu', event => event.preventDefault());

        // Enkripsi sederhana
        const encrypt = (text) => {
            return CryptoJS.AES.encrypt(text, 'your-secret-key').toString();
        };

        const decrypt = (text) => {
            return CryptoJS.AES.decrypt(text, 'your-secret-key').toString(CryptoJS.enc.Utf8);
        };

        // URLs yang dienkripsi
        const socialUrls = {
            subscribe: encrypt('https://www.youtube.com/@fransxeagle'),
            like: encrypt('https://youtu.be/Y25eThOLV1E'),
            instagram: encrypt('https://www.instagram.com/fransxdarmawan/')
        };

        // Status tracking
        const actionsStatus = {
            subscribe: false,
            like: false,
            instagram: false
        };

        let activeTimers = {};

        function startAction(action) {
            const actionBtn = document.getElementById(`action-${action}`);
            if (actionBtn.classList.contains('disabled')) return;

            // Decrypt dan buka URL
            const url = decrypt(socialUrls[action]);
            window.open(url, '_blank');

            // Setup timer dan progress bar
            const timerElement = document.getElementById(`timer-${action}`);
            const progressBar = document.getElementById(`progress-${action}`);
            timerElement.style.display = 'inline';
            actionBtn.style.pointerEvents = 'none';

            let timeLeft = 10; // 15 detik countdown
            progressBar.style.width = '0%';

            // Animate progress bar
            progressBar.style.transition = 'width 10s linear';
            progressBar.style.width = '100%';

            // Start timer
            activeTimers[action] = setInterval(() => {
                timerElement.textContent = `Verifying... Please Wait`;
                timeLeft--;

                if (timeLeft < 0) {
                    clearInterval(activeTimers[action]);
                    completeAction(action);
                    timerElement.style.display = 'none';
                    progressBar.style.width = '100%';
                }
            }, 1000);
        }

        function completeAction(action) {
            actionsStatus[action] = true;
            sessionStorage.setItem(`actionCompleted_${action}`, 'true'); // Menyimpan status aksi sebagai selesai
            const actionBtn = document.getElementById(`action-${action}`);

            // Tandai tindakan selesai
            actionBtn.classList.add('done');
            actionBtn.querySelector('i.fa-check-circle').style.display = 'inline';

            // Mengaktifkan tindakan berikutnya
            const actions = ['subscribe', 'like', 'instagram'];
            const currentIndex = actions.indexOf(action);
            if (currentIndex < actions.length - 1) {
                const nextAction = actions[currentIndex + 1];
                const nextActionBtn = document.getElementById(`action-${nextAction}`);
                nextActionBtn.classList.remove('disabled');
            }

            checkAllActions();
        }

        function checkAllActions() {
            const allCompleted = Object.values(actionsStatus).every(status => status === true);
            if (allCompleted) {
                const unlockBtn = document.getElementById('unlock-btn');
                unlockBtn.style.display = 'inline-block';
            }
        }

        function unlockLink() {
            sessionStorage.setItem('actionsCompleted', 'true');
            window.location.href = 'https://www.canva.com/brand/join?token=O1pTm28qRj-uWc9-N8fs4g&referrer=team-invite';
        }

        window.onload = function() {
            const music = document.getElementById("background-music");
            const musicProgress = document.getElementById("music-progress");

            // Coba memutar musik saat halaman dimuat
            music.play().catch(error => {
                console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.");
            });

            // Update progress bar setiap kali waktu musik berubah
            music.addEventListener("timeupdate", () => {
                const progress = (music.currentTime / music.duration) * 100;
                musicProgress.value = progress;
            });

            // Display current date and time in the "Updated At" section
            const updateTimestamp = document.getElementById("update-timestamp");
            const now = new Date();
            updateTimestamp.textContent = `${now.toLocaleDateString()} ${now.toLocaleTimeString()}`;
        };


        const playlist = [
            "music/1.mp3",
            "music/2.mp3",
            "music/3.mp3",
            "music/4.mp3",
            "music/5.mp3",
            "music/6.mp3"
        ];

        const backgroundMusic = document.getElementById("background-music");
        const musicIcon = document.getElementById("music-icon");
        const musicProgress = document.getElementById("music-progress");
        const currentTimeDisplay = document.getElementById("current-time");
        const durationDisplay = document.getElementById("duration");
        const volumeControl = document.getElementById("volume-control");

        let currentSongIndex = Math.floor(Math.random() * playlist.length); // Pilih lagu acak untuk awal

        // Atur volume awal
        backgroundMusic.volume = 0.5;

        function loadSong(index) {
            backgroundMusic.src = playlist[index];
            backgroundMusic.load();
            backgroundMusic.play().catch(error => {
                console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.");
            });
            updateIcon();
        }

        function toggleMusic() {
            if (backgroundMusic.paused) {
                backgroundMusic.play();
            } else {
                backgroundMusic.pause();
            }
            updateIcon();
        }

        function updateIcon() {
            if (backgroundMusic.paused) {
                musicIcon.classList.replace("fa-pause-circle", "fa-play-circle");
            } else {
                musicIcon.classList.replace("fa-play-circle", "fa-pause-circle");
            }
        }

        backgroundMusic.onloadedmetadata = () => {
            durationDisplay.textContent = formatTime(backgroundMusic.duration);
        };

        backgroundMusic.ontimeupdate = () => {
            const progress = (backgroundMusic.currentTime / backgroundMusic.duration) * 100;
            musicProgress.value = progress;
            currentTimeDisplay.textContent = formatTime(backgroundMusic.currentTime);
        };

        backgroundMusic.onended = () => {
            currentSongIndex = (currentSongIndex + 1) % playlist.length; // Lanjut ke lagu berikutnya
            loadSong(currentSongIndex);
        };

        function formatTime(time) {
            const minutes = Math.floor(time / 60);
            const seconds = Math.floor(time % 60).toString().padStart(2, '0');
            return `${minutes}:${seconds}`;
        }

        volumeControl.addEventListener("input", () => {
            backgroundMusic.volume = volumeControl.value;
        });

        // Muat dan mainkan lagu pertama (acak)
        loadSong(currentSongIndex);

        // Coba otomatis memutar musik saat halaman dimuat
        window.onload = function() {
            backgroundMusic.play().catch(error => {
                console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.");
            });
        };
    </script>
    <script>
        function createSnowflake() {
            const snowflake = document.createElement("div");
            snowflake.classList.add("snowflake");
            snowflake.innerHTML = "❄️";

            // Position and size for each snowflake
            snowflake.style.left = Math.random() * window.innerWidth + "px";
            snowflake.style.fontSize = Math.random() * 10 + 10 + "px"; // 10px to 20px
            snowflake.style.animationDuration = Math.random() * 5 + 5 + "s"; // 5s to 10s fall
            snowflake.style.animationDelay = Math.random() * 3 + "s"; // Staggered start times

            // Add to body and remove on animation end
            document.body.appendChild(snowflake);
            snowflake.addEventListener("animationend", () => snowflake.remove());
        }

        // Generate snowflakes at intervals
        setInterval(createSnowflake, 700); // 700ms for gentle snowfall

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

            // Tambahkan throttling untuk mousemove
            let isThrottled = false;

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