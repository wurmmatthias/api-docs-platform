<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['url'])) {

        $url = filter_var($data['url'], FILTER_VALIDATE_URL);
        if ($url) {
            echo json_encode([
                'success' => 1,
                'file' => [
                    'url' => $url
                ]
            ]);
        } else {
            echo json_encode(['success' => 0, 'message' => 'Ungültige URL.']);
        }
    } else {
        echo json_encode(['success' => 0, 'message' => 'Keine URL angegeben.']);
    }
} else {
    echo json_encode(['success' => 0, 'message' => 'Ungültige Anfrage.']);
}
?>
