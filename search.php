<?php
// Tangkap kata kunci dari input pencarian
if (isset($_GET['search'])) {
    $searchQuery = htmlspecialchars($_GET['search']);
    echo "Hasil pencarian untuk: " . $searchQuery;
}
