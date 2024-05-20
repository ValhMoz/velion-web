<?php

require_once '../models/BaseModel.php';

class DocumentoModel extends BaseModel
{
    public function subirDocumento($datos)
    {
        return $this->insert('documentos_sanitarios', $datos);
    }

    public function obtenerDocumentosPorPaciente($paciente_id)
    {
        return $this->read('documentos_sanitarios', "paciente_id = '$paciente_id'");
    }

    public function firmarDocumento($documento_id)
    {
        return $this->update('documentos_sanitarios', ['estado' => 'Firmado'], "documento_id = $documento_id");
    }

    public function rechazarDocumento($documento_id)
    {
        return $this->update('documentos_sanitarios', ['estado' => 'Rechazado'], "documento_id = $documento_id");
    }
}
?>
