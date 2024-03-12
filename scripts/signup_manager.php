<?php
include '../controllers/UserController.php';
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario

    $datos = array(
        'usuario_id' => $_POST["usuario_id"],
        'nombre' => $_POST["nombre"],
        'apellidos' => $_POST["apellidos"],
        'genero' => $_POST["genero"],
        'telefono' => $_POST["telefono"],
        'fecha_nacimiento' => $_POST["fecha_nacimiento"],
        'direccion' => $_POST["direccion"],
        'email' => $_POST["email"],
        'pass' => password_hash($_POST["pass"], PASSWORD_DEFAULT),
        'rol' => "paciente"
    );

    // Crea una instancia del controlador de inicio de sesión
    $userController = new UserController();

    // Intenta registrar un usuario con los datos proporcionados
    $userController->registrarUsuario($datos);


} else {
    echo "No se ha podido completar el registro";
}
?>
