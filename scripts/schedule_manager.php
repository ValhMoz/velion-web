<?php
include '../controllers/ScheduleController.php';
include 'session_manager.php';

$scheduleController = new ScheduleController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
        case 'añadir_horario':
            $datos = array(
                'id' => $_POST["id"],
                'nombre' => $_POST["nombre"],
                'fisioterapeuta_id' => $_POST["fisioterapeuta_id"],
                'estado' => $_POST["estado"],
                'ult_modificacion' => $_POST["ult_modificacion"],
                'fecha_nacimiento' => $_POST["fecha_nacimiento"]
            );

            $scheduleController->añadirNuevoHorario($datos);
            break;

        case 'editar_horario':
            $datos = array(
                'id' => $_POST["id"],
                'nombre' => $_POST["nombre"],
                'fisioterapeuta_id' => $_POST["fisioterapeuta_id"],
                'estado' => $_POST["estado"],
                'ult_modificacion' => $_POST["ult_modificacion"],
                'fecha_nacimiento' => $_POST["fecha_nacimiento"]
            );

            $condicion = "id = '" . $_POST["id"] . "'";
            $scheduleController->editarHorario($datos, $condicion);
            break;

        case 'eliminar_horario':
            $datos = "id = '" . $_POST["id"] . "'";
            $scheduleController->eliminarHorario($datos);
            break;

        case 'exportar':
            $scheduleController->exportarDatos();
            break;
    }
}
