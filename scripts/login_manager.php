<?php

// Incluye el archivo UserController.php
include '../controllers/UserController.php';

// Verifica si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se enviaron datos de nombre de usuario y contraseña
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Obtiene los datos del formulario
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Crea una instancia del controlador de inicio de sesión
        $userController = new UserController();

        // Intenta iniciar sesión con los datos proporcionados
        $userController->iniciarSesion($username, $password);

        // Si el checkbox está marcado, establece un tiempo de expiración más largo para la sesión
        if (isset($_POST['mantener_sesion']) && $_POST['mantener_sesion'] == 'on') {
            // Establece un tiempo de expiración más largo (por ejemplo, 30 días)
            ini_set('session.cookie_lifetime', 30 * 24 * 3600);
        }
    } else {
        // Datos de inicio de sesión incompletos
        echo "Por favor, introduzca nombre de usuario y contraseña.";
    }
} else {
    // Acceso no autorizado
    echo "Acceso no autorizado.";
}

?>
