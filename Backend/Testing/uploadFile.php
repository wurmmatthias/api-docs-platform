<?php
header('Content-Type: application/json');


$uploadDir = 'uploads/';


if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);


        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            $newFileName = uniqid() . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                echo json_encode([
                    'success' => 1,
                    'file' => [
                        'url' => 'http://' . $_SERVER['HTTP_HOST'] . '/api-docs-platform/backend/testing/' . $destPath
                    ]
                ]);
            } else {
                echo json_encode(['success' => 0, 'message' => 'Datei konnte nicht gespeichert werden.']);
            }
        } else {
            echo json_encode(['success' => 0, 'message' => 'Ungültiges Dateiformat.']);
        }
    } else {
        echo json_encode(['success' => 0, 'message' => 'Kein Bild hochgeladen.']);
    }
} else {
    echo json_encode(['success' => 0, 'message' => 'Ungültige Anfrage.']);
}
?>
