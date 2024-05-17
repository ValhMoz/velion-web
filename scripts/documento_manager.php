<?php
require_once '../controllers/DocumentoController.php';

$documentoController = new DocumentoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['action'];

    if ($accion === 'subir_documento') {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $ruta_documento = 'ruta/al/directorio/' . basename($_FILES['ruta_documento']['name']);
        $paciente_id = $_POST['paciente_id'];
        $sanitario_id = $_POST['sanitario_id'];

        // Mover el archivo subido al directorio deseado
        if (move_uploaded_file($_FILES['ruta_documento']['tmp_name'], $ruta_documento)) {
            $datos = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'ruta_documento' => $ruta_documento,
                'paciente_id' => $paciente_id,
                'sanitario_id' => $sanitario_id
            ];
            $documentoController->subirDocumento($datos);
        } else {
            $_SESSION['alert'] = array('type' => 'danger', 'message' => 'No se ha podido subir el archivo.');
            header('Location: ../pages/documentos.php');
            exit();
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $accion = $_GET['action'];

    if ($accion === 'firmar') {
        $documento_id = $_GET['documento_id'];
        $documentoController->firmarDocumento($documento_id);
    } elseif ($accion === 'rechazar') {
        $documento_id = $_GET['documento_id'];
        $documentoController->rechazarDocumento($documento_id);
    }
}
?>
