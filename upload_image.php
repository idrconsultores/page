<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadsDir = 'uploads/';
    if (!file_exists($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $targetFilePath = $uploadsDir . $fileName;

    // Verifica el tipo de archivo para permitir solo imágenes
    $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            echo json_encode(['status' => 'success', 'filePath' => $targetFilePath]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al mover el archivo']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tipo de archivo no permitido']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió la imagen']);
}
?>
