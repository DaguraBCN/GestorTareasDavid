<?php

$host = 'sql100.infinityfree.com';
$db   = 'if0_37524258_gestor_tareas';
$user = 'if0_37524258';
$pass = 'yHBTQaHGHQ';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}