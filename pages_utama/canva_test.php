<?php
// Konfigurasi keamanan dasar
ini_set('display_errors', 0);
error_reporting(0);

// Header keamanan
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Content-Security-Policy: default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval'");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");

// Fungsi enkripsi custom dengan multiple layers
function customEncrypt($data, $key) {
    $method = "AES-256-CBC";
    $key = hash('sha256', $key, true);
    $iv = openssl_random_pseudo_bytes(16);
    
    // Layer 1: AES Encryption
    $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
    
    // Layer 2: Base64 encoding
    $encoded = base64_encode($encrypted);
    
    // Layer 3: Custom XOR encryption
    $xorKey = generateXORKey();
    $xored = xorEncrypt($encoded, $xorKey);
    
    // Layer 4: Additional scrambling
    $scrambled = scrambleData($xored);
    
    return base64_encode($iv . $scrambled);
}

function customDecrypt($encryptedData, $key) {
    $method = "AES-256-CBC";
    $key = hash('sha256', $key, true);
    
    // Decode base64
    $data = base64_decode($encryptedData);
    
    // Extract IV
    $iv = substr($data, 0, 16);
    $encrypted = substr($data, 16);
    
    // Reverse Layer 4: Unscramble
    $unscrambled = unscrambleData($encrypted);
    
    // Reverse Layer 3: XOR decrypt
    $xorKey = generateXORKey();
    $unxored = xorEncrypt($unscrambled, $xorKey);
    
    // Reverse Layer 2: Base64 decode
    $decoded = base64_decode($unxored);
    
    // Reverse Layer 1: AES Decrypt
    return openssl_decrypt($decoded, $method, $key, OPENSSL_RAW_DATA, $iv);
}

function generateXORKey() {
    return hash('sha512', uniqid(mt_rand(), true));
}

function xorEncrypt($data, $key) {
    $dataLen = strlen($data);
    $keyLen = strlen($key);
    $output = '';
    
    for($i = 0; $i < $dataLen; $i++) {
        $output .= $data[$i] ^ $key[$i % $keyLen];
    }
    
    return $output;
}

function scrambleData($data) {
    $length = strlen($data);
    $output = '';
    for($i = 0; $i < $length; $i++) {
        $output .= chr(ord($data[$i]) + ($i % 4));
    }
    return $output;
}

function unscrambleData($data) {
    $length = strlen($data);
    $output = '';
    for($i = 0; $i < $length; $i++) {
        $output .= chr(ord($data[$i]) - ($i % 4));
    }
    return $output;
}

// Anti-tampering check
function verifyIntegrity() {
    $expectedHash = ''; // Store hash of original file
    $currentHash = hash_file('sha256', __FILE__);
    if($expectedHash !== '' && $expectedHash !== $currentHash) {
        die('Security violation detected');
    }
}

// Anti-debugging measures
function preventDebugging() {
    if(function_exists('debug_backtrace')) {
        $trace = debug_backtrace();
        if(count($trace) > 2) {
            die('Debugging attempt detected');
        }
    }
}

// Session security
session_start();
session_regenerate_id(true);
$_SESSION['last_activity'] = time();
$_SESSION['created'] = time();

// CSRF Protection
if(empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF token validation failed');
    }
}

$csrfToken = $_SESSION['csrf_token'];

// Enkripsi variabel sensitif
$encryptionKey = getenv('ENCRYPTION_KEY') ?: 'YourSecureEncryptionKey123!@#';
$title = customEncrypt("FransXeagle YouTube", $encryptionKey);

// Verifikasi integritas dan cek debugging
verifyIntegrity();
preventDebugging();

require '../services/config.php';
require 'visitors.php';

// Output buffering untuk mencegah data leakage
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Sisanya dari kode head Anda tetap sama -->
    <!-- Tambahkan CSP meta tag -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval'">
    
    <!-- Tambahkan script anti-devtools -->
    <script>
    (function() {
        function detectDevTools(allow) {
            if(isNaN(+allow)) allow = 100;
            var start = +new Date();
            debugger;
            var end = +new Date();
            if(isNaN(start) || isNaN(end) || end - start > allow) {
                document.write('Developer tools detected. Access denied.');
                window.location.href = "about:blank";
            }
        }
        
        if(window.attachEvent) {
            if(document.readyState === "complete" || document.readyState === "interactive") {
                detectDevTools();
                window.attachEvent('onresize', detectDevTools);
                window.attachEvent('onmousemove', detectDevTools);
                window.attachEvent('onfocus', detectDevTools);
                window.attachEvent('onblur', detectDevTools);
            } else {
                setTimeout(argument.callee, 0);
            }
        } else {
            window.addEventListener('load', detectDevTools);
            window.addEventListener('resize', detectDevTools);
            window.addEventListener('mousemove', detectDevTools);
            window.addEventListener('focus', detectDevTools);
            window.addEventListener('blur', detectDevTools);
        }
    })();
    </script>

    <!-- Sisanya dari kode Anda tetap sama -->
</head>
<body>
    <!-- Tambahkan token CSRF ke semua form -->
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
    
    <!-- Sisanya dari kode body Anda tetap sama -->
</body>
</html>

<?php
// Flush output buffer
ob_end_flush();
?>