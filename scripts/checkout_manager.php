<?php
include '../controllers/InvoiceController.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario

    $datos = array(
        'paciente_id' => $_POST['paciente_id'],
        'monto' => $_POST['monto'],
        'fecha_emision' => $_POST['fecha_emision'],
        'estado'  => $_POST['estado']
    );

    var_dump(isset($datos));

    // Crea una instancia del controlador de inicio de sesión
    $invoiceController = new InvoiceController();

    // Intenta registrar un usuario con los datos proporcionados
    $invoiceController->guardarFactura($datos);

    

} else {
    echo "No se ha podido completar el registro";
}
?>