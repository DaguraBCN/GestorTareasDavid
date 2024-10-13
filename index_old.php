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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
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
            <button id="eliminar-tarea-modal" class="boton-eliminar">Eliminar Tarea</button>
        </div>
    </div>
    
    <script src="JS/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>