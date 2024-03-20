<?php

require 'BaseModel.php';

class InvoiceModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerDatosFacturas()
    {
        // Query para obtener las facturas junto con los datos del paciente
        $sql = "SELECT f.factura_id, f.paciente_id, f.fecha_emision, f.monto, f.estado, u.nombre, u.apellidos, u.email
                FROM facturas f
                INNER JOIN usuarios u ON f.paciente_id = u.usuario_id";

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