<?php
include '../controllers/InvoiceController.php';

// Crea una instancia del controlador de inicio de sesión
$invoiceController = new InvoiceController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
        case 'guardar_factura':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Obtener los valores del formulario

                $datos = array(
                    'paciente_id' => $_POST['paciente_id'],
                    'monto' => $_POST['monto'],
                    'descripcion' => $_POST['descripcion'],
                    'fecha_emision' => $_POST['fecha_emision'],
                    'estado'  => $_POST['estado']
                );

                // Intenta registrar un usuario con los datos proporcionados
                $invoiceController->guardarFactura($datos);
            } else {
                echo "No se ha podido completar el registro";
            }
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $factura_id = $_GET['id'];

        // Llamar a la función para generar la factura PDF
        $invoiceController->generarFacturaPDF($factura_id);
        header('Location: ../pages/patients-module/./includes/dashboard.php');
        exit();
    } else {
        // Si no se recibió el ID de la factura, redirigir o mostrar un mensaje de error
        echo "Error: No se proporcionó el ID de la factura.";
    }
    exit();
}
?>