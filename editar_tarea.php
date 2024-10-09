<?php
// editar_tarea.php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_limite = $_POST['fecha_limite'];
    $estado = $_POST['estado'];

    $stmt = $pdo->prepare("UPDATE tareas SET titulo = ?, descripcion = ?, fecha_limite = ?, estado = ? WHERE id = ?");
    
    if ($stmt->execute([$titulo, $descripcion, $fecha_limite, $estado, $id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}