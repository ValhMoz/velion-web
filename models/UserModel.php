<?php

require 'BaseModel.php';

class UserModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function obtenerUsuariosPaginados($iniciar, $articulos_x_pagina)
    {
        // Buscar el usuario en la base de datos
        $sql = "SELECT * FROM usuarios LIMIT $iniciar, $articulos_x_pagina";

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

    public function obtenerUsuariosPorID($usuario_id)
    {
        $sql = "SELECT * FROM `usuarios` WHERE usuario_id = ?";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("s", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $usuarios;
    }

    public function obtenerUsuariosPorRol($rol)
    {
        $sql = "SELECT * FROM `usuarios` WHERE rol = ?";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("s", $rol);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $usuarios;
    }

    public function buscarUsuariosPorIDyRol($usuario_id, $rol)
    {
        $sql = "SELECT * FROM `usuarios` WHERE usuario_id = ?, rol = ?";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("s", $usuario_id, $rol);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $usuarios;
    }

    public function actualizarUsuario($usuario_id, $datos)
    {
        $sql = "UPDATE `usuarios` SET nombre = ?, apellidos = ?, telefono = ?, fecha_nacimiento = ?, direccion = ?, provincia = ?, municipio = ?, cp = ?, email = ?, pass = ?, rol = ?, genero = ? WHERE usuario_id = ?";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bind_param("ssissssisssss", $datos['nombre'], $datos['apellidos'], $datos['telefono'], $datos['fecha_nacimiento'], $datos['direccion'], $datos['provincia'], $datos['municipio'], $datos['cp'], $datos['email'], $datos['pass'], $datos['rol'], $datos['genero'], $usuario_id);
        $result = $stmt->execute(); // Ejecutar la consulta UPDATE
        $stmt->close();
        return $result;
    }
}
