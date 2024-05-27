<?php

require_once 'BaseModel.php';

class AppointmentModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function buscarCitas($usuarioID, $fechaHora, $estado, $especialidad)
    {
        $sql = "SELECT c.*, u.nombre AS paciente_nombre, u.apellidos AS paciente_apellidos, u.telefono AS paciente_telefono, u2.nombre AS fisioterapeuta_nombre, u2.apellidos AS fisioterapeuta_apellidos, e.descripcion AS descripcion
        FROM citas c
        INNER JOIN usuarios u ON c.paciente_id = u.usuario_id
        INNER JOIN usuarios u2 ON c.fisioterapeuta_id = u2.usuario_id
        INNER JOIN especialidades e ON c.especialidad_id = e.especialidad_id";
        $params = [];
        $types = "";
    
        if (!empty($usuarioID)) {
            $sql .= " AND paciente_id = ?";
            $params[] = $usuarioID;
            $types .= "s";
        }

        if (!empty($fechaHora)) {
            $sql .= " AND DATE(c.fecha_hora) = ?";
            $params[] = $fechaHora;
            $types .= "s";
        }
    
        if (!empty($estado)) {
            $sql .= " AND estado = ?";
            $params[] = $estado;
            $types .= "s";
        }

        if (!empty($especialidad)) {
            $sql .= " AND c.especialidad_id = ?";
            $params[] = $especialidad;
            $types .= "s";
        }
    
        $stmt = self::$conexion->prepare($sql);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $citas = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $citas;
    }

    public function obtenerCitasPaginadas($iniciar, $articulos_x_pagina)
    {
        $sql = "SELECT
        c.cita_id,
        c.fecha_hora,
        c.estado,
        c.especialidad_id,
        e.descripcion,
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
        INNER JOIN
            especialidades e ON c.especialidad_id = e.especialidad_id
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
        e.descripcion,
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
        INNER JOIN
            especialidades e ON c.especialidad_id = e.especialidad_id
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
