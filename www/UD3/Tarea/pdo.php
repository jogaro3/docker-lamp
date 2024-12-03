<?php

// Configuración de la conexión a la base de datos
$host = 'db';  // O tu host de base de datos
$dbname = 'colegio';  // Nombre de la base de datos
$username = 'colegio';  // Usuario de la base de datos
$password = 'colegio';  // Contraseña de la base de datos (ajústalo si es necesario)

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Establecer el modo de errores a excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Si ocurre un error, muestra el mensaje de error
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>