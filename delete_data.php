<?php
header('Content-Type: application/json');

// Obtener los datos JSON enviados para eliminar una encuesta
$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'];

// Cargar el archivo de encuestas
$filename = 'datos.json';
$surveys = json_decode(file_get_contents($filename), true);

// Eliminar la encuesta en el índice especificado
unset($surveys[$index]);

// Reindexar el array (para que no haya huecos)
$surveys = array_values($surveys);

// Guardar los cambios en el archivo JSON
file_put_contents($filename, json_encode($surveys, JSON_PRETTY_PRINT));

// Responder con un mensaje de éxito
echo json_encode(['status' => 'success']);
?>
