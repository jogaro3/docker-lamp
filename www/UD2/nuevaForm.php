<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!--header-->
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php include 'menu.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Crear Nueva Tarea</h2>
                </div>
                <div class="container">
                    <!-- Inicializar mensaje -->
                    <?php
                    include 'utils.php';  // Asegúrate de incluir utils.php donde están las funciones
                    
                    $mensaje = "";  // Variable para el mensaje de resultado

                    // Procesar el formulario al enviar
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $titulo = $_POST['titulo'] ?? '';
                        $descripcion = $_POST['descripcion'] ?? '';
                        $prioridad = $_POST['prioridad'] ?? '';

                        // Intenta guardar la tarea
                        if (guardarTarea($titulo, $descripcion, $prioridad)) {
                            $mensaje = "Tarea guardada con éxito.";
                        } else {
                            $mensaje = "Error al guardar la tarea. Asegúrate de que los campos son válidos.";
                        }
                    }
                    ?>

                    <!-- Mostrar mensaje de resultado -->
                    <?php if ($mensaje): ?>
                        <div class="alert alert-info"><?= $mensaje ?></div>
                    <?php endif; ?>

                    <!-- Formulario para crear una nueva tarea -->
                    <form action="" method="POST" class="mb-5">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título de la Tarea</label>
                            <input type="text" id="titulo" name="titulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select id="prioridad" name="prioridad" class="form-select" required>
                                <option value="">Seleccione una prioridad</option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!--footer-->
    <?php include 'footer.php'; ?>
</body>
</html>