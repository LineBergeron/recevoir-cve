<?php
// recevoir_html.php
$token = $_GET['token'] ?? '';
if ($token !== 'monsecret123') {
    http_response_code(403);
    echo json_encode(['status' => 'Erreur', 'message' => 'Token invalide']);
    exit;
}

$contenu = file_get_contents("php://input");
if (!$contenu) {
    http_response_code(400);
    echo json_encode(['status' => 'Erreur', 'message' => 'Aucun contenu reçu']);
    exit;
}

// 🔥 Chemin de destination dans Render (dans le dossier public)
$fichier = __DIR__ . '/public/membres_web.html';

if (file_put_contents($fichier, $contenu) !== false) {
    echo json_encode(['status' => 'OK', 'message' => 'Fichier HTML reçu']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'Erreur', 'message' => 'Erreur lors de l\'écriture']);
}
?>
