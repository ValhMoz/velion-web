<?php

require_once 'BaseModel.php';

class MedicalHistoryModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerInforme($DNI)
    {
        $DNI = self::$conexion->real_escape_string($DNI);

        $sql = "SELECT 
        c.cita_id,
        c.fecha_hora,
        c.estado AS estado_cita,
        e.descripcion AS especialidad,
        p.usuario_id AS paciente_id,
        p.nombre AS paciente_nombre,
        p.apellidos AS paciente_apellidos,
        p.telefono AS paciente_telefono,
        p.fecha_nacimiento AS paciente_fecha_nacimiento,
        p.direccion AS paciente_direccion,
        p.provincia AS paciente_provincia,
        p.municipio AS paciente_municipio,
        p.cp AS paciente_cp,
        p.email AS paciente_email,
        p.genero as paciente_genero,
        hmed.historial_id,
        hmed.fecha AS historial_fecha,
        hmed.descripcion AS historial_descripcion,
        hmed.diagnostico AS historial_diagnostico,
        hmed.tratamiento AS historial_tratamiento,
        hmed.notas AS historial_notas
        FROM 
            citas c
        JOIN 
            usuarios p ON c.paciente_id = p.usuario_id
        LEFT JOIN 
            historial_medico hmed ON c.historial_id = hmed.historial_id
        LEFT JOIN 
            especialidades e ON c.especialidad_id = e.especialidad_id
        WHERE 
            p.usuario_id = '$DNI'
        AND
            c.estado = 'Realizada'
        ORDER BY 
        c.fecha_hora DESC";

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

    public function obtenerUltimaId()
    {
        $sql = "SELECT MAX(historial_id) AS last_id FROM historial_medico";
        $result = self::$conexion->query($sql);
        $row = $result->fetch_assoc();
        return $row['last_id'];
    }
}
