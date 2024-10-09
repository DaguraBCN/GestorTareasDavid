<?php

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    $stmt = $pdo->prepare("UPDATE tareas SET estado = ? WHERE id = ?");
    
    if ($stmt->execute([$estado, $id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}