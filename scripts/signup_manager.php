<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $username = $_POST["username"];
    $dni = $_POST["usuario_id"];
    $email = $_POST["email"];
    $password = $_POST["contraseña"];
    $direccion = $_POST["direccion"];
    // Verificar si las contraseñas coinciden
    if ($password !== $confirmPassword) {
        // Las contraseñas no coinciden, mostrar un mensaje de error y redirigir de vuelta al formulario de registro
        header("Location: ../pages/sign_up.php?error=password_mismatch");
        exit; // Detener la ejecución del script
    }

    // Aquí continuaría la lógica para procesar el registro
    // Por ejemplo, guardar los datos en la base de datos
    // Y redirigir a una página de éxito o mostrar un mensaje de confirmación
}
?>
