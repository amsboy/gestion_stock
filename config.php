<?php
$host = getenv('DB_HOST');     // hôte de la base (ex: sql.freesqldatabase.com)
$user = getenv('DB_USER');     // identifiant MySQL
$pass = getenv('DB_PASS');     // mot de passe MySQL
$db   = getenv('DB_NAME');     // nom de la base

$conn = new mysqli($host, $user, $pass, $db);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base : " . $conn->connect_error);
}
?>