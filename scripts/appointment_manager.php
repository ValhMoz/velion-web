<?php
include '../controllers/AppointmentController.php';

// Crea una instancia del controlador de inicio de sesión
$appointmentController = new AppointmentController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
        case 'asignar':

            break;

        case 'confirmar':

            break;

        case 'eliminar':

            break;
    }
}
?>
