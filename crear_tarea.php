<?php

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_limite = $_POST['fecha_limite'];

    $stmt = $pdo->prepare("INSERT INTO tareas (titulo, descripcion, fecha_limite) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$titulo, $descripcion, $fecha_limite])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}