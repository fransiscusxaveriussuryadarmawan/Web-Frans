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
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Unlock Exclusive Content</h1>
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
        </div>
    </div>

    <script>
        if (window.location.hostname !== "fransxeagle.com" && window.location.hostname !== "localhost") {
            document.body.innerHTML = "<h1>Akses Ditolak</h1>";
        }

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

        })

        document.addEventListener('contextmenu',
            event => event.preventDefault()
        )

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
            like: encrypt('https://www.youtube.com/watch?v=XAk0iFxrR4E&t=15s'),
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
            // Simpan status di sessionStorage
            sessionStorage.setItem('actionsCompleted', 'true');
            window.location.href = 'https://fransxeagle.com/';
        }

        // Check if actions were already completed
        window.onload = function() {
            // Reset session data setiap kali halaman dibuka
            sessionStorage.removeItem('actionsCompleted');

            // Menghapus status setiap tindakan di sessionStorage, jika sudah ada
            Object.keys(actionsStatus).forEach(action => sessionStorage.removeItem(`actionCompleted_${action}`));

            if (sessionStorage.getItem('actionsCompleted') === 'true') {
                Object.keys(actionsStatus).forEach(action => completeAction(action));
            }
        };
    </script>
</body>

</html>