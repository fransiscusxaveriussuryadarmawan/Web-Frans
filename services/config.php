<?php
$servername = "localhost";
$username = "kisaraxa_admin_fransxeagle";
$password = "Kikosurya27*";
$dbname = "kisaraxa_fransxeagle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
