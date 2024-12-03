<?php
require 'pdo.php'; // Incluye tu archivo de conexión PDO

// Recuperar el id del usuario desde la URL
$id = $_GET['id'];

// Obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$usuario = $stmt->fetch();

?>

<h2>Editar Usuario</h2>
<form action="editarUsuario.php?id=<?php echo $id; ?>" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" value="<?php echo $usuario['username']; ?>"><br><br>
    
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>"><br><br>
    
    <label for="apellidos">Apellidos:</label><br>
    <input type="text" id="apellidos" name="apellidos" value="<?php echo $usuario['apellidos']; ?>"><br><br>
    
    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena"><br><br>
    
    <input type="submit" value="Actualizar Usuario">
</form>