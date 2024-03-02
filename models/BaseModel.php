<?php

class BaseModel
{
    private static $conexion = null;

    public function __construct()
    {
        // Verifica si ya hay una conexión establecida
        if (self::$conexion === null) {
            // Configura la conexión a la base de datos
            $host = 'localhost';
            $usuario = 'root';
            $contrasena = '';
            $base_de_datos = 'project-crm';

            // Intenta establecer la conexión
            self::$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

            // Manejo de errores
            if (self::$conexion->connect_error) {
                die("Error al conectar con la base de datos: " . self::$conexion->connect_error);
            }
        }
    }

    public function insertar($tabla, $datos)
    {
        // Prepara la consulta
        $campos = implode(', ', array_map(function ($campo) {
            return "`$campo`";
        }, array_keys($datos)));
        $valores = implode(', ', array_map(function ($valor) {
            return "'" . self::$conexion->real_escape_string($valor) . "'";
        }, array_values($datos)));
        $sql = "INSERT INTO `$tabla` ($campos) VALUES ($valores)";

        // Ejecuta la consulta
        return $this->ejecutarConsulta($sql);
    }

    public function modificar($tabla, $datos, $condicion)
    {
        // Prepara la consulta
        $actualizaciones = implode(', ', array_map(function ($campo, $valor) {
            return "`$campo` = '" . self::$conexion->real_escape_string($valor) . "'";
        }, array_keys($datos), array_values($datos)));
        $sql = "UPDATE `$tabla` SET $actualizaciones WHERE $condicion";

        // Ejecuta la consulta
        return $this->ejecutarConsulta($sql);
    }

    public function eliminar($tabla, $condicion)
    {
        // Prepara la consulta
        $sql = "DELETE FROM `$tabla` WHERE $condicion";

        // Ejecuta la consulta
        return $this->ejecutarConsulta($sql);
    }

    public function leer($tabla, $condicion = '')
    {
        // Prepara la consulta
        $sql = "SELECT * FROM `$tabla`";
        if ($condicion !== '') {
            $sql .= " WHERE $condicion";
        }

        // Ejecuta la consulta
        $resultado = self::$conexion->query($sql);

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

    private function ejecutarConsulta($sql)
    {
        // Ejecuta la consulta
        if (self::$conexion->query($sql) === TRUE) {
            return true;
        } else {
            die("Error al ejecutar la consulta: " . self::$conexion->error);
        }
    }

    public function __destruct()
    {
        // No cerramos la conexión aquí para permitir conexiones persistentes
    }
}
