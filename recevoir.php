<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input["lignes"])) {
    echo json_encode(["status" => "Erreur", "message" => "Aucune donnée reçue."]);
    exit;
}

echo json_encode(["status" => "Succès", "reçu" => count($input["lignes"])]);
?>
