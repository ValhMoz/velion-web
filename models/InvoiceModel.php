<?php

require 'BaseModel.php';

class InvoiceModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerDatosFacturasPaginadas($iniciar, $articulos_x_pagina)
    {
        // Query para obtener las facturas junto con los datos del paciente
        $sql = "SELECT 
        facturas.factura_id,
        facturas.paciente_id,
        facturas.fecha_emision,
        facturas.producto,
        facturas.estado,
        productos.monto AS precio_producto
        FROM 
            facturas
        JOIN 
            productos ON facturas.producto = productos.producto_id
        LIMIT $iniciar, $articulos_x_pagina";

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

    public function obtenerFacturasPorID($usuario_id)
    {
        $sql = "SELECT * FROM `facturas` WHERE paciente_id = ?";
        $sql2 = "SELECT * FROM `productos` WHERE "
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("s", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $usuarios;
    }

    public function obtenerFacturasPorEstado($estado)
    {
        $sql = "SELECT * FROM `facturas` WHERE estado = ?";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $usuarios;
    }

    public function buscarFacturasPorIDyEstado($usuario_id, $estado)
    {
        $sql = "SELECT * FROM `facturas` WHERE paciente_id = ? AND estado = ?";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("ss", $usuario_id, $estado);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $usuarios;
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

    public function obtenerFacturasUsuarioPaginadas($DNI, $iniciar, $articulos_x_pagina)
    {
        // Preparar la consulta
        $stmt = self::$conexion->prepare("SELECT f.*, u.*
            FROM facturas f
            INNER JOIN usuarios u ON f.paciente_id = u.usuario_id
            WHERE f.paciente_id = ?
            LIMIT ?, ?");
    
        // Vincular parámetros
        $stmt->bind_param("iii", $DNI, $iniciar, $articulos_x_pagina);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $resultado = $stmt->get_result();
    
        // Manejo de errores
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . self::$conexion->error);
        }
    
        // Procesar el resultado
        $datos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
    
        // Cerrar la consulta preparada
        $stmt->close();
    
        return $datos;
    }
    
}
