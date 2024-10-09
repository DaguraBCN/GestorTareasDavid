<?php

require_once 'conexion.php';

$stmt = $pdo->query("SELECT * FROM tareas ORDER BY fecha_creacion DESC");
$tareas = $stmt->fetchAll();

echo json_encode($tareas);