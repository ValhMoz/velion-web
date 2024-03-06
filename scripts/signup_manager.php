<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario

    $datos = array(
        'usuario_id' => $_POST["usuario_id"],
        'nombre' => $_POST["nombre"],
        'lastname' => $_POST["lastname"],
        'dni' => $_POST["dni"],
        'genero' => $_POST["genero"],
        'telefono' => $_POST["telefono"],
        'direccion' => $_POST["direccion"],
        'email' => $_POST["email"],
        'pass' => $_POST["pass"],
        'confirmPass' => $_POST["confirmPass"],
        'rol' => "paciente"
    );

         // Crea una instancia del controlador de inicio de sesión
        $userController = new UserController();

        // Intenta registrar un usuario con los datos proporcionados
        $userController->registrarUsuario($datos);

    // Aquí continuaría la lógica para procesar el registro
    // Por ejemplo, guardar los datos en la base de datos
    // Y redirigir a una página de éxito o mostrar un mensaje de confirmación
}
?>
