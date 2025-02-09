<?php
session_start();
require_once('../modelo/pdo.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; 
    $contrasena = $_POST['contrasena'];

    $usuario = buscaUsuarioPorUsername($username); 
    if ($usuario && $contrasena === $usuario['contrasena']) {
        $_SESSION['usuario_id'] = $usuario['id'];  // Almacenar el ID de usuario
        $_SESSION['rol'] = $usuario['rol'];  // Almacenar el rol del usuario

        unset($_SESSION['error']); 
        header('Location: ../index.php'); 
        exit();
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos'; 
        header('Location: login.php'); exit();
    }
}

function buscaUsuarioPorUsername($username) {
    try {
        $con = conectaPDO(); // Conexión a la base de datos
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE username = :username'); // Consulta SQL para buscar por nombre de usuario
        $stmt->bindParam(':username', $username); // Vincular el parámetro
        $stmt->execute(); // Ejecutar la consulta
        $stmt->setFetchMode(PDO::FETCH_ASSOC); // Establecer el modo de recuperación

        return $stmt->fetch(); // Devolver el primer resultado (si existe)
    } catch (PDOException $e) {
        return null; // Si hay un error, devolver null
    }
}