<?php
include 'db.php';

define('GOOGLE_CLIENT_ID', $client_id);
define('GOOGLE_CLIENT_SECRET', $client_secret);
define('GOOGLE_REDIRECT_URL', 'http://localhost/MyCode/CRUD/home.php');



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
