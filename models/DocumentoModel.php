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

    public function obtenerDocumentosPaginados($iniciar, $articulos_x_pagina){
         // Buscar el usuario en la base de datos
         $sql = "SELECT * FROM documentos_sanitarios LIMIT $iniciar, $articulos_x_pagina";

         $resultado = self::$conexion->query($sql);
 
         // Ejecutar la consulta
         $resultado =  self::$conexion->query($sql);
 
         // Manejo de errores
         if (!$resultado) {
             die("Error al ejecutar la consulta: " . self::$conexion->error);
         }
 
         // Procesa el resultado
         $datos = array();
         while ($fila = $resultado->fetch_assoc()) {
             $datos[] = $fila;
         }
         return $datos;
    }
}
?>
