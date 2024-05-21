<?php

require_once '../models/DocumentoModel.php';

class DocumentoController
{
    private $documentoModel;

    public function __construct()
    {
        $this->documentoModel = new DocumentoModel();
    }

    public function subirDocumento($datos)
    {
        if ($this->documentoModel->subirDocumento($datos)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Documento subido correctamente.');
        } else {
            $_SESSION['alert'] = array('type' => 'danger', 'message' => 'No se ha podido subir el documento.');
        }
        header('Location: ../pages/documentos.php');
        exit();
    }

    public function obtenerDocumentos(){
        return $this->documentoModel->read('documentos_sanitarios');
    }

    public function buscarDocumentos($filtro_documento_id){
        
    }

    public function obtenerDocumentosPaginados($iniciar, $articulos_x_pagina) {
        return $this->documentoModel->obtenerDocumentosPaginados($iniciar, $articulos_x_pagina);
    }

    public function obtenerDocumentosPorPaciente($paciente_id)
    {
        return $this->documentoModel->obtenerDocumentosPorPaciente($paciente_id);
    }

    public function firmarDocumento($documento_id)
    {
        if ($this->documentoModel->firmarDocumento($documento_id)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Documento firmado correctamente.');
        } else {
            $_SESSION['alert'] = array('type' => 'danger', 'message' => 'No se ha podido firmar el documento.');
        }
        header('Location: ../pages/documentos.php');
        exit();
    }

    public function rechazarDocumento($documento_id)
    {
        if ($this->documentoModel->rechazarDocumento($documento_id)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Documento rechazado correctamente.');
        } else {
            $_SESSION['alert'] = array('type' => 'danger', 'message' => 'No se ha podido rechazar el documento.');
        }
        header('Location: ../pages/documentos.php');
        exit();
    }
}
?>
