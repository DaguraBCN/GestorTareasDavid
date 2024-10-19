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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header class="bg-primary text-white py-3">
        <h1 class="text-center">Gestor de Tareas</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" role="navigation">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 justify-content-between">
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link active" href="#" data-tipo="Pendiente">Pendientes</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link" href="#" data-tipo="Ejecucion">En Ejecución</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link" href="#" data-tipo="Finalizada">Finalizadas</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link" href="#" id="nuevaTareaLink">Nueva Tarea</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container mt-4">
        <section id="tareas" class="row">
            <!-- Tareas Pendientes -->
            <div id="columna-pendiente" class="col-12 mb-4 columna-tareas">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Tareas Pendientes</h2>
                        <div class="position-relative w-50">
                            <img src="icons/buscar.png" class="icono-busqueda" alt="Icono de búsqueda">
                            <input type="text" class="form-control ps-5" id="busqueda-pendiente" placeholder="Buscar tareas...">
                        </div>
                    </div>
                    <div class="card-body tareas-container row"></div>
                </div>
            </div>
            
            <!-- Tareas en Ejecución -->
            <div id="columna-ejecucion" class="col-12 mb-4 columna-tareas d-none">
                <div class="card">
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Tareas en Ejecución</h2>
                        <div class="position-relative w-50">
                            <img src="icons/buscar.png" class="icono-busqueda" alt="Icono de búsqueda">
                            <input type="text" class="form-control ps-5" id="busqueda-ejecucion" placeholder="Buscar tareas...">
                        </div>
                    </div>
                    <div class="card-body tareas-container row"></div>
                </div>
            </div>

            <!-- Tareas Finalizadas -->
            <div id="columna-finalizada" class="col-12 mb-4 columna-tareas d-none">
                <div class="card">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Tareas Finalizadas</h2>
                        <div class="position-relative w-50">
                            <img src="icons/buscar.png" class="icono-busqueda" alt="Icono de búsqueda">
                            <input type="text" class="form-control ps-5" id="busqueda-finalizada" placeholder="Buscar tareas...">
                        </div>
                    </div>
                    <div class="card-body tareas-container row"></div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal Nueva Tarea -->
    <div class="modal fade" id="modalNuevaTarea" tabindex="-1" aria-labelledby="modalNuevaTareaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNuevaTareaLabel">Nueva Tarea</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-nueva-tarea">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select class="form-select" id="prioridad" name="prioridad">
                                <option value="Urgente">Urgente</option>
                                <option value="Alta">Alta</option>
                                <option value="Media" selected>Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_limite" class="form-label">Fecha límite</label>
                            <input type="date" class="form-control" id="fecha_limite"   name="fecha_limite" min="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-journal-plus"></i> Crear Tarea</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Tarea -->
    <div class="modal fade" id="modal-editar" tabindex="-1" aria-labelledby="modalEditarTareaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarTareaLabel">Editar Tarea</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-editar-tarea">
                        <input type="hidden" id="editar-id" name="id">
                        <div class="mb-3">
                            <label for="editar-titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="editar-titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="editar-descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editar-descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editar-fecha_limite" class="form-label">Fecha límite</label>
                            <input type="date" class="form-control" id="editar-fecha_limite" name="fecha_limite" min="<?php echo date('Y-m-d'); ?>"required>
                        </div>
                        <div class="mb-3">
                            <label for="editar-prioridad" class="form-label">Prioridad</label>
                            <select class="form-select" id="editar-prioridad" name="prioridad">
                                <option value="Urgente">Urgente</option>
                                <option value="Alta">Alta</option>
                                <option value="Media" selected>Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editar-estado" class="form-label">Estado</label>
                            <select class="form-select" id="editar-estado" name="estado">
                                <option value="Pendiente">Pendiente</option>
                                <option value="Ejecucion">En Ejecución</option>
                                <option value="Finalizada">Finalizada</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary me-2"><i class="bi bi-journal-check"></i> Guardar Cambios</button>
                            <button type="button" id="eliminar-tarea-modal" class="btn btn-danger"><i class="bi bi-journal-x"></i> Eliminar Tarea</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="JS/script.js"></script>
</body>
</html>