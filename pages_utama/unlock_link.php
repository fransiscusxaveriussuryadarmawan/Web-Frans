<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
require '../services/config.php';
require 'visitors.php';

session_start(); // Memulai sesi baru

// Buat token aman
$token = bin2hex(random_bytes(16));
$_SESSION['token'] = $token;

// Daftar domain yang diizinkan untuk mengakses halaman ini
$allowed_domains = ['https://fransxeagle.com', 'http://localhost'];

// Periksa HTTP_ORIGIN atau HOST
$origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_HOST'] ?? '';

if (in_array($origin, $allowed_domains) || $_SERVER['HTTP_HOST'] === 'fransxeagle.com' || $_SERVER['HTTP_HOST'] === 'localhost') {
    // Jika domain diizinkan, kirim header Access-Control-Allow-Origin
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
} else {
    // Jika domain tidak diizinkan, kirim respon 403 Forbidden
    header("HTTP/1.1 403 Forbidden");
    header("Location: https://fransxeagle.com");
    exit("Silakan Akses di https://fransxeagle.com");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valid_password = 'saatnya2025'; // Password yang valid
    $password = $_POST['password'] ?? '';

    if ($password === $valid_password) {
        echo json_encode([
            'status' => 'success',
            'redirect' => 'redirectToCanva.php?token=' . $_SESSION['token']
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => '⚠️ Wrong password! Please read the instructions on this page carefully and try again.'
        ]);
    }
    exit; // Pastikan tidak melanjutkan rendering HTML jika ini adalah request POST
}
?>

<!doctypehtml>
    <html lang=en>
    <meta charset=UTF-8>
    <meta content="width=device-width,initial-scale=1" name=viewport>
    <title>Unlock Content - Frans X Eagle</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel=stylesheet>
    <link href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css rel=stylesheet>
    <link href=https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css rel=stylesheet>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js></script>
    <link href=../assets/img/about.png rel=icon>
    <style>
        .mouse-snowflake {
            position: fixed;
            background: #fff;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1000;
            animation: mouseFall linear forwards
        }

        @keyframes mouseFall {
            to {
                transform: translateY(100vh);
                opacity: 0
            }
        }

        body {
            font-family: Poppins, sans-serif;
            background: linear-gradient(135deg, #6d5bba, #8d58bf, #9e4fcc);
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .container {
            max-width: 700px;
            padding: 2rem 1rem
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .15);
            background: #fff;
            padding: 2rem;
            text-align: center
        }

        .card h1 {
            font-size: 2rem;
            color: #8d58bf;
            font-weight: 600;
            margin-bottom: 1.5rem
        }

        .card p {
            color: #666;
            margin-bottom: 2rem
        }

        .updated-at {
            font-size: .9rem;
            color: #888;
            margin-top: 1.5rem
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            transition: all .3s;
            margin-bottom: 1rem;
            cursor: pointer;
            border: 1px solid #ddd;
            position: relative;
            overflow: hidden
        }

        .action-btn:not(.disabled):hover {
            background: #8d58bf;
            color: #fff;
            border: 1px solid #8d58bf;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(141, 88, 191, .2)
        }

        .action-btn i {
            font-size: 1.5rem;
            margin-right: 1rem
        }

        .action-btn.done {
            background: #6d5bba;
            color: #fff;
            border-color: #6d5bba;
            cursor: not-allowed
        }

        .action-btn.disabled {
            opacity: .6;
            cursor: not-allowed;
            background: #f0f0f0
        }

        .unlock-btn {
            display: none;
            margin-top: 2rem;
            padding: 1rem 2.5rem;
            border-radius: 25px;
            font-size: 1.1rem;
            background: linear-gradient(45deg, #6d5bba, #8d58bf);
            border: none;
            color: #fff;
            transition: all .3s
        }

        .snowflake {
            position: absolute;
            top: 0;
            color: #fff;
            font-size: 20px;
            animation: fall linear
        }

        @keyframes fall {
            0% {
                transform: translateY(-100px);
                opacity: 1
            }

            100% {
                transform: translateY(100vh);
                opacity: .5
            }
        }

        .unlock-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(141, 88, 191, .3)
        }

        .timer {
            color: #666;
            font-size: .9rem;
            margin-left: 10px;
            display: none;
            font-weight: 600
        }

        .progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: #8d58bf;
            width: 0;
            transition: width 1s linear
        }

        .music-control {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #8d58bf;
            cursor: pointer
        }

        .note {
            display: block;
            background-color: #ffebcc;
            border-left: 5px solid orange;
            padding: 15px;
            margin: 20px 0;
            font-size: 1rem;
            color: #8d4b00;
            border-radius: 5px
        }

        .note a {
            font-weight: 700;
            color: #f60;
            text-decoration: none
        }

        .note a:hover {
            text-decoration: underline
        }

        .note-designer {
            display: block;
            background-color: #e6f7ff;
            border-left: 5px solid #39f;
            padding: 15px;
            margin: 20px 0;
            font-size: 1rem;
            color: #069;
            border-radius: 5px
        }

        .note-designer a {
            color: #06c;
            text-decoration: none
        }

        .note-designer a:hover {
            text-decoration: underline
        }

        .blink {
            color: red;
            text-decoration: underline;
            font-size: 1.1rem;
            animation: blinkAnimation 1s infinite
        }

        @keyframes blinkAnimation {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0
            }
        }

        .blink {
            font-size: 1.8rem;
            font-weight: bold;
            color: #fff;
            text-decoration: underline;
            position: relative;
            background: linear-gradient(90deg, #ff0000, #ff7f00, #ff0000);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite, shake 0.5s infinite alternate;
            display: inline-block;
            padding: 5px 15px;
        }

        .blink::before {
            content: "⚠️";
            position: absolute;
            left: -30px;
            font-size: 2rem;
            color: #ff4500;
        }

        .blink:hover {
            transform: scale(1.1);
        }

        @keyframes shimmer {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(5px);
            }
        }
    </style>
    <div class=container>
        <div class=note><strong class=blink>JIKA</strong> Tim Canva penuh, silakan <a href="https://wa.me/6282138616235?text=Min%20timnya%20sudah%20Full%0A%0Aini%20saya%20kirimkan%20bukti%20foto%20atau%20SS%20sekarang%0A%0A*Mengirimkan%20bukti%20supaya%20anda%20tidak%20berbohong%20alias%20ngaku2%20full%20padahal%20masih%20ada%20slot*">chat admin (KLIK DISINI)</a> untuk bantuan lebih lanjut dan kirimkan buktinya. <a href="#" onclick="openExampleImage()">Lihat contoh bukti (KLIK DISINI)</a>.</div>
        <div class=card>
            <h1>Unlock Exclusive Content Team FransXeagle</h1>
            <p>Complete all steps below to access the exclusive content!
            <div id=actions>
                <div class=action-btn id=action-subscribe onclick='startAction("subscribe")'>
                    <div><i class="text-danger fab fa-youtube"></i> <span>Subscribe to Frans X Eagle YouTube Channel</span> <span id=timer-subscribe class=timer></span></div><i class="fas fa-check-circle" style=display:none></i>
                    <div class=progress-bar id=progress-subscribe></div>
                </div>
                <div class="action-btn disabled" id=action-like onclick='startAction("like")'>
                    <div><i class="fas fa-thumbs-up text-danger"></i> <span>Like Our Featured Video</span> <span id=timer-like class=timer></span></div><i class="fas fa-check-circle" style=display:none></i>
                    <div class=progress-bar id=progress-like></div>
                </div>
                <div class="action-btn disabled" id=action-instagram onclick='startAction("instagram")'>
                    <div><i class="text-danger fab fa-instagram"></i> <span>Follow on Instagram</span> <span id=timer-instagram class=timer></span></div><i class="fas fa-check-circle" style=display:none></i>
                    <div class=progress-bar id=progress-instagram></div>
                </div>
            </div>
            <input type="text" id="password-input" class="form-control" placeholder="Enter Password" style="margin-top: 1rem; display: none;">
            <input type="checkbox" id="show-password" style="margin-top: 0.5rem; display: none;" onclick="togglePasswordVisibility()">
            <div id="password-note" class="note" style="display: none;">
                ⚠️ Silakan masukkan PASSWORD yang ada pada video ini di antara menit 4 - menit 7
                <a href="https://youtu.be/sKtCmRHwrPQ" target="_blank">FransXeagle YouTube (KLIK DISINI)</a>
            </div>
            <div id="error-message" class="alert alert-danger" style="display: none; margin-top: 1rem;"></div>
            <button class="btn unlock-btn" id=unlock-btn onclick=unlockLink()>Access Exclusive Content</button>
            <div class="note" style="margin-top: 1rem;">
                <strong>Kalian ingin tanpa password?</strong> Ingin instan? <a href="https://fransxeagle.com/join_instan" target="_blank">Silakan klik disini untuk pergi ke halaman instan</a>.
            </div>
            <div class="music-control text-center" onclick=toggleMusic()><i class="fas fa-play-circle" id=music-icon></i> Music</div><audio id=background-music type=audio/mpeg></audio><progress id=music-progress max=100 style=width:100% value=0></progress>
            <div class=music-time><span id=current-time>0:00</span> <span id=duration>0:00</span></div>
            <div class=volume-control><i class="fas fa-volume-down"></i> <input id=volume-control max=1 min=0 step=0.1 type=range value=0.5> <i class="fas fa-volume-up"></i></div>
            <div class=updated-at><span>Updated At: <span id=update-timestamp>2024-12-27 21:30:06 WIB</span></span></div><span class=updated-at>Visitors: <strong><?php echo $total_visitors; ?></strong></span>
        </div>
        <div class="note">
            <strong>Note:</strong> Kami menambahkan password untuk memastikan hanya pengguna yang menonton video kami yang dapat mengakses konten eksklusif ini. Terima kasih atas pengertian dan dukungannya.
        </div>
        <div class=note-designer>Jika ingin menjadi Brand Designer, <strong>kirim alamat email dan infokan tim Anda ke</strong> <a href="https://wa.me/6282138616235?text=Halo%20admin%20saya%20ingin%20jadi%20brand%20designer%0A%0AAlamat%20email%20:%20*%23email%20canva%20kamu*%0A%0ASaya%20berada%20di%20tim%20:%20*%23nama%20tim%20kamu%20sekarang*"><strong>chat admin (Klik Disini)</strong></a>. Kami akan mengubah role Anda di tim tersebut sebagai Brand Designer.</div>
    </div>

    <script>
        let lanternCount = 0;
        const maxLanterns = 20;

        function createLantern() {
            if (lanternCount >= maxLanterns) return;

            const lantern = document.createElement("div");
            lantern.classList.add("lantern");

            // Posisi awal lentera
            lantern.style.left = Math.random() * window.innerWidth + "px";

            // Durasi animasi dan delay secara acak
            const fallDuration = 5 * Math.random() + 5;
            const swayDelay = Math.random() * 3;
            lantern.style.animationDuration = `${fallDuration}s`;
            lantern.style.animationDelay = `${swayDelay}s`;

            document.body.appendChild(lantern);
            lanternCount++;

            // Hapus elemen setelah animasi selesai
            lantern.addEventListener("animationend", () => {
                lantern.remove();
                lanternCount--;
            });
        }

        // Interval untuk membuat lentera secara berkala
        setInterval(createLantern, 1000);















        console.log = function() {}, setInterval((function() {
            if (window.console && (console.__proto__.dir || console.__proto__.log)) {
                const e = new Date;
                new Date - e > 100 && alert("Developer Tools terdeteksi! Anda tidak diizinkan mengakses kode sumber ini.")
            }
        }), 1e3), document.addEventListener("keydown", (function(e) {
            !e.ctrlKey || "u" !== e.key && "U" !== e.key || e.preventDefault(), (e.ctrlKey && e.shiftKey && ("i" === e.key || "I" === e.key) || 123 === e.keyCode) && e.preventDefault()
        })), document.addEventListener("keydown", (function(e) {
            e.ctrlKey && e.preventDefault(), 123 == e.keyCode && e.preventDefault()
        })), document.addEventListener("contextmenu", (e => e.preventDefault()));
        const encrypt = e => CryptoJS.AES.encrypt(e, "your-secret-key").toString(),
            decrypt = e => CryptoJS.AES.decrypt(e, "your-secret-key").toString(CryptoJS.enc.Utf8),
            socialUrls = {
                subscribe: encrypt("https://www.youtube.com/@fransxeagle"),
                like: encrypt("https://youtu.be/sKtCmRHwrPQ"),
                instagram: encrypt("https://www.instagram.com/fransxdarmawan/")
            },
            actionsStatus = {
                subscribe: !1,
                like: !1,
                instagram: !1
            };
        let activeTimers = {};

        function startAction(e) {
            const t = document.getElementById(`action-${e}`);
            if (t.classList.contains("disabled")) return;
            const n = decrypt(socialUrls[e]);
            window.open(n, "_blank");
            const o = document.getElementById(`timer-${e}`),
                a = document.getElementById(`progress-${e}`);
            o.style.display = "inline", t.style.pointerEvents = "none";
            let s = 10;
            a.style.width = "0%", a.style.transition = "width 10s linear", a.style.width = "100%", activeTimers[e] = setInterval((() => {
                o.textContent = "Verifying... Please Wait", s--, s < 0 && (clearInterval(activeTimers[e]), completeAction(e), o.style.display = "none", a.style.width = "100%")
            }), 1e3)
        }

        function completeAction(e) {
            actionsStatus[e] = !0, sessionStorage.setItem(`actionCompleted_${e}`, "true");
            const t = document.getElementById(`action-${e}`);
            t.classList.add("done"), t.querySelector("i.fa-check-circle").style.display = "inline";
            const n = ["subscribe", "like", "instagram"],
                o = n.indexOf(e);
            if (o < n.length - 1) {
                const e = n[o + 1];
                document.getElementById(`action-${e}`).classList.remove("disabled")
            }
            checkAllActions()
        }

        function checkAllActions() {
            if (Object.values(actionsStatus).every((e => !0 === e))) {
                document.getElementById("unlock-btn").style.display = "inline-block";
                document.getElementById("password-input").style.display = "block";
                document.getElementById("password-note").style.display = "block";
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password-input");
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }

        function unlockLink() {
            const password = document.getElementById('password-input').value;
            fetch('unlock_link.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = data.redirect;
                    } else {
                        const errorMessage = document.getElementById('error-message');
                        errorMessage.style.display = 'block';
                        errorMessage.textContent = data.message;
                    }
                });
        }

        function openExampleImage() {
            window.open('https://fransxeagle.com/bukti_full', '_blank');
        }

        window.onload = function() {
            const e = document.getElementById("background-music"),
                t = document.getElementById("music-progress");
            e.play().catch((e => {
                console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.")
            })), e.addEventListener("timeupdate", (() => {
                const n = e.currentTime / e.duration * 100;
                t.value = n
            }));
            const n = document.getElementById("update-timestamp"),
                o = new Date;
            n.textContent = `${o.toLocaleDateString()} ${o.toLocaleTimeString()}`
        };
        const playlist = ["../assets/music/1.mp3", "../assets/music/2.mp3", "../assets/music/3.mp3", "../assets/music/4.mp3", "../assets/music/5.mp3", "../assets/music/6.mp3"],
            backgroundMusic = document.getElementById("background-music"),
            musicIcon = document.getElementById("music-icon"),
            musicProgress = document.getElementById("music-progress"),
            currentTimeDisplay = document.getElementById("current-time"),
            durationDisplay = document.getElementById("duration"),
            volumeControl = document.getElementById("volume-control");
        let currentSongIndex = Math.floor(Math.random() * playlist.length);

        function loadSong(e) {
            backgroundMusic.src = playlist[e], backgroundMusic.load(), backgroundMusic.play().catch((e => {
                console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.")
            })), updateIcon()
        }

        function toggleMusic() {
            backgroundMusic.paused ? backgroundMusic.play() : backgroundMusic.pause(), updateIcon()
        }

        function updateIcon() {
            backgroundMusic.paused ? musicIcon.classList.replace("fa-pause-circle", "fa-play-circle") : musicIcon.classList.replace("fa-play-circle", "fa-pause-circle")
        }

        function formatTime(e) {
            return `${Math.floor(e/60)}:${Math.floor(e%60).toString().padStart(2,"0")}`
        }
        backgroundMusic.volume = .5, backgroundMusic.onloadedmetadata = () => {
            durationDisplay.textContent = formatTime(backgroundMusic.duration)
        }, backgroundMusic.ontimeupdate = () => {
            const e = backgroundMusic.currentTime / backgroundMusic.duration * 100;
            musicProgress.value = e, currentTimeDisplay.textContent = formatTime(backgroundMusic.currentTime)
        }, backgroundMusic.onended = () => {
            currentSongIndex = (currentSongIndex + 1) % playlist.length, loadSong(currentSongIndex)
        }, volumeControl.addEventListener("input", (() => {
            backgroundMusic.volume = volumeControl.value
        })), loadSong(currentSongIndex), window.onload = function() {
            backgroundMusic.play().catch((e => {
                console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.")
            }))
        };
        let snowflakeCount = 0;
        const maxSnowflakes = 20;

        function createSnowflake() {
            if (snowflakeCount >= 20) return;
            const e = document.createElement("div");
            e.classList.add("snowflake"), e.innerHTML = "❄️", e.style.left = Math.random() * window.innerWidth + "px", e.style.fontSize = 10 * Math.random() + 10 + "px", e.style.animationDuration = 5 * Math.random() + 5 + "s", e.style.animationDelay = 3 * Math.random() + "s", document.body.appendChild(e), snowflakeCount++, e.addEventListener("animationend", (() => {
                e.remove(), snowflakeCount--
            }))
        }
        setInterval(createSnowflake, 1e3), document.addEventListener("DOMContentLoaded", (() => {
            const e = document.body;
            let t = 0,
                n = 0,
                o = 0;
            let a = !1;
            document.addEventListener("mousemove", (s => {
                a || (t = s.clientX, n = s.clientY, Math.random() < .15 && function(t, n) {
                    const a = Date.now();
                    if (a - o < 100) return;
                    o = a;
                    const s = document.createElement("div");
                    s.className = "mouse-snowflake";
                    const c = 3 * Math.random() + 1;
                    s.style.width = c + "px", s.style.height = c + "px";
                    const i = 30 * (Math.random() - .5),
                        r = 10 * (Math.random() - .5);
                    s.style.left = t + i + "px", s.style.top = n + r + "px";
                    const l = 2 * Math.random() + 1;
                    s.style.animation = `mouseFall ${l}s linear forwards`, e.appendChild(s), setTimeout((() => {
                        s.remove()
                    }), 1e3 * l)
                }(t, n), a = !0, setTimeout((() => {
                    a = !1
                }), 50))
            }))
        }));
    </script>

    </body>

    </html>