<?php
// Establece las credenciales correctas de conexión
$host = 'db';  // O 'db' si usas un contenedor Docker para la base de datos
$user = 'colegio';       // El usuario 'root' o el que tengas configurado
$password = 'colegio';       // Aquí debes poner la contraseña del usuario, por ejemplo 'root' o cualquier otra contraseña que tengas configurada
$database = 'colegio';

// Crear la conexión
$conexion = new mysqli($host, $user, $password);

// Verificar la conexión
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conexion->query($sql) === TRUE) {
    echo "Base de datos '$database' creada o ya existe.";
} else {
    echo "Error al crear la base de datos: " . $conexion->error;
}

// Seleccionar la base de datos
$conexion->select_db($database);

// Crear las tablas si no existen
$sqlUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100),
    contrasena VARCHAR(100) NOT NULL
)";

$sqlTareas = "CREATE TABLE IF NOT EXISTS tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50) NOT NULL,
    descripcion VARCHAR(250),
    estado VARCHAR(50),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
)";

// Ejecutar las consultas para crear las tablas
if ($conexion->query($sqlUsuarios) === TRUE && $conexion->query($sqlTareas) === TRUE) {
    echo "Tablas 'usuarios' y 'tareas' creadas o ya existen.";
} else {
    echo "Error al crear las tablas: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>