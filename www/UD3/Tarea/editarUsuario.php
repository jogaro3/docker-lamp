<?php
require 'pdo.php'; // Incluye tu archivo de conexión PDO

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $contrasena = !empty($_POST['contrasena']) ? password_hash($_POST['contrasena'], PASSWORD_DEFAULT) : null;

    // Actualizar los datos del usuario
    if ($contrasena) {
        $sql = "UPDATE usuarios SET username = ?, nombre = ?, apellidos = ?, contrasena = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $nombre, $apellidos, $contrasena, $id]);
    } else {
        $sql = "UPDATE usuarios SET username = ?, nombre = ?, apellidos = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $nombre, $apellidos, $id]);
    }

    echo "Usuario actualizado correctamente.";
}
?>