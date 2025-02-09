<?php
session_start();
session_destroy();
header('Location: /UD4/entregaTarea/usuarios/login.php'); 
exit();