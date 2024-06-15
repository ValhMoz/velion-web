<?php

require_once 'BaseModel.php';

class LoginModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerEmail($email)
    {
        // Preparar la consulta para evitar inyecciones SQL
        $stmt = self::$conexion->prepare("SELECT email FROM usuarios WHERE email = ?");
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . self::$conexion->error);
        }

        // Enlazar el parámetro
        $stmt->bind_param('s', $email);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();

        // Procesar el resultado
        $datos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        // Cerrar la declaración
        $stmt->close();

        return $datos;
    }
}

?>
