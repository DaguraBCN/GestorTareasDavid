// script.js
document.addEventListener('DOMContentLoaded', () => {
    const modalNuevaTarea = new bootstrap.Modal(document.getElementById('modalNuevaTarea'));
    const modalEditarTarea = new bootstrap.Modal(document.getElementById('modal-editar'));

    document.getElementById('nuevaTareaLink').addEventListener('click', (event) => {
        event.preventDefault();
        modalNuevaTarea.show();
    });

    document.getElementById('form-nueva-tarea').addEventListener('submit', (event) => {
        event.preventDefault();
        crearTarea(event.target);
    });

    document.getElementById('form-editar-tarea').addEventListener('submit', (event) => {
        event.preventDefault();
        guardarEdicionTarea(event.target);
    });

    document.getElementById('eliminar-tarea-modal').addEventListener('click', eliminarTareaModal);

    // Agregar event listeners para los enlaces del navbar
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.id !== 'nuevaTareaLink') {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                mostrarTareas(event.target.getAttribute('data-tipo'));
            });
        }
    });

    // Mostrar las tareas pendientes por defecto
    mostrarTareas('Pendiente');
});

function mostrarTareas(tipo) {
    const contenedores = document.querySelectorAll('.columna-tareas');
    const links = document.querySelectorAll('.nav-link');
    
    contenedores.forEach(contenedor => {
        if (contenedor.id === `columna-${tipo.toLowerCase()}`) {
            contenedor.classList.remove('d-none');
        } else {
            contenedor.classList.add('d-none');
        }
    });

    links.forEach(link => {
        if (link.getAttribute('data-tipo') === tipo) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });

    cargarTareas(tipo);
}

function cargarTareas(tipo) {
    fetch('obtener_tareas.php')
        .then(response => response.json())
        .then(tareas => {
            const contenedor = document.querySelector(`#columna-${tipo.toLowerCase()} .tareas-container`);
            contenedor.innerHTML = '';

            const tareasFiltradasPorTipo = tareas.filter(tarea => tarea.estado === tipo);

            if (tareasFiltradasPorTipo.length === 0) {
                contenedor.innerHTML = '<p class="text-center">No hay tareas en esta categoría.</p>';
            } else {
                tareasFiltradasPorTipo.forEach(tarea => {
                    const tareaElement = crearElementoTarea(tarea);
                    contenedor.appendChild(tareaElement);
                });
            }
        })
        .catch(error => {
            console.error('Error al cargar las tareas:', error);
            alert('Error al cargar las tareas. Por favor, intente de nuevo.');
        });
}

function crearElementoTarea(tarea) {
    const tareaElement = document.createElement('div');
    tareaElement.className = 'card mb-3';
    tareaElement.innerHTML = `
        <div class="card-body">
            <h5 class="card-title">${tarea.titulo}</h5>
            <p class="card-text">${tarea.descripcion}</p>
            <p class="card-text"><small class="text-muted">Fecha límite: ${tarea.fecha_limite}</small></p>
            <select class="form-select estado-tarea mb-2" data-id="${tarea.id}">
                <option value="Pendiente" ${tarea.estado === 'Pendiente' ? 'selected' : ''}>Pendiente</option>
                <option value="Ejecución" ${tarea.estado === 'Ejecución' ? 'selected' : ''}>En Ejecución</option>
                <option value="Finalizada" ${tarea.estado === 'Finalizada' ? 'selected' : ''}>Finalizada</option>
            </select>
            <button class="btn btn-primary btn-sm editar-tarea me-2" data-id="${tarea.id}">Editar</button>
            <button class="btn btn-danger btn-sm eliminar-tarea" data-id="${tarea.id}">Eliminar</button>
        </div>
    `;

    tareaElement.querySelector('.estado-tarea').addEventListener('change', actualizarEstadoTarea);
    tareaElement.querySelector('.editar-tarea').addEventListener('click', abrirModalEdicion);
    tareaElement.querySelector('.eliminar-tarea').addEventListener('click', eliminarTarea);

    return tareaElement;
}

function crearTarea(form) {
    const formData = new FormData(form);

    fetch('crear_tarea.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            mostrarTareas('Pendiente');
            form.reset();
            bootstrap.Modal.getInstance(document.getElementById('modalNuevaTarea')).hide();
        } else {
            alert('Error al crear la tarea');
        }
    })
    .catch(error => {
        console.error('Error al crear la tarea:', error);
        alert('Error al crear la tarea. Por favor, intente de nuevo.');
    });
}

function actualizarEstadoTarea(event) {
    const id = event.target.dataset.id;
    const nuevoEstado = event.target.value;

    fetch('actualizar_tarea.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&estado=${nuevoEstado}`
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            mostrarTareas(nuevoEstado);
        } else {
            alert('Error al actualizar el estado de la tarea');
        }
    })
    .catch(error => {
        console.error('Error al actualizar el estado de la tarea:', error);
        alert('Error al actualizar el estado de la tarea. Por favor, intente de nuevo.');
    });
}

function abrirModalEdicion(event) {
    const id = event.target.dataset.id;
    fetch(`obtener_tarea.php?id=${id}`)
        .then(response => response.json())
        .then(tarea => {
            document.getElementById('editar-id').value = tarea.id;
            document.getElementById('editar-titulo').value = tarea.titulo;
            document.getElementById('editar-descripcion').value = tarea.descripcion;
            document.getElementById('editar-fecha_limite').value = tarea.fecha_limite;
            document.getElementById('editar-estado').value = tarea.estado;
            bootstrap.Modal.getInstance(document.getElementById('modal-editar')).show();
        })
        .catch(error => {
            console.error('Error al abrir el modal de edición:', error);
            alert('Error al cargar los datos de la tarea. Por favor, intente de nuevo.');
        });
}

function guardarEdicionTarea(form) {
    const formData = new FormData(form);

    fetch('editar_tarea.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            bootstrap.Modal.getInstance(document.getElementById('modal-editar')).hide();
            mostrarTareas(formData.get('estado'));
        } else {
            alert('Error al editar la tarea');
        }
    })
    .catch(error => {
        console.error('Error al editar la tarea:', error);
        alert('Error al editar la tarea. Por favor, intente de nuevo.');
    });
}

function eliminarTarea(event) {
    const id = event.target.dataset.id;
    if (confirm('¿Estás seguro de que quieres eliminar esta tarea?')) {
        fetch('eliminar_tarea.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}`
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                mostrarTareas(document.querySelector('.nav-link.active').getAttribute('data-tipo'));
            } else {
                alert('Error al eliminar la tarea');
            }
        })
        .catch(error => {
            console.error('Error al eliminar la tarea:', error);
            alert('Error al eliminar la tarea. Por favor, intente de nuevo.');
        });
    }
}

function eliminarTareaModal() {
    const id = document.getElementById('editar-id').value;
    if (confirm('¿Estás seguro de que quieres eliminar esta tarea?')) {
        fetch('eliminar_tarea.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}`
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                bootstrap.Modal.getInstance(document.getElementById('modal-editar')).hide();
                mostrarTareas(document.querySelector('.nav-link.active').getAttribute('data-tipo'));
            } else {
                alert('Error al eliminar la tarea');
            }
        })
        .catch(error => {
            console.error('Error al eliminar la tarea:', error);
            alert('Error al eliminar la tarea. Por favor, intente de nuevo.');
        });
    }
}