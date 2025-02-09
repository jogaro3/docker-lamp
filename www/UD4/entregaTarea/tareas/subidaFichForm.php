<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../usuarios/login.php');
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: ID de tarea no proporcionado.");
}
$id_tarea = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <?php include_once('../vista/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once('../vista/menu.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container pt-3">
                    <h2>Subir Archivo</h2>
                    <form action="subidaFichProc.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_tarea" value="<?php echo htmlspecialchars($id_tarea); ?>">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción del archivo:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Seleccionar archivo:</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir</button>
                        <a href="listaTareas.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>
</body>
</html>