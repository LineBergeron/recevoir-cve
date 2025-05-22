<?php
// Connexion à ta base MySQL
$host = 'localhost';
$dbname = 'nom_de_ta_base';
$username = 'ton_utilisateur';
$password = 'ton_mot_de_passe';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo json_encode(["status" => "Erreur", "message" => "Connexion échouée : " . $e->getMessage()]);
    exit;
}

// Récupérer les données JSON envoyées
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['lignes']) || !is_array($data['lignes'])) {
    echo json_encode(["status" => "Erreur", "message" => "Aucune donnée reçue."]);
    exit;
}

$reçues = 0;

foreach ($data['lignes'] as $ligne) {
    // Adapter selon ta table tmpNewMembers (21 ou 22 champs)
    $stmt = $pdo->prepare("INSERT INTO tmpNewMembers (
        col1, col2, col3, col4, col5, col6, col7, col8, col9, col10,
        col11, col12, col13, col14, col15, col16, col17, col18, col19, col20, col21, col22
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )");

    // $ligne doit contenir exactement 22 éléments (colonnes A à V)
    if (count($ligne) >= 22) {
        $stmt->execute(array_slice($ligne, 0, 22));
        $reçues++;
    }
}

echo json_encode(["status" => "Succès", "reçues" => $reçues]);
?>
