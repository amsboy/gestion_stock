<?php
$host = "sql.freesqldatabase.com";
$user = "sql5812991";   // ton identifiant
$pass = "l1KAg2Wplt"; 
$db   = "sql5812991";   // nom de ta base

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}
?>