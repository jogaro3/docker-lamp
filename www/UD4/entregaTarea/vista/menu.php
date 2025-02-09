<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <?php if (!isset($_SESSION['usuario_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/UD4/entregaTarea/usuarios/login.php">
                        Iniciar Sesión
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/UD4/entregaTarea/usuarios/logout.php">
                        Cerrar Sesión
                    </a>
                </li>
            <?php endif; ?>
            <form class="m-3 w-50">
            <form class="m-3 w-50" method="POST" action="tema.php">
    <select id="tema" name="tema" class="form-select mb-2" aria-label="Selector de tema">
        <option value="light" <?php echo ($tema == 'light') ? 'selected' : ''; ?>>Claro</option>
        <option value="dark" <?php echo ($tema == 'dark') ? 'selected' : ''; ?>>Oscuro</option>
    </select>
    <button type="submit" class="btn btn-primary w-100">Aplicar</button>
</form>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/index.php">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/init.php">
                    Inicializar (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/usuarios/usuarios.php">
                    Lista de usuarios (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/usuarios/nuevoUsuarioForm.php">
                    Nuevo usuario (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/tareas/tareas.php">
                    Lista de tareas (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/tareas/nuevaForm.php">
                    Nueva tarea (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/tareas/buscaTareas.php">
                   Buscador de tareas (PDO)
                </a>
            </li>
        </ul>
    </div>
</nav>