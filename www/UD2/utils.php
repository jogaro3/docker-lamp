<?php
// Array global para almacenar las tareas.
global $tareas;
$tareas = [
    ['id' => 1, 'descripcion' => 'Completar el proyecto de PHP', 'estado' => 'Pendiente'],
    ['id' => 2, 'descripcion' => 'Revisar los informes de ventas', 'estado' => 'En proceso'],
    ['id' => 3, 'descripcion' => 'Enviar correos a clientes', 'estado' => 'Completada'],
];

// Función para devolver el listado de tareas.
function obtenerTareas() {
    global $tareas;
    return $tareas;
}

// Función para filtrar el contenido de un campo, eliminando caracteres especiales y espacios en blanco duplicados.
function filtrarCampo($campo) {
    $campo = trim($campo);
    $campo = htmlspecialchars($campo);
    $campo = preg_replace('/\s+/', ' ', $campo);
    return $campo;
}

// Función para comprobar si un campo contiene información de texto válida.
function validarCampo($campo) {
    $campo = filtrarCampo($campo);
    return !empty($campo) && strlen($campo) > 3;
}

// Función para guardar una tarea en el array global.
function guardarTarea($descripcion, $estado, $prioridad) {
    global $tareas;
    
    $descripcion = filtrarCampo($descripcion);
    $estado = filtrarCampo($estado);
    $prioridad = filtrarCampo($prioridad); // Filtrar prioridad

    if (validarCampo($descripcion) && validarCampo($estado)) {
        // Genera un ID para la nueva tarea
        $id = count($tareas) + 1;

        // Crea un array con la tarea y la añade al array global.
        $nuevaTarea = [
            'id' => $id,
            'descripcion' => $descripcion,
            'estado' => $estado,
            'prioridad' => $prioridad // Añadir prioridad
        ];
        $tareas[] = $nuevaTarea;
        return true;
    }
    return false;
}
?>