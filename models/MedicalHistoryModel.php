<?php

require 'BaseModel.php';

class MedicalHistoryModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerInformes()
    {
        $sql = "SELECT 
        hm.id AS historial_id,
        hm.fecha AS fecha,
        hm.descripcion AS descripcion,
        hm.diagnostico AS diagnostico,
        hm.tratamiento AS tratamiento,
        hm.notas AS notas,
        u_paciente.usuario_id AS paciente_id,
        u_paciente.nombre AS nombre_paciente,
        u_paciente.apellidos AS apellidos_paciente,
        u_paciente.fecha_nacimiento AS fecha_nacimiento_paciente,
        u_paciente.genero AS genero_paciente,
        u_paciente.telefono AS telefono_paciente,
        u_paciente.email AS email_paciente,
        u_paciente.direccion AS direccion_paciente,
        u_paciente.provincia AS provincia_paciente,
        u_paciente.municipio AS municipio_paciente,
        u_paciente.cp AS cp_paciente,
        u_fisioterapeuta.nombre AS nombre_fisioterapeuta,
        u_fisioterapeuta.apellidos AS apellidos_fisioterapeuta
        -- u_fisioterapeuta.fecha_nacimiento AS fecha_nacimiento_fisioterapeuta,
        -- u_fisioterapeuta.genero AS genero_fisioterapeuta,
        -- u_fisioterapeuta.telefono AS telefono_fisioterapeuta,
        -- u_fisioterapeuta.email AS email_fisioterapeuta,
        -- u_fisioterapeuta.direccion AS direccion_fisioterapeuta,
        -- u_fisioterapeuta.provincia AS provincia_fisioterapeuta,
        -- u_fisioterapeuta.municipio AS municipio_fisioterapeuta,
        -- u_fisioterapeuta.cp AS cp_fisioterapeuta
        FROM 
            historial_medico hm
        INNER JOIN 
            usuarios u_paciente ON hm.paciente_id = u_paciente.usuario_id
        INNER JOIN 
            usuarios u_fisioterapeuta ON hm.fisioterapeuta_id = u_fisioterapeuta.usuario_id;
        ";

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

    public function obtenerInformesUsuario($DNI)
    {
        $DNI = self::$conexion->real_escape_string($DNI);

        $sql = "SELECT 
        hm.id AS historial_id,
        hm.fecha AS fecha,
        -- hm.descripcion AS descripcion,
        -- hm.diagnostico AS diagnostico,
        -- hm.tratamiento AS tratamiento,
        -- hm.notas AS notas,
        -- u_paciente.usuario_id AS paciente_id,
        u_paciente.nombre AS nombre_paciente,
        u_paciente.apellidos AS apellidos_paciente,
        -- u_paciente.fecha_nacimiento AS fecha_nacimiento_paciente,
        -- u_paciente.genero AS genero_paciente,
        -- u_paciente.telefono AS telefono_paciente,
        -- u_paciente.email AS email_paciente,
        -- u_paciente.direccion AS direccion_paciente,
        -- u_paciente.provincia AS provincia_paciente,
        -- u_paciente.municipio AS municipio_paciente,
        -- u_paciente.cp AS cp_paciente,
        u_fisioterapeuta.nombre AS nombre_fisioterapeuta,
        u_fisioterapeuta.apellidos AS apellidos_fisioterapeuta
        -- u_fisioterapeuta.fecha_nacimiento AS fecha_nacimiento_fisioterapeuta,
        -- u_fisioterapeuta.genero AS genero_fisioterapeuta,
        -- u_fisioterapeuta.telefono AS telefono_fisioterapeuta,
        -- u_fisioterapeuta.email AS email_fisioterapeuta,
        -- u_fisioterapeuta.direccion AS direccion_fisioterapeuta,
        -- u_fisioterapeuta.provincia AS provincia_fisioterapeuta,
        -- u_fisioterapeuta.municipio AS municipio_fisioterapeuta,
        -- u_fisioterapeuta.cp AS cp_fisioterapeuta
        FROM 
            historial_medico hm
        INNER JOIN 
            usuarios u_paciente ON hm.paciente_id = u_paciente.usuario_id
        INNER JOIN 
            usuarios u_fisioterapeuta ON hm.fisioterapeuta_id = u_fisioterapeuta.usuario_id
        WHERE 
            u_paciente.usuario_id = '$DNI'";

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