<?php
header("Content-Type: application/json");
if (!isset($_GET['name'])|| !isset($_GET['digest'])) {
    http_response_code(404);
    echo json_encode(['error' => 'missing parameter']);
    exit();
}
$name = $_GET['name'];
$digest = $_GET['digest'];

if (file_exists('db.json')) {
    $raw_json = file_get_contents('db.json');
    $db = json_decode($raw_json, true);
} else
    $db = [];

function estrai_premio($premi) {
    $somma = 0;
    foreach ($premi as $p)
        $somma += $p['prob'];
    $estrazione = rand(1, $somma);
    $somma = 0;
    foreach ($premi as $p) {
        $somma += $p['prob'];
        if ($estrazione <= $somma) {
            return $p['desc'];
        }
    }
}

foreach ($db['punti'] as $punto)
    if ($punto['nome'] === $name) {
        $src = gmdate("Y-m-d_H-i") . '|' . $punto['password'];
        $ref_digest = hash('sha256', $src);
        if ($digest === $ref_digest) {
            http_response_code(200);
            $premio = estrai_premio($db['premi']);
            echo json_encode(['premio' => $premio]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'timer or location mismatch']);
        }
        exit();
    }

http_response_code(404);
echo json_encode(['error' => 'not found']);
exit();