<?php

require_once 'BaseModel.php';

class AppointmentModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerCitasHoy()
    {
        $fecha_actual = date('Y-m-d');

        $sql = "SELECT citas.cita_id, pacientes.nombre AS nombre_paciente, fisioterapeutas.nombre AS nombre_fisioterapeuta, citas.fecha_hora
                FROM citas
                INNER JOIN usuarios AS pacientes ON citas.paciente_id = pacientes.usuario_id
                INNER JOIN usuarios AS fisioterapeutas ON citas.fisioterapeuta_id = fisioterapeutas.usuario_id
                WHERE pacientes.rol = 'paciente'
                AND DATE(citas.fecha_hora) = ". $fecha_actual . ";";

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


    public function obtenerCitasPaginadas($iniciar, $articulos_x_pagina)
    {
        $sql = "SELECT
        c.cita_id,
        c.fecha_hora,
        c.estado,
        p.usuario_id AS paciente_id,
        p.nombre AS paciente_nombre,
        p.apellidos AS paciente_apellidos,
        p.telefono AS paciente_telefono,
        -- p.email AS paciente_email,
        -- p.fecha_nacimiento AS paciente_fecha_nacimiento,
        -- p.direccion AS paciente_direccion,
        -- p.provincia AS paciente_provincia,
        -- p.municipio AS paciente_municipio,
        -- p.cp AS paciente_cp,
        -- p.genero AS paciente_genero,
        p.sesiones_disponibles AS paciente_sesiones_disponibles,
        f.usuario_id AS fisioterapeuta_id,
        f.nombre AS fisioterapeuta_nombre,
        f.apellidos AS fisioterapeuta_apellidos
        -- f.telefono AS fisioterapeuta_telefono,
        -- f.email AS fisioterapeuta_email,
        -- f.fecha_nacimiento AS fisioterapeuta_fecha_nacimiento,
        -- f.direccion AS fisioterapeuta_direccion,
        -- f.provincia AS fisioterapeuta_provincia,
        -- f.municipio AS fisioterapeuta_municipio,
        -- f.cp AS fisioterapeuta_cp,
        -- f.genero AS fisioterapeuta_genero,
        -- f.sesiones_disponibles AS fisioterapeuta_sesiones_disponibles
        FROM
            citas c
        INNER JOIN
            usuarios p ON c.paciente_id = p.usuario_id
        INNER JOIN
            usuarios f ON c.fisioterapeuta_id = f.usuario_id
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

    public function obtenerCitasUsuario($DNI, $iniciar, $articulos_x_pagina)
    {
        $DNI = self::$conexion->real_escape_string($DNI);

        $sql = "SELECT
        c.cita_id,
        c.fecha_hora,
        c.estado,
        p.usuario_id AS paciente_id,
        p.nombre AS paciente_nombre,
        p.apellidos AS paciente_apellidos,
        p.telefono AS paciente_telefono,
        -- p.email AS paciente_email,
        -- p.fecha_nacimiento AS paciente_fecha_nacimiento,
        -- p.direccion AS paciente_direccion,
        -- p.provincia AS paciente_provincia,
        -- p.municipio AS paciente_municipio,
        -- p.cp AS paciente_cp,
        -- p.genero AS paciente_genero,
        p.sesiones_disponibles AS paciente_sesiones_disponibles,
        f.usuario_id AS fisioterapeuta_id,
        f.nombre AS fisioterapeuta_nombre,
        f.apellidos AS fisioterapeuta_apellidos
        -- f.telefono AS fisioterapeuta_telefono,
        -- f.email AS fisioterapeuta_email,
        -- f.fecha_nacimiento AS fisioterapeuta_fecha_nacimiento,
        -- f.direccion AS fisioterapeuta_direccion,
        -- f.provincia AS fisioterapeuta_provincia,
        -- f.municipio AS fisioterapeuta_municipio,
        -- f.cp AS fisioterapeuta_cp,
        -- f.genero AS fisioterapeuta_genero,
        -- f.sesiones_disponibles AS fisioterapeuta_sesiones_disponibles
        FROM
            citas c
        INNER JOIN
            usuarios p ON c.paciente_id = p.usuario_id
        INNER JOIN
            usuarios f ON c.fisioterapeuta_id = f.usuario_id
        WHERE
            paciente_id = '$DNI'
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
}
