<?php

require_once 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = ?");
    $stmt->execute([$id]);
    $tarea = $stmt->fetch();

    if ($tarea) {
        echo json_encode($tarea);
    } else {
        echo json_encode(['error' => 'Tarea no encontrada']);
    }
} else {
    echo json_encode(['error' => 'ID de tarea no proporcionado']);
}