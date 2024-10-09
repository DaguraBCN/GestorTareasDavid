<?php
require_once 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="David Gutierrez">
    <title>Gestor de Tareas</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header>
        <h1>Gestor de Tareas</h1>
    </header>
    <main>
        <section id="nueva-tarea">
            <h2>Nueva Tarea</h2>
            <form id="form-nueva-tarea">
                <input type="text" id="titulo" name="titulo" placeholder="Título" required>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                <input type="date" id="fecha_limite" name="fecha_limite" required>
                <button type="submit">Crear Tarea</button>
            </form>
        </section>
        <section id="tareas">
            <div class="columna" id="pendientes">
                <h2>Pendientes</h2>
            </div>
            <div class="columna" id="ejecucion">
                <h2>En Ejecución</h2>
            </div>
            <div class="columna" id="finalizadas">
                <h2>Finalizadas</h2>
            </div>
        </section>
    </main>

    <!-- Modal de edición -->
    <div id="modal-editar" class="modal">
        <div class="modal-contenido">
            <span class="cerrar">&times;</span>
            <h2>Editar Tarea</h2>
            <form id="form-editar-tarea">
                <input type="hidden" id="editar-id" name="id">
                <input type="text" id="editar-titulo" name="titulo" placeholder="Título" required>
                <textarea id="editar-descripcion" name="descripcion" placeholder="Descripción"></textarea>
                <input type="date" id="editar-fecha_limite" name="fecha_limite" required>
                <select id="editar-estado" name="estado">
                    <option value="Pendiente">Pendiente</option>
                    <option value="Ejecución">En Ejecución</option>
                    <option value="Finalizada">Finalizada</option>
                </select>
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>
    <script src="JS/script.js"></script>
</body>
</html>