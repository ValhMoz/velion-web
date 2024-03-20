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

    public function obtenerDatosFactura($factura_id)
    {
        // Query para obtener los datos de una factura en específico
        $sql = "SELECT f.*, u.*
        FROM facturas f
        INNER JOIN usuarios u ON f.paciente_id = u.usuario_id
        WHERE f.factura_id = ?";

        // Preparar la consulta
        $stmt = self::$conexion->prepare($sql);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            die("Error al preparar la consulta: " . self::$conexion->error);
        }

        // Vincular el parámetro factura_id
        $stmt->bind_param("i", $factura_id);

        // Ejecutar la consulta
        $resultado = $stmt->execute();

        // Verificar si la ejecución de la consulta fue exitosa
        if ($resultado === false) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el resultado
        $resultado = $stmt->get_result();

        // Procesar el resultado
        $datos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();

        return $datos;
    }

    public function obtenerDatosFacturasUsuario($DNI)
    {
        // Query para obtener los datos de una factura en específico
        $sql = "SELECT f.*, u.*
        FROM facturas f
        INNER JOIN usuarios u ON f.paciente_id = u.usuario_id
        WHERE u.usuario_id = ?";

        // Preparar la consulta
        $stmt = self::$conexion->prepare($sql);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            die("Error al preparar la consulta: " . self::$conexion->error);
        }

        // Vincular el parámetro factura_id
        $stmt->bind_param("i", $DNI);

        // Ejecutar la consulta
        $resultado = $stmt->execute();

        // Verificar si la ejecución de la consulta fue exitosa
        if ($resultado === false) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el resultado
        $resultado = $stmt->get_result();

        // Procesar el resultado
        $datos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();

        return $datos;
    }
}
