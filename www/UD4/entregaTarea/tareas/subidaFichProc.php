<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../usuarios/login.php');
    exit();
}

if (!isset($_POST['id_tarea']) || empty($_POST['id_tarea'])) {
    die("Error: ID de tarea no proporcionado.");
}

$id_tarea = $_POST['id_tarea'];
$descripcion = $_POST['descripcion'];
$archivo = $_FILES['archivo'];

$error = false;
$mensaje_error = "";

// Validación de descripción
if (empty($descripcion)) {
    $error = true;
    $mensaje_error .= "La descripción es obligatoria.<br>";
}

// Validación del archivo
$extensiones_validas = ['jpg', 'jpeg', 'png', 'pdf'];
$ext = pathinfo($archivo['name'], PATHINFO_EXTENSION);
$tamano_maximo = 20 * 1024 * 1024; // 20 MB

if (!in_array(strtolower($ext), $extensiones_validas)) {
    $error = true;
    $mensaje_error .= "El archivo debe ser una imagen (jpg, png) o un PDF.<br>";
}

if ($archivo['size'] > $tamano_maximo) {
    $error = true;
    $mensaje_error .= "El archivo no debe superar los 20 MB.<br>";
}

// Si hay errores, se muestra el mensaje y se redirige
if ($error) {
    echo '<div class="alert alert-danger" role="alert">' . $mensaje_error . '</div>';
    echo '<a href="subidaFichForm.php?id=' . $id_tarea . '" class="btn btn-secondary">Volver</a>';
    exit();
}

// Procesar el archivo
$nombre_archivo = uniqid() . '.' . $ext;
$directorio = '../files/';

if (!is_dir($directorio)) {
    mkdir($directorio, 0777, true);
}

$ruta_archivo = $directorio . $nombre_archivo;

if (move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
    // Aquí deberías insertar los datos del archivo en la base de datos
    require_once('../modelo/mysqli.php');
    $resultado = subirFichero($id_tarea, $descripcion, $nombre_archivo, $ext);

    if ($resultado[0]) {
        echo '<div class="alert alert-success" role="alert">Archivo subido correctamente.</div>';
        echo '<a href="listaTareas.php" class="btn btn-primary">Volver a tareas</a>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Ocurrió un error al guardar el archivo: ' . $resultado[1] . '</div>';
        echo '<a href="subidaFichForm.php?id=' . $id_tarea . '" class="btn btn-secondary">Volver</a>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Error al mover el archivo al directorio de destino.</div>';
    echo '<a href="subidaFichForm.php?id=' . $id_tarea . '" class="btn btn-secondary">Volver</a>';
}

?>