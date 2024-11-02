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
        <div class="card">
            <h1>Unlock Exclusive Content (F48 TITIK 8)</h1>
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

        </div>

        <!-- Notifikasi Tim Penuh -->
        <div class="note">
            Jika Tim Canva penuh, silakan <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20bergabung%20di%20tim%20Canva">chat admin (Klik Disini)</a> untuk bantuan lebih lanjut.
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
            window.location.href = 'https://www.canva.com/brand/join?token=wlfWqvSBguZ3tB9GYFij_A&referrer=team-invite';
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
</body>

</html>