<?php
include '../controllers/SpecialityController.php';
include 'session_manager.php';

$specialityController = new SpecialityController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
        case 'añadir':
            $datos = array(
                'descripcion' => $_POST["descripcion"],
                'ult_modificacion' => $_POST["ult_modificacion"],
            );

            $specialityController->añadirEspecialidad($datos);
            break;

        case 'editar':
            $datos = array(
                'id' => $_POST["id"],
                'descripcion' => $_POST["descripcion"],
                'ult_modificacion' => $_POST["ult_modificacion"],
            );

            $condicion = "id = '" . $_POST["id"] . "'";
            $specialityController->editarEspecialidad($datos, $condicion);
            break;

        case 'eliminar':
            $datos = "id = '" . $_POST["id"] . "'";
            $specialityController->eliminarEspecialidad($datos);
            break;

        case 'actualizar_datos':
            $datos = array(
                'email' => $_POST["email"],
                'pass' => password_hash($_POST["pass"], PASSWORD_DEFAULT)
            );
            $condicion = "usuario_id = '" . $_POST["usuario_id"] . "'";
            $userController->actualizarDatos($datos, $condicion);
            break;
    }
}
