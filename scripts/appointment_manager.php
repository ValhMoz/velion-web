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
            $datos = array(
                'estado' => 'Realizada'
            );
            $condicion = "cita_id = '" . $_POST["cita_id"] . "'";
            $appointmentController->confirmarCita('citas', $datos, $condicion);
            break;

        case 'editar':

            break;

        case 'eliminar':
            $condicion = "cita_id = '" . $_POST["cita_id"] . "'";
            $appointmentController->eliminarCita('citas', $condicion);

            break;
    }
}
?>
