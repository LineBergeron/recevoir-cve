<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Lire les données JSON
$donnees = json_decode(file_get_contents("php://input"), true);

if (!isset($donnees["lignes"])) {
    http_response_code(400);
    echo json_encode(["status" => "Erreur", "message" => "Aucune donnée reçue."]);
    exit;
}

// 🔐 Connexion à votre base
$host = "sql308.infinityfree.com";
$user = "if0_38948695";
$password = "INmelimelo422";
$dbname = "if0_38948695_gestionmembres";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "Erreur", "message" => "Connexion MySQL échouée."]);
    exit;
}

// Préparer l'insertion (21 colonnes)
$stmt = $conn->prepare("
    INSERT INTO Response (
        No, Date, LastName, FirstName, Gender, Language, CveAdress, Tel1, Tel2, EmailAdress,
        ResidenceStatus, CvePlay, CveSeason, AveragePlayMonth, AveragePlayDay, DateOther,
        Agree, Initials, TeamBefore, TeamName, Level
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )
");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["status" => "Erreur", "message" => "Erreur lors de la préparation SQL."]);
    exit;
}

// Insérer chaque ligne
foreach ($donnees["lignes"] as $ligne) {
    $params = array_pad($ligne, 21, null);
    $stmt->bind_param(str_repeat("s", 21), ...$params);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo json_encode(["status" => "Succès", "message" => "Données insérées avec succès."]);
?>
