<?php
$servername = "sql308.infinityfree.com";
$username = "if0_38948695";
$password = "IMnelimelo422";
$dbname = "if0_38948695_gestionmembres";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

echo "Connexion réussie";
?>
