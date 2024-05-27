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

    // public function obtenerDocumentosPorID($paciente_id)
    // {
    //     $sql = "SELECT * FROM `documentos_sanitarios` WHERE paciente_id = ?";
    //     $stmt = self::$conexion->prepare($sql);
    //     $stmt->bind_param("s", $paciente_id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $documentos = $result->fetch_all(MYSQLI_ASSOC);
    //     $stmt->close();
    //     return $documentos;
    // }

    // public function obtenerDocumentosPorEstado($estado)
    // {
    //     $sql = "SELECT * FROM `documentos_sanitarios` WHERE estado = ?";
    //     $stmt = self::$conexion->prepare($sql);
    //     $stmt->bind_param("s", $estado);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $documentos = $result->fetch_all(MYSQLI_ASSOC);
    //     $stmt->close();
    //     return $documentos;
    // }

    // public function buscarDocumentosPorIDyEstado($paciente_id, $estado)
    // {
    //     $sql = "SELECT * FROM `documentos_sanitarios` WHERE paciente_id = ? AND estado = ?";
    //     $stmt = self::$conexion->prepare($sql);
    //     $stmt->bind_param("ss", $paciente_id, $estado);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $documentos = $result->fetch_all(MYSQLI_ASSOC);
    //     $stmt->close();
    //     return $documentos;
    // }

    public function buscarDocumentos($paciente_id, $estado)
    {
        $sql = "SELECT * FROM `documentos_sanitarios` WHERE 1=1";
        $params = [];
        $types = "";
    
        if (!empty($paciente_id)) {
            $sql .= " AND paciente_id = ?";
            $params[] = $paciente_id;
            $types .= "s";
        }
    
        if (!empty($estado)) {
            $sql .= " AND estado = ?";
            $params[] = $estado;
            $types .= "s";
        }
    
        $stmt = self::$conexion->prepare($sql);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $documentos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    
        return $documentos;
    }
}
?>
