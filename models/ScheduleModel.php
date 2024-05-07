<?php

require 'BaseModel.php';

class ScheduleModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerHorariosPaginados($iniciar, $articulos_x_pagina)
    {
        // Buscar el usuario en la base de datos
        $sql = "SELECT * FROM horarios LIMIT $iniciar, $articulos_x_pagina";

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

    public function obtenerHorariosPorNombre($filtro_horario)
    {
        $sql = "SELECT * FROM horarios WHERE nombre LIKE '%$filtro_horario%'";
        $stmt = self::$conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $horarios = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $horarios;
    }

    public function actualizarHorario($id, $datos)
    {
        $sql = "UPDATE `horarios` SET nombre = ?, fisioterapeuta_id = ?, estado = ?, ult_modificacion = ? WHERE id = ?";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("sissi", $datos['nombre'], $datos['fisioterapeuta_id'], $datos['estado'], $datos['ult_modificacion'], $id);
        $result = $stmt->execute(); // Ejecutar la consulta UPDATE
        $stmt->close();
        return $result;
    }
}
