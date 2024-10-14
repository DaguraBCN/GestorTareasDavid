<?php

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $prioridad = $_POST['prioridad'];
    $fecha_limite = $_POST['fecha_limite'];

    $stmt = $pdo->prepare("INSERT INTO tareas (titulo, descripcion, prioridad, fecha_limite) VALUES (?, ?, ?, ?)");
    
    if ($stmt->execute([$titulo, $descripcion, $prioridad, $fecha_limite])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}