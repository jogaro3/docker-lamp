<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../usuarios/login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('../vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Tareas</h2>
                </div>

                <div class="container justify-content-between">
                <?php

                    $resultado = null;
                    $id_usuario = $_SESSION['usuario_id'];
                    if (!empty($_GET)) {
                        $estado = isset($_GET['estado']) ? $_GET['estado'] : null;
                        require_once('../modelo/mysqli.php');
                        $resultado = listaTareas($id_usuario, $estado);
                    } else {
                        require_once('../modelo/mysqli.php'); 
                        $resultado = listaTareas($id_usuario, null);
                    }

                    if ($resultado && $resultado[0]) {
                ?>
                    <div class="table">
                        <table class="table table-sm table-striped table-hover">
                            <thead class="thead">
                                <tr>                            
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
        $lista = $resultado[1];
        if (count($lista) > 0) {
            foreach ($lista as $tarea) {
                $tarea_usuario_id = $tarea['id_usuario'];

                echo '<tr>';
                echo '<td>' . $tarea['id'] . '</td>';
                echo '<td>' . $tarea['titulo'] . '</td>';
                echo '<td>' . $tarea['descripcion'] . '</td>';
                echo '<td>' . $tarea['estado'] . '</td>';
                echo '<td>' . $tarea['id_usuario'] . '</td>';
                echo '<td>';

                echo '<a class="btn btn-sm btn-info" href="tarea.php?id=' . $tarea['id'] . '" role="button">Ver Detalles</a> ';

                echo '<a class="btn btn-sm btn-primary ms-2" href="subidaFichForm.php?id=' . $tarea['id'] . '" role="button">Añadir Archivo</a> ';

                if ($tarea_usuario_id == $_SESSION['usuario_id'] || $_SESSION['rol'] == 1) {
                    echo '<a class="btn btn-sm btn-outline-success ms-2" href="editaTareaForm.php?id=' . $tarea['id'] . '" role="button">Editar</a>';
                    echo '<a class="btn btn-sm btn-outline-danger ms-2" href="borraTarea.php?id=' . $tarea['id'] . '" role="button">Borrar</a>';
                }

                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="100">No hay tareas</td></tr>';
        }
    ?>
</tbody>
                        </table>
                    </div>
                <?php
                    } else {
                        echo '<div class="alert alert-warning" role="alert">' . $resultado[1] . '</div>';
                    }
                ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>
    
</body>
</html>