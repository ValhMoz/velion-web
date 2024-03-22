<?php
include '../controllers/MedicalHistoryController.php';

// Crear una instancia del controlador
$medicalController = new MedicalHistoryController();

// Llamar a la función para generar la factura PDF
$medicalController->generarInformeMedico();
header('Location: ../pages/dashboard-patients.php');
exit();
?>