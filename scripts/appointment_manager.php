<?php
include '../controllers/AppointmentController.php';

// Crea una instancia del controlador de inicio de sesión
$appointmentController = new AppointmentController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
        case 'asignar':

            // $datos = array(
            //     'nombre' => $_POST["nombre"],
            //     'apellidos' => $_POST["apellidos"],
            //     'genero' => $_POST["genero"],
            //     'telefono' => $_POST["telefono"],
            //     'fecha_nacimiento' => $_POST["fecha_nacimiento"],
            //     'direccion' => $_POST["direccion"],
            //     'provincia' => $_POST["provincia"],
            //     'municipio' => $_POST["municipio"],
            //     'cp' => $_POST["cp"],
            //     'email' => $_POST["email"],
            //     'pass' => password_hash($_POST["pass"], PASSWORD_DEFAULT),
            //     'rol' => $_POST["rol"]
            // );
            $appointmentController->asignarCita();

            break;

        case 'confirmar':

            break;

        case 'editar':

            break;

        case 'eliminar':

            break;
    }
}
?>
