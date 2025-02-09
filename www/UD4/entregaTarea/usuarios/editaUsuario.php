<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD4. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('../vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Actualizar usuario</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('../utils.php');
                        $id = $_POST['id'];
                        $nombre = $_POST['nombre'];
                        $apellidos = $_POST['apellidos'];
                        $username = $_POST['username'];
                        $contrasena = $_POST['contrasena'];
                        $rol = $_POST['rol']; // Obtener el rol del formulario
                        $error = false;

                        // Verificar campos de nombre, apellidos, username, etc.
                        if (!validarCampoTexto($nombre)) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo nombre es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        if (!validarCampoTexto($apellidos)) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo apellidos es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        if (!validarCampoTexto($username)) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo username es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        if (!empty($contrasena) && !validaContrasena($contrasena)) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">La contraseña debe ser compleja.</div>';
                        }

                        // Verificar que el rol solo lo cambie un administrador
                        if ($rol != $usuario['rol'] && $usuario['rol'] != 1) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">No puedes cambiar tu propio rol.</div>';
                        }

                        if (!$error) {
                            require_once('../modelo/pdo.php');
                            if (empty($contrasena)) $contrasena = null;
                            // Actualizar usuario en la base de datos, incluyendo el rol
                            $resultado = actualizaUsuario($id, filtraCampo($nombre), filtraCampo($apellidos), filtraCampo($username), $contrasena, $rol);
                            if ($resultado[0]) {
                                echo '<div class="alert alert-success" role="alert">Usuario actualizado correctamente.</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Ocurrió un error actualizando el usuario: ' . $resultado[1] . '</div>';
                            }
                        }
                    ?>

                    <form action="editaUsuario.php" method="POST" class="mb-5 w-50">
                        <?php
                        echo '<div class="mb-3">';
                        echo '<label for="rol" class="form-label">Rol</label>';
                        echo '<select class="form-control" id="rol" name="rol" required>';
                        echo '<option value="0">Usuario normal</option>';
                        echo '<option value="1">Administrador</option>';
                        echo '</select>';
                        echo '</div>';
                        ?>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>
    
</body>
</html>