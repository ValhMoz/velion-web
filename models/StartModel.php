<?php

require 'BaseModel.php';

class StartModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerUltimosUsuarios($limite = 5)
    {
        // Prepara la consulta para obtener los últimos 5 usuarios ordenados por fecha de creación
        $sql = "SELECT * FROM usuarios ORDER BY usuario_id DESC LIMIT ?";
        
        // Prepara y ejecuta la consulta
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("i", $limite);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Obtiene los resultados
        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }

        // Libera el statement y cierra la conexión
        $stmt->close();
        
        return $usuarios;
    }


}
