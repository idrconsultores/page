<?php
header('Content-Type: application/json');

// Obtiene los datos JSON enviados desde el formulario
$data = json_decode(file_get_contents('php://input'), true);

// Cargar el archivo de encuestas existente
$filename = 'datos.json';
if (file_exists($filename)) {
    $surveys = json_decode(file_get_contents($filename), true);
} else {
    $surveys = [];
}

// Agregar la nueva encuesta al arreglo
$surveys[] = $data;

// Guardar los datos en el archivo JSON
file_put_contents($filename, json_encode($surveys, JSON_PRETTY_PRINT));

// Responder con un mensaje de éxito
echo json_encode(['status' => 'success']);
?>
