<?php
$tokenAttendu = "monsecret123";
if (!isset($_GET["token"]) || $_GET["token"] !== $tokenAttendu) {
    http_response_code(403);
    echo "Accès refusé.";
    exit;
}

$contenu = file_get_contents("php://input");
file_put_contents(__DIR__ . "/public/membres_web.html", $contenu);

echo json_encode(["status" => "OK", "message" => "Fichier HTML reçu."]);
?>
