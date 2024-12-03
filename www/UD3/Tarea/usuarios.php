<?php
require 'pdo.php'; // Incluye tu archivo de conexión PDO

// Consulta para obtener todos los usuarios
$sql = "SELECT * FROM usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll();

echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Lista de Usuarios</title>";
// Incluyendo Bootstrap
echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>";
echo "</head>";
echo "<body>";

// Header
echo "<header class='bg-primary text-white text-center py-3'>";
echo "<h1>Gestión de tareas</h1>";
echo "<p>Tarea unidad 3 de DWCS</p>";
echo "</header>";

// Menú lateral (importado desde menu.php)
echo "<div class='container-fluid'>";
echo "<div class='row'>";
echo "<nav class='col-md-3 col-lg-2 d-md-block bg-light sidebar'>";
echo "<div class='position-sticky'>";
// Aquí importamos el menú desde menu.php
include_once('menu.php');
echo "</div>";
echo "</nav>";

// Contenido principal
echo "<main class='col-md-9 ms-sm-auto col-lg-10 px-4'>";
echo "<div class='container mt-5'>"; // Contenedor para centrar todo
echo "<h2 class='text-center'>Lista de Usuarios</h2>";
echo "<table class='table table-bordered'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>";

// Mostrando los usuarios en la tabla
foreach ($usuarios as $usuario) {
    echo "<tr>
            <td>{$usuario['id']}</td>
            <td>{$usuario['username']}</td>
            <td>{$usuario['nombre']}</td>
            <td>{$usuario['apellidos']}</td>
            <td>
                <a href='editarUsuario.php?id={$usuario['id']}' class='btn btn-warning btn-sm'>Editar</a> | 
                <a href='borrarUsuario.php?id={$usuario['id']}' class='btn btn-danger btn-sm'>Borrar</a>
            </td>
        </tr>";
}

echo "</tbody></table>";
echo "</div>"; // Cierre del contenedor
echo "</main>"; // Fin del contenido principal
echo "</div>"; // Fin del contenedor fluid

// Footer
echo "<footer class='bg-dark text-white text-center py-3 mt-5'>";
echo "<p>&copy; 2024 Gestión de Tareas - Todos los derechos reservados</p>";
echo "</footer>";

// Scripts de Bootstrap
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>";
echo "</body>";
echo "</html>";
?>