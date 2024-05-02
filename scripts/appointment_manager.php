<?php
include '../controllers/AppointmentController.php';

// Crea una instancia del controlador de inicio de sesión
$appointmentController = new AppointmentController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
        case 'asignar':
            // $datos = array(
            //     'paciente_id' => $_POST["paciente_id"],
            //     'fisioterapeuta_id' => $_POST["fisioterapeuta_id"],
            //     'fecha' => $_POST["fecha"],
            //     'hora' => $_POST["hora"],
            // );
            echo('hola');
            // $appointmentController->asignarCita();

            break;

        case 'confirmar':

            break;

        case 'editar':

            break;

        case 'eliminar':
            echo('hola');

            break;
    }
}
?>
