<?php

require_once 'BaseModel.php';

class AppointmentModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerDatosCitasHoy()
    {
        // Obtener la fecha actual
        $fecha_actual = date('Y-m-d');

        // Consulta SQL para obtener las citas de hoy de los pacientes con detalles adicionales
        $sql = "SELECT citas.cita_id, pacientes.nombre AS nombre_paciente, fisioterapeutas.nombre AS nombre_fisioterapeuta, citas.fecha_hora
                FROM citas
                INNER JOIN usuarios AS pacientes ON citas.paciente_id = pacientes.usuario_id
                INNER JOIN usuarios AS fisioterapeutas ON citas.fisioterapeuta_id = fisioterapeutas.usuario_id
                WHERE pacientes.rol = 'paciente'
                AND DATE(citas.fecha_hora) = $fecha_actual";

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
