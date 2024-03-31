<?php
require_once '../models/UserModel.php';

class UserController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UserModel();
    }

    public function obtenerUsuarios()
    {
        return $this->usuarioModel->read('usuarios');
    }

    public function obtenerUsuarioID($id)
    {
        return $this->usuarioModel->read('usuarios');
    }

    // public function registrarUsuario($datos)
    // {
    //     if ($this->usuarioModel->insert('usuarios', $datos) == true) {
    //         header('Location: ../index.php');
    //         exit();
    //     } else {
    //         echo "No se ha podido completar el registro";
    //     }
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

    public function actualizarDatos($datos)
    {
        echo ($_SESSION['usuario_id']);
        if ($this->usuarioModel->update('usuarios', $datos, $_SESSION['usuario_id']) == true) {
            exit();
        } else {
            echo "No se ha podido completar el registro";
        }
    }

}
