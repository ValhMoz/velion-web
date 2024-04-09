<?php
require_once '../models/UserModel.php';

class UserController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UserModel();
    }

    public function obtenerUsuariosPaginados($iniciar, $articulos_x_pagina)
    {
        return $this->usuarioModel->obtenerUsuariosPaginados($iniciar, $articulos_x_pagina);
    }

    public function obtenerUsuarios()
    {
        return $this->usuarioModel->read('usuarios');
    }

    public function obtenerUsuariosPorID($usuario_id) {
        
        return $this->usuarioModel->obtenerUsuariosPorID($usuario_id);
    }
    


    // public function obtenerUsuarioID($id)
    // {
    //     return $this->usuarioModel->read('usuarios');
    // }

    public function añadirNuevoUsuario($datos, $datos_historial)
    {
        if ($this->usuarioModel->insert('usuarios', $datos) == true && ($this->usuarioModel->insert('historial_medico', $datos_historial)) == true) {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            header('Location: ../pages/dashboard.php?page=users');
            exit();
        } else {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            header('Location: ../pages/dashboard.php?page=users');
            exit();
        }
    }

    public function editarUsuario($datos){

    }

    public function eliminarUsuario($datos){

    }

    public function actualizarDatos($datos, $DNI)
    {
        if ($this->usuarioModel->update('usuarios', $datos, $DNI) == true) {
            exit();
        } else {
            echo "No se ha podido completar el registro";
        }
    }

}
