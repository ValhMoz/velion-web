<?php
include '../controllers/InvoiceController.php';

// Verificar si se recibió el ID de la factura
if (isset($_GET['id'])) {
    $factura_id = $_GET['id'];

    // Crear una instancia del controlador
    $invoiceController = new InvoiceController();

    // Llamar a la función para generar la factura PDF
    $invoiceController->generarFacturaPDF($factura_id);
    header('Location: ../pages/patients-module/dashboard.php');
    exit();

} else {
    // Si no se recibió el ID de la factura, redirigir o mostrar un mensaje de error
    echo "Error: No se proporcionó el ID de la factura.";
}   exit();
?>
