<!doctypehtml><html lang=id><meta charset=UTF-8><meta content="width=device-width,initial-scale=1"name=viewport><title>Lihat Paste</title><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"rel=stylesheet><style>.snowflake{position:fixed;top:-10px;z-index:1000;color:#fff;font-size:1.2em;pointer-events:none;animation:fall linear infinite}@keyframes fall{0%{transform:translateY(0);opacity:1}100%{transform:translateY(100vh);opacity:0}}body,html{font-family:Poppins,sans-serif;background:linear-gradient(to right,#74ebd5,#acb6e5);margin:0;padding:0;height:100%}.container{background:#fff;padding:30px;border-radius:15px;box-shadow:0 10px 30px rgba(0,0,0,.1);max-width:1200px;width:100%;text-align:left;margin:20px auto;position:relative;animation:fadeIn 1s ease-in-out;height:auto}@keyframes fadeIn{from{opacity:0;transform:scale(.9)}to{opacity:1;transform:scale(1)}}h1{font-size:24px;margin-bottom:20px;color:#333;text-align:center}.content-title{font-size:20px;color:#333;margin-bottom:10px;text-align:center;font-weight:700}.content{font-size:18px;color:#555;white-space:pre-wrap;line-height:1.6;background:#f9f9f9;padding:20px;border-radius:10px;box-shadow:inset 0 1px 3px rgba(0,0,0,.1);max-height:600px;overflow-y:scroll}.footer{text-align:center;margin-top:30px;font-size:14px;color:#888}.button-container{display:flex;justify-content:center;margin-top:20px}.edit-button{padding:10px 20px;background-color:#ff6f61;border:none;color:#fff;font-size:16px;cursor:pointer;border-radius:8px;text-decoration:none;transition:background-color .3s,transform .3s}.edit-button:hover{background-color:#ff4a3c;transform:translateY(-3px)}.logo{width:100px;height:100px;background:url(logo.png) no-repeat center center;background-size:cover;border-radius:50%;margin:0 auto 20px auto;display:block}.navbar{background-color:#333;padding:10px 20px;color:#fff;text-align:center;font-family:Poppins,sans-serif}.navbar-container{display:flex;justify-content:center;align-items:center}.nav-link{color:#fff;text-decoration:none;font-weight:700;font-size:18px;transition:color .3s}.nav-link:hover{color:#ff6f61}</style><nav class=navbar><div class=navbar-container><a class=nav-link href=../index.php>Halaman Utama (KLIK INI)</a></div></nav>
    
    <div class="container">
        <img src="../assets/img/about.png" alt="Logo" class="logo">
        <h1>Konten FransXeagle</h1>

        <?php
        require_once '../services/config.php';
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
                    
                    // Menggunakan htmlspecialchars_decode untuk menampilkan tanda kutip ganda secara harfiah
                    $decodedContent = htmlspecialchars_decode($paste['content'], ENT_QUOTES);
                    echo '<div class="content">' . nl2br($decodedContent) . '</div>';
                
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
let snowflakeCount=0;const maxSnowflakes=20;function createSnowflake(){if(snowflakeCount>=20)return;const e=document.createElement("div");e.classList.add("snowflake"),e.innerHTML="❄️",e.style.left=Math.random()*window.innerWidth+"px",e.style.fontSize=10*Math.random()+10+"px",e.style.animationDuration=5*Math.random()+5+"s",e.style.animationDelay=3*Math.random()+"s",document.body.appendChild(e),snowflakeCount++,e.addEventListener("animationend",(()=>{e.remove(),snowflakeCount--}))}setInterval(createSnowflake,1e3),document.addEventListener("DOMContentLoaded",(()=>{const e=document.body;let t=0,n=0,o=0;document.addEventListener("mousemove",(a=>{isThrottled||(t=a.clientX,n=a.clientY,Math.random()<.15&&function(t,n){const a=Date.now();if(a-o<100)return;o=a;const s=document.createElement("div");s.className="mouse-snowflake";const d=3*Math.random()+1;s.style.width=d+"px",s.style.height=d+"px";const l=30*(Math.random()-.5),i=10*(Math.random()-.5);s.style.left=t+l+"px",s.style.top=n+i+"px";const r=2*Math.random()+1;s.style.animation=`mouseFall ${r}s linear forwards`,e.appendChild(s),setTimeout((()=>{s.remove()}),1e3*r)}(t,n),isThrottled=!0,setTimeout((()=>{isThrottled=!1}),50))}))}));
    </script>
</body>

</html>