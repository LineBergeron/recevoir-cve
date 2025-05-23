<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Lire les données JSON
$donnees = json_decode(file_get_contents("php://input"), true);

if (!isset($donnees["lignes"]) || !is_array($donnees["lignes"])) {
    http_response_code(400);
    echo json_encode(["status" => "Erreur", "message" => "Aucune donnée reçue."]);
    exit;
}

// Connexion à la base MySQL avec PDO
$host = "sql308.infinityfree.com";
$dbname = "if0_38948695_gestionmembres";
$username = "if0_38948695";
$password = "INmelimelo422";
$charset = "utf8mb4";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "Erreur", "message" => "Connexion échouée : " . $e->getMessage()]);
    exit;
}

// Préparer la requête d’insertion
$sql = "
    INSERT INTO Response (
        No, Date, LastName, FirstName, Gender, Language, CveAdress, Tel1, Tel2, EmailAdress,
        ResidenceStatus, CvePlay, CveSeason, AveragePlayMonth, AveragePlayDay, DateOther,
        Agree, Initials, TeamBefore, TeamName, TeamPref, Level
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )
";

$stmt = $pdo->prepare($sql);

// Exécuter les insertions
$reçues = 0;
foreach ($donnees["lignes"] as $ligne) {
    $params = array_pad($ligne, 22, null); // S'assurer d'avoir 22 colonnes
    $stmt->execute($params);
    $reçues++;
}

// Réponse
echo json_encode(["status" => "Succès", "reçues" => $reçues]);
