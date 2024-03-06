<?php
    // Inicia la sesión si no está iniciada
    session_start();

    // Verifica si hay un nombre de usuario en la sesión
    if (isset($_SESSION['email'])) {
        $nombreUsuario = $_SESSION['nombre'];
    } else {
        // Si no hay un nombre de usuario en la sesión, redirige a la página de inicio de sesión
        header('Location: ./404.php');
        exit();
    }
?>