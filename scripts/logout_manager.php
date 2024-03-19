<?php
include '../controllers/UserController.php';

// Crea una instancia del controlador de inicio de sesión
$userController = new UserController();

// Intenta registrar un usuario con los datos proporcionados
$userController->cerrarSesion();

?>
