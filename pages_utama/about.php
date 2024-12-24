<?php
// Header untuk mencegah caching
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT"); // Tanggal masa lalu
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Set variabel yang digunakan dalam halaman
$title = "FransXeagle YouTube";
$csrfToken = "YM2OIKfwWytVKoQ3tAuDuYLtjEfc6Oo3jotAwza1";
require '../services/config.php';
require 'visitors.php';

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
?>

<!doctypehtml><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"rel=stylesheet><link href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css rel=stylesheet><link href=https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css rel=stylesheet><script src=https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js></script><meta charset=UTF-8><meta content="IE=edge"http-equiv=X-UA-Compatible><meta content="Mobirise v5.0.2, mobirise.com"name=generator><meta content="width=device-width,initial-scale=1,minimum-scale=1"name=viewport><link href=../assets/images/logo2.png rel="shortcut icon"type=image/x-icon><meta content="New SolutionM4 Theme HTML Template - Download Now!"name=description><link href=../assets/img/about.png rel=icon><title>FransXeagle YouTube</title><link href=../assets/web/assets/mobirise-icons/mobirise-icons.css rel=stylesheet><link href=../assets/web/assets/mobirise-icons2/mobirise2.css rel=stylesheet><link href=../assets/tether/tether.min.css rel=stylesheet><link href=../assets/bootstrap/css/bootstrap.min.css rel=stylesheet><link href=../assets/bootstrap/css/bootstrap-grid.min.css rel=stylesheet><link href=../assets/bootstrap/css/bootstrap-reboot.min.css rel=stylesheet><link href=../assets/dropdown/css/style.css rel=stylesheet><link href=../assets/formstyler/jquery.formstyler.css rel=stylesheet><link href=../assets/formstyler/jquery.formstyler.theme.css rel=stylesheet><link href=../assets/datepicker/jquery.datetimepicker.min.css rel=stylesheet><link href=../assets/socicon/css/styles.css rel=stylesheet><link href=../assets/theme/css/style.css rel=stylesheet><link href=../assets/mobirise/css/mbr-additional.css rel=preload as=style><link href=../assets/mobirise/css/mbr-additional.css rel=stylesheet><link href=../mobirise/style.css rel=stylesheet><style>.snowflake{position:fixed;top:-10px;z-index:1000;color:#fff;font-size:1.2em;pointer-events:none;animation:fall linear infinite}@keyframes fall{0%{transform:translateY(0);opacity:1}100%{transform:translateY(100vh);opacity:0}}.mouse-snowflake{position:fixed;background:#fff;border-radius:50%;pointer-events:none;z-index:1000;animation:mouseFall linear forwards}@keyframes mouseFall{to{transform:translateY(100vh);opacity:0}}.music-control,.music-time,.volume-control{background-color:#333;color:#f9f9f9;padding:10px;border-radius:8px;display:inline-flex;align-items:center;gap:10px;margin-top:10px}.music-control i#music-icon{font-size:1.5em;color:#1db954;cursor:pointer}#music-progress{width:100%;height:8px;background-color:#444;border-radius:4px;appearance:none}#music-progress::-webkit-progress-bar{background-color:#444;border-radius:4px}#music-progress::-webkit-progress-value{background-color:#1db954;border-radius:4px}#music-progress::-moz-progress-bar{background-color:#1db954;border-radius:4px}.volume-control{width:100%}.volume-control input[type=range]{width:100%;accent-color:#1db954}.volume-control i{color:#f9f9f9;font-size:1.2em}.music-time span{font-family:Poppins,sans-serif;font-weight:600;font-size:1em}</style><script>!function(e,t,a,n,g){e[n]=e[n]||[],e[n].push({"gtm.start":(new Date).getTime(),event:"gtm.js"});var m=t.getElementsByTagName(a)[0],r=t.createElement(a);r.async=!0,r.src="//www.googletagmanager.com/gtm.js?id=GTM-PFK425",m.parentNode.insertBefore(r,m)}(window,document,"script","dataLayer")</script><body><noscript><iframe height=0 src="//www.googletagmanager.com/ns.html?id=GTM-PFK425"style=display:none;visibility:hidden width=0></iframe></noscript><section class="cid-s1YNw91RvB menu"id=menu1-1 once=menu><nav class="navbar navbar-dropdown navbar-expand-lg navbar-fixed-top"><div class=container><div class=navbar-brand><img alt=Logo src=../assets/img/about.png style=width:50px;height:50px;margin-right:30px> <span class=navbar-caption-wrap><a class="text-white display-5 navbar-caption"href=https://www.youtube.com/@fransxeagle>FransXeagle</a></span></div><button aria-controls=navbarNavAltMarkup aria-expanded=false aria-label="Toggle navigation"class=navbar-toggler data-target=#navbarSupportedContent data-toggle=collapse type=button><div class=hamburger><span></span> <span></span> <span></span> <span></span></div></button><div class="collapse navbar-collapse"id=navbarSupportedContent><ul class="nav-dropdown navbar-nav"data-app-modern-menu=true><li class=nav-item><a class="display-4 link nav-link text-white"href=https://fransxeagle.com/ >Home</a><li class=nav-item><a class="display-4 link nav-link text-white"href=about>About</a><li class=nav-item><a class="display-4 link nav-link text-white"href=apk>Link Apk</a><li class=nav-item><a class="display-4 link nav-link text-white"href=feature>Features</a><li class=nav-item><a class="display-4 link nav-link text-white"href=https://wa.me/+6282110005254>Pricing</a><li class=nav-item><a class="display-4 link nav-link text-white"href=contacts>Contacts</a><li class=nav-item><span class="display-4 link nav-link text-white">Visitors: <strong><?php echo $total_visitors; ?></strong></span></ul><div class="mbr-section-btn navbar-buttons"><a class="display-4 btn btn-sm btn-primary-outline"href=""><span></span>GET STARTED</a></div></div></div></nav></section><section class="cid-s1YNmF9EpW header3 mbr-parallax-background"id=header3-0><div class=mbr-overlay style=opacity:.9;background-color:#000></div><div class="container align-center"><div class="justify-content-center row"><div class="mbr-white col-lg-10 col-md-12"><h1 class="mbr-fonts-style mbr-white pb-3 mbr-section-title display-1"><strong>FRANSXEAGLE YOUTUBE</strong><strong><br></strong></h1><p class="mbr-fonts-style mbr-white mbr-text display-5 mbr-regular pb-4">Free Informative Tutorial Such As Canva Premium | Github Student | Canva Education | VCC | Virtual Number | Account Premium 💯<br><div class=mbr-section-btn><a class="display-4 btn btn-sm btn-primary"href=https://www.youtube.com/@fransxeagle>SUBSCRIBE</a></div><p class="mbr-fonts-style mbr-white mbr-text display-5 mbr-regular pb-4"><br><p class="mbr-fonts-style mbr-white mbr-text display-5 mbr-regular pb-4">Scroll Down<br></div></div></div></section><section class="cid-s1YQ6E1SFC content2"id=content2-e><div class=container><div class="justify-content-center row"><div class="col-lg-6 col-md-12 md-pb"><img alt=Mobirise src=../assets/img/aboutus.jpeg></div><div class="col-lg-6 col-md-12 md-pb"><div class="align-left title-wrapper"><div class=line></div><h3 class="mbr-fonts-style mbr-white pb-3 mbr-section-title display-2 mbr-semibold">About Us</h3><p class="mbr-fonts-style mbr-white mbr-text display-7 mbr-light pb-3">Pemuda Berumur 20 Tahun<br></div></div><div class="music-control text-center"onclick=toggleMusic()><i class="fas fa-play-circle"id=music-icon></i> Music</div><audio id=background-music type=audio/mpeg></audio><progress id=music-progress max=100 style=width:100% value=0></progress><div class=music-time><span id=current-time>0:00</span> <span id=duration>0:00</span></div><div class=volume-control><i class="fas fa-volume-down"></i> <input id=volume-control max=1 min=0 step=0.1 type=range value=0.5> <i class="fas fa-volume-up"></i></div></div></div></section><section class="cid-s1YPqSpOCZ footer1"id=footer1-7 once=footers><div class=container><div class="mbr-white justify-content-center row"><div class="col-lg-6 col-12 col-md-6"><p class="mbr-fonts-style align-left align-left display-7 mbr-text1">Happy Ending</div><div class="col-lg-6 col-12 col-md-6"><p class="mbr-fonts-style align-left display-7 align-right mbr-text2">© 2024 FransXeagle by <a class=text-secondary href=#>Kiko</a></div></div></div></section>

    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    
        <script src="assets/web/assets/jquery/jquery.min.js"></script>
        <script src="assets/popper/popper.min.js"></script>
        <script src="assets/tether/tether.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/smoothscroll/smooth-scroll.js"></script>
        <script src="assets/dropdown/js/nav-dropdown.js"></script>
        <script src="assets/dropdown/js/navbar-dropdown.js"></script>
        <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
        <script src="assets/parallax/jarallax.min.js"></script>
        <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
        <script src="assets/playervimeo/vimeo_player.js"></script>
        <script src="assets/formstyler/jquery.formstyler.js"></script>
        <script src="assets/formstyler/jquery.formstyler.min.js"></script>
        <script src="assets/datepicker/jquery.datetimepicker.full.js"></script>
        <script src="assets/theme/js/script.js"></script>
        <script src="assets/formoid/formoid.min.js"></script>

    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->
    <!-- MADE BY GABRIELA (MY GF) -->

        <script>
const playlist=["../assets/music/1.mp3","../assets/music/2.mp3","../assets/music/3.mp3","../assets/music/4.mp3","../assets/music/5.mp3","../assets/music/6.mp3"],backgroundMusic=document.getElementById("background-music"),musicIcon=document.getElementById("music-icon"),musicProgress=document.getElementById("music-progress"),currentTimeDisplay=document.getElementById("current-time"),durationDisplay=document.getElementById("duration"),volumeControl=document.getElementById("volume-control");let currentSongIndex=Math.floor(Math.random()*playlist.length);function loadSong(e){backgroundMusic.src=playlist[e],backgroundMusic.load(),backgroundMusic.play().catch((e=>{console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.")})),updateIcon()}function toggleMusic(){backgroundMusic.paused?backgroundMusic.play():backgroundMusic.pause(),updateIcon()}function updateIcon(){backgroundMusic.paused?musicIcon.classList.replace("fa-pause-circle","fa-play-circle"):musicIcon.classList.replace("fa-play-circle","fa-pause-circle")}function formatTime(e){return`${Math.floor(e/60)}:${Math.floor(e%60).toString().padStart(2,"0")}`}backgroundMusic.volume=.5,backgroundMusic.onloadedmetadata=()=>{durationDisplay.textContent=formatTime(backgroundMusic.duration)},backgroundMusic.ontimeupdate=()=>{const e=backgroundMusic.currentTime/backgroundMusic.duration*100;musicProgress.value=e,currentTimeDisplay.textContent=formatTime(backgroundMusic.currentTime)},backgroundMusic.onended=()=>{currentSongIndex=(currentSongIndex+1)%playlist.length,loadSong(currentSongIndex)},volumeControl.addEventListener("input",(()=>{backgroundMusic.volume=volumeControl.value})),loadSong(currentSongIndex),window.onload=function(){backgroundMusic.play().catch((e=>{console.log("Auto-play diblokir oleh browser. User perlu mengaktifkannya secara manual.")}))},console.log=function(){},setInterval((function(){if(window.console&&(console.__proto__.dir||console.__proto__.log)){const e=new Date;new Date-e>100&&alert("Developer Tools terdeteksi! Anda tidak diizinkan mengakses kode sumber ini.")}}),1e3),document.addEventListener("keydown",(function(e){!e.ctrlKey||"u"!==e.key&&"U"!==e.key||e.preventDefault(),(e.ctrlKey&&e.shiftKey&&("i"===e.key||"I"===e.key)||123===e.keyCode)&&e.preventDefault()})),document.addEventListener("keydown",(function(e){e.ctrlKey&&e.preventDefault(),123==e.keyCode&&e.preventDefault()})),document.addEventListener("contextmenu",(e=>e.preventDefault())),document.addEventListener("mousemove",createSnowflake);let snowflakeCount=0;const maxSnowflakes=20;function createSnowflake(){if(snowflakeCount>=maxSnowflakes)return;const e=document.createElement("div");e.classList.add("snowflake"),e.innerHTML="❄️",e.style.left=Math.random()*window.innerWidth+"px",e.style.fontSize=10*Math.random()+10+"px",e.style.animationDuration=5*Math.random()+5+"s",e.style.animationDelay=3*Math.random()+"s",document.body.appendChild(e),snowflakeCount++,e.addEventListener("animationend",(()=>{e.remove(),snowflakeCount--}))}setInterval(createSnowflake,1e3),document.addEventListener("DOMContentLoaded",(()=>{const e=document.body;let n=0,t=0,o=0,a=!1;document.addEventListener("mousemove",(s=>{a||(n=s.clientX,t=s.clientY,Math.random()<.15&&function(n,t){const a=Date.now();if(a-o<100)return;o=a;const s=document.createElement("div");s.className="mouse-snowflake";const c=3*Math.random()+1;s.style.width=c+"px",s.style.height=c+"px";const u=30*(Math.random()-.5),r=10*(Math.random()-.5);s.style.left=n+u+"px",s.style.top=t+r+"px";const i=2*Math.random()+1;s.style.animation=`mouseFall ${i}s linear forwards`,e.appendChild(s),setTimeout((()=>{s.remove()}),1e3*i)}(n,t),a=!0,setTimeout((()=>{a=!1}),50))}))}));
        </script>

        </body>

</html>