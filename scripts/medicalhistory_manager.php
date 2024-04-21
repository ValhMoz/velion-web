<?php
include '../controllers/MedicalHistoryController.php';

$medicalController = new MedicalHistoryController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $medicalController->generarInformeMedico($_GET['id']);
    //header('Location: ../pages/patients-module/./includes/dashboard.php');
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datos = array (
        'fecha' => date('Y-m-d'),
        'diagnostico' => $_POST['diagnostico'],
        'tratamiento' => $_POST['tratamiento'],
        'notas' => $_POST['notas']
    );

    $condicion = "id = '" . $_POST["id"] . "'";
    $medicalController->actualizarInformeMedico($datos, $condicion);
    header('Location: ../pages/medical-history.php');
    exit();
}
?>