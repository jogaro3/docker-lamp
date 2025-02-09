<?php
if (isset($_POST['tema'])) {
    $tema = $_POST['tema'];

   setcookie('tema', $tema, time() + (3600 * 24 * 365), "/");

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>