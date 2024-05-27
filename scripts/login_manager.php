<?php
include '../controllers/LoginController.php';

$loginController = new LoginController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];
    switch ($action) {
        case 'iniciar_sesion':
            // Lógica para iniciar sesión
            handleLogin($loginController);
            break;
        case 'solicitar_nueva_contraseña':
            // Lógica para solicitar nueva contraseña
            handlePasswordResetRequest($loginController);
            break;
        // Otros casos...
    }
}

function handleLogin($loginController) {
    if (isset($_POST["email"]) && isset($_POST["pass"])) {
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $loginController->iniciarSesion($email, $pass);
    } else {
        echo "Por favor, introduzca nombre de usuario y contraseña.";
    }
}

function handlePasswordResetRequest($loginController) {
    if (isset($_POST["resetEmail"])) {
        $email = $_POST["resetEmail"];
        $loginController->generatePasswordResetToken($email);
    }
}
?>