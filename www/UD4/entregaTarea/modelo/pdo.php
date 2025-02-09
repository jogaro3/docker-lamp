<?php

function conectaPDO()
{
    $servername = getenv('DB_HOST');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');
    $dbname = getenv('DB_NAME');

    try {
        $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conPDO;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

function listaUsuarios()
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT id, username, nombre, apellidos, rol FROM usuarios');
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return [true, $resultados];
    }
    catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
    finally {
        $con = null;
    }
}

function listaTareasPDO($id_usuario, $estado)
{
    try {
        $con = conectaPDO();
        $sql = 'SELECT * FROM tareas WHERE id_usuario = ' . $id_usuario;
        if (isset($estado))
        {
            $sql = $sql . " AND estado = '" . $estado . "'";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $tareas = array();
        while ($row = $stmt->fetch())
        {
            $usuario = buscaUsuario($row['id_usuario']);
            $row['id_usuario'] = $usuario['username'];
            array_push($tareas, $row);
        }
        return [true, $tareas];
    }
    catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
    finally {
        $con = null;
    }
}

function nuevoUsuario($nombre, $apellidos, $username, $contrasena, $rol = 0)
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellidos, username, contrasena, rol) 
                               VALUES (:nombre, :apellidos, :username, :contrasena, :rol)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();
        
        $stmt->closeCursor();

        return [true, null];
    }
    catch (PDOException $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}

function actualizaUsuario($id, $nombre, $apellidos, $username, $contrasena, $rol = 0)
{
    try{
        $con = conectaPDO();
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, username = :username";

        if (isset($contrasena)) {
            $sql = $sql . ', contrasena = :contrasena';
        }

        if (isset($rol)) {
            $sql = $sql . ', rol = :rol';
        }

        $sql = $sql . ' WHERE id = :id';

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        
        if (isset($contrasena)) {
            $stmt->bindParam(':contrasena', $contrasena);
        }

        $stmt->bindParam(':id', $id);

        if (isset($rol)) {
            $stmt->bindParam(':rol', $rol);
        }

        $stmt->execute();
        
        $stmt->closeCursor();

        return [true, null];
    }
    catch (PDOException $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}
function borraUsuario($id)
{
    try {
        $con = conectaPDO();

        $con->beginTransaction();

        $stmt = $con->prepare('DELETE FROM tareas WHERE id_usuario = ' . $id);
        $stmt->execute();
        $stmt = $con->prepare('DELETE FROM usuarios WHERE id = ' . $id);
        $stmt->execute();
        
        return [$con->commit(), ''];
    }
    catch (PDOException $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}

function buscaUsuario($id)
{
    try
    {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE id = ' . $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 1)
        {
            return $stmt->fetch();
        }
        else
        {
            return null;
        }
    }
    catch (PDOException $e)
    {
        return null;
    }
    finally
    {
        $con = null;
    }
}

