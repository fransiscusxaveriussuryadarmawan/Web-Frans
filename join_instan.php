<?php
$title = "Join Instan Canva Pro";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Join Instan Canva Pro</h1>
        <p>Untuk mendapatkan akses instan ke Canva Pro, silakan ikuti langkah-langkah berikut:</p>
        <ol>
            <li>Scan gambar QRIS di bawah ini dan lakukan pembayaran sebesar Rp1.000.</li>
            <li>Setelah pembayaran, klik tombol di bawah untuk chat ke WhatsApp kami dan kirimkan bukti pembayaran.</li>
        </ol>
        <div class="text-center">
            <img src="img/qris.jpg" alt="QRIS Payment" style="width: 200px; height: auto;">
        </div>
        <div class="text-center mt-4">
            <a href="https://api.whatsapp.com/send/?phone=%2B6282138616235&text=Halo%2C+saya+ingin+join+instan+Canva+Pro+dan+sudah+membayar+Rp1000" class="btn btn-primary">Chat WhatsApp & Kirim Bukti Pembayaran</a>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>