<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!--header-->
    <?php include 'header.php'?>
    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php include 'menu.php'?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Título del contenido</h2>
                </div>
                <div class="container">
                    <p>Tipos de datos</p>
                    <p>Los tipos de datos en PHP son:</p>
                    <ul>
                        <li>Entero: Es un número entero sin decimales. 
                            <?php 
                            echo $entero = 10 . " ";
                            echo gettype($entero)
                            ?> 
                            </li>
                        <li>Float: Es un número con decimales.
                             <?php 
                             echo $decimal =10.5 . " ";
                             echo gettype($decimal)
                             ?>
                            </li>
                        <li>Boolean: Verdadero o falso:
                            <?php
                            $hoy = true . " ";
                            echo gettype($hoy);
                            $ayer = false . " ";
                            echo gettype($ayer);
                            ?>
                            </li>
                            <li>Cadena de texto: Es una secuencia de caracteres.
                                <?php
                                $edad = 20;
                                $nombre = "Juan";
                                echo $nombre . " tiene {$edad}s";
                                ?>
                            </li>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php include 'footer.php'?>
</body>
</html>