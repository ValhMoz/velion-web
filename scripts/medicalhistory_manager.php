<?php
include '../controllers/MedicalHistoryController.php';

// Crea una instancia del controlador de inicio de sesión
$invoiceController = new InvoiceController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
        case 'generar_informe':
            $medicalController->generarInformeMedico();
            header('Location: ../pages/dashboard-patients.php');
            exit();
            break;

        case 'actualizar_informe':
            
            exit();
            break;
    }
}
?>