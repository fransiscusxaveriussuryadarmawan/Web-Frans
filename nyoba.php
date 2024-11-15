<!DOCTYPE html>
<html>

<head>
    <title>Autofill and Auto-Submit Search</title>
    <script>
        // JavaScript untuk mengisi otomatis kolom pencarian dan submit form
        window.onload = function() {
            // Ambil elemen input pencarian dan form berdasarkan ID
            var searchInput = document.getElementById('searchInputId');
            var searchForm = document.getElementById('searchForm');

            // Periksa apakah elemen input dan form ditemukan
            if (searchInput && searchForm) {
                // Isi otomatis dengan kata kunci yang diinginkan
                searchInput.value = 'Kata kunci otomatis';

                // Tunggu sejenak lalu submit form secara otomatis
                setTimeout(function() {
                    searchForm.submit();
                }, 1); // Submit setelah 1 detik (1000 ms)
            }
        };
    </script>
</head>

<body>
    <h1>Halaman Pencarian</h1>
    <!-- Form dengan ID untuk pencarian -->
    <form id="searchForm" method="get" action="search.php">
        <!-- Kolom input pencarian -->
        <input type="text" id="searchInputId" name="search" placeholder="Cari sesuatu...">
    </form>
</body>

</html>