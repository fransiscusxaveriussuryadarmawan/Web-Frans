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

        .music-control {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #8D58BF;
            cursor: pointer;
        }

        .music-control i {
            transition: transform 0.2s;
        }

        .music-control.playing i {
            transform: scale(1.2);
            color: #6D5BBA;
        }

        #music-progress {
            width: 100%;
            margin-top: 10px;
        }

        .volume-control {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            color: #8D58BF;
        }

        .volume-control input[type="range"] {
            margin-left: 10px;
            width: 100px;
        }

        .music-time {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Unlock Exclusive Content</h1>
            <p>Complete all steps below to access the exclusive content!</p>

            <!-- Kontrol Musik -->
            <div class="music-control text-center" onclick="toggleMusic()">
                <i id="music-icon" class="fas fa-play-circle"></i> Music
            </div>
            <audio id="background-music" src="music/halo.mp3" type="audio/mpeg"></audio>

            <!-- Progress Musik -->
            <progress id="music-progress" value="0" max="100"></progress>
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
    </div>

    <script>
        const backgroundMusic = document.getElementById("background-music");
        const musicIcon = document.getElementById("music-icon");
        const musicProgress = document.getElementById("music-progress");
        const currentTimeDisplay = document.getElementById("current-time");
        const durationDisplay = document.getElementById("duration");
        const volumeControl = document.getElementById("volume-control");

        backgroundMusic.volume = 0.5;

        backgroundMusic.onloadedmetadata = () => {
            durationDisplay.textContent = formatTime(backgroundMusic.duration);
        };

        function toggleMusic() {
            if (backgroundMusic.paused) {
                backgroundMusic.play();
                musicIcon.classList.replace("fa-play-circle", "fa-pause-circle");
                musicIcon.parentElement.classList.add("playing");
            } else {
                backgroundMusic.pause();
                musicIcon.classList.replace("fa-pause-circle", "fa-play-circle");
                musicIcon.parentElement.classList.remove("playing");
            }
        }

        backgroundMusic.ontimeupdate = () => {
            const progress = (backgroundMusic.currentTime / backgroundMusic.duration) * 100;
            musicProgress.value = progress;
            currentTimeDisplay.textContent = formatTime(backgroundMusic.currentTime);
        };

        function formatTime(time) {
            const minutes = Math.floor(time / 60);
            const seconds = Math.floor(time % 60).toString().padStart(2, '0');
            return `${minutes}:${seconds}`;
        }

        volumeControl.addEventListener("input", () => {
            backgroundMusic.volume = volumeControl.value;
        });

        window.onload = function() {
            backgroundMusic.play().catch(error => {
                console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.");
            });
        };
    </script>
</body>

</html>