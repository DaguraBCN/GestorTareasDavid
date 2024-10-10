
document.addEventListener('DOMContentLoaded', () => {
    cargarTareas();

    document.getElementById('form-nueva-tarea').addEventListener('submit', crearTarea);
    document.getElementById('form-editar-tarea').addEventListener('submit', guardarEdicionTarea);

    // Cerrar el modal
    document.querySelector('.cerrar').addEventListener('click', () => {
        document.getElementById('modal-editar').style.display = 'none';
    });

    // Cerrar el modal si se hace clic fuera de él
    window.addEventListener('click', (event) => {
        if (event.target == document.getElementById('modal-editar')) {
            document.getElementById('modal-editar').style.display = 'none';
        }
    });

    // Eliminar tarea desde el modal
    document.getElementById('eliminar-tarea-modal').addEventListener('click', eliminarTareaModal);
});

function cargarTareas() {
    fetch('obtener_tareas.php')
        .then(response => response.json())
        .then(tareas => {
            const columnas = {
                'Pendiente': document.getElementById('pendientes'),
                'Ejecución': document.getElementById('ejecucion'),
                'Finalizada': document.getElementById('finalizadas')
            };

            for (const estado in columnas) {
                columnas[estado].innerHTML = `<h2>${estado}</h2>`;
            }

            tareas.forEach(tarea => {
                const tareaElement = crearElementoTarea(tarea);
                columnas[tarea.estado].appendChild(tareaElement);
            });
        });
}

function crearElementoTarea(tarea) {
    const tareaElement = document.createElement('div');
    tareaElement.className = 'tarea';
    tareaElement.innerHTML = `
        <h3>${tarea.titulo}</h3>
        <p>${tarea.descripcion}</p>
        <p>Fecha límite: ${tarea.fecha_limite}</p>
        <select class="estado-tarea" data-id="${tarea.id}">
            <option value="Pendiente" ${tarea.estado === 'Pendiente' ? 'selected' : ''}>Pendiente</option>
            <option value="Ejecución" ${tarea.estado === 'Ejecución' ? 'selected' : ''}>En Ejecución</option>
            <option value="Finalizada" ${tarea.estado === 'Finalizada' ? 'selected' : ''}>Finalizada</option>
        </select>
        <button class="editar-tarea" data-id="${tarea.id}">Editar</button>
        <button class="boton-eliminar" data-id="${tarea.id}">Eliminar</button>
    `;

    tareaElement.querySelector('.estado-tarea').addEventListener('change', actualizarEstadoTarea);
    tareaElement.querySelector('.editar-tarea').addEventListener('click', abrirModalEdicion);
    tareaElement.querySelector('.boton-eliminar').addEventListener('click', eliminarTarea);

    return tareaElement;
}

function crearTarea(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    fetch('crear_tarea.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            cargarTareas();
            event.target.reset();
        } else {
            alert('Error al crear la tarea');
        }
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
            cargarTareas();
        } else {
            alert('Error al actualizar el estado de la tarea');
        }
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
            document.getElementById('modal-editar').style.display = 'block';
        });
}

function guardarEdicionTarea(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    fetch('editar_tarea.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            document.getElementById('modal-editar').style.display = 'none';
            cargarTareas();
        } else {
            alert('Error al editar la tarea');
        }
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
                cargarTareas();
            } else {
                alert('Error al eliminar la tarea');
            }
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
                document.getElementById('modal-editar').style.display = 'none';
                cargarTareas();
            } else {
                alert('Error al eliminar la tarea');
            }
        });
    }
}