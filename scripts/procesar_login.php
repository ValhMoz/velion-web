<?php

// Incluye el archivo LoginController.php
include '../controllers/LoginController.php';

// Verifica si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se enviaron datos de nombre de usuario y contraseña
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Obtiene los datos del formulario
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Crea una instancia del controlador de inicio de sesión
        $loginController = new LoginController();

        // Intenta iniciar sesión con los datos proporcionados
        $loginController->iniciarSesion($username, $password);
    } else {
        // Datos de inicio de sesión incompletos
        echo "Por favor, introduzca nombre de usuario y contraseña.";
    }
} else {
    // Acceso no autorizado
    echo "Acceso no autorizado.";
}

?>
