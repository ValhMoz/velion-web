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

    public function obtenerUsuariosPorID($usuario_id)
    {
        $usuarioBuscado = $this->usuarioModel->obtenerUsuariosPorID($usuario_id);

        if ($usuarioBuscado) {
            return $usuarioBuscado;
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha encontrado ningún usuario con los criterios seleccionados.');
            header('Location: ../pages/users.php');
            exit();
        }
    }

    public function añadirNuevoUsuario($datos, $datos_historial)
    {
        if ($this->usuarioModel->insert('usuarios', $datos) && ($this->usuarioModel->insert('historial_medico', $datos_historial))) {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Usuario añadido correctamente.');
            header('Location: ../pages/users.php');
            exit();
        } else {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido añadir el usuario correctamente.');
            header('Location: ../pages/users.php');
            exit();
        }
    }


    public function editarUsuario($datos, $condicion)
    {
        if ($this->usuarioModel->update('usuarios', $datos, $condicion)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Datos de usuario actualizados correctamente.');
            header('Location: ../pages/users.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido actualizar los datos del usuario.');
            header('Location: ../pages/users.php');
            exit();
        }
    }


    public function eliminarUsuario($datos)
    {
        if ($this->usuarioModel->delete('usuarios', $datos)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Usuario eliminado correctamente.');
            header('Location: ../pages/users.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'No se ha podido eliminar el usuario correctamente.');
            header('Location: ../pages/users.php');
            exit();

        }

    }

    public function actualizarDatos($datos, $condicion)
    {
        if ($this->usuarioModel->update('usuarios', $datos, $condicion) == true) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Datos actualizados correctamente.');
            header('Location: ../pages/settings.php');
            exit();
        } else {
            echo "No se ha podido completar el registro";
        }
    }
}
