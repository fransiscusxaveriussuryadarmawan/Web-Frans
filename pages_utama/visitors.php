<?php

$result = $conn->query("SELECT COUNT(*) AS total_visitors FROM visitors");
$row = $result->fetch_assoc();
$total_visitors = $row['total_visitors'];
