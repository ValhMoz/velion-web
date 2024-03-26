<?php
include '../controllers/MedicalHistoryController.php';
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario

    $datos = array(
        'usuario_id' => $_POST["usuario_id"],
        'diagnostico' => $_POST["diagnostico"],
        'tratamiento' => $_POST["tratamiento"],
        'notas' => $_POST["notas"],
    );

    // Crea una instancia del controlador de inicio de sesión
    $medicalhistoryController = new MedicalHistoryController();

    // Intenta registrar un usuario con los datos proporcionados
    $medicalhistoryController->actualizarInformeMedico($datos);


} else {
    echo "No se ha podido completar el registro";
}
?>