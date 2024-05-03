<?php
require_once '../models/SpecialityModel.php';
require '../assets/fpdf186/fpdf.php';

class SpecialityController
{
    private $specialityModel;

    public function __construct()
    {
        $this->specialityModel = new SpecialityModel();
    }

    public function obtenerEspecialidadesPaginadas($iniciar, $articulos_x_pagina)
    {
        return $this->specialityModel->obtenerEspecialidadesPaginadas($iniciar, $articulos_x_pagina);
    }

    public function obtenerEspecialiades()
    {
        return $this->specialityModel->read('especialidades');
    }

    // public function obtenerUsuariosPorID($usuario_id)
    // {
    //     $usuarioBuscado = $this->specialityModel->obtenerEspecialidadesPorID($usuario_id);

    //     if ($usuarioBuscado) {
    //         return $usuarioBuscado;
    //     } else {
    //         $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha encontrado ningún usuario con los criterios seleccionados.');
    //         header('Location: ../pages/speciality.php');
    //         exit();
    //     }
    // }

    public function añadirEspecialidad($datos)
    {
        if ($this->specialityModel->insert('especialidades', $datos)) {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Especialidad añadida correctamente.');
            header('Location: ../pages/speciality.php');
            exit();
        } else {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido añadir la especialidad.');
            header('Location: ../pages/speciality.php');
            exit();
        }
    }


    public function editarEspecialidad($datos, $condicion)
    {
        if ($this->specialityModel->update('especialidades', $datos, $condicion)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Datos de la especialidad actualizados correctamente.');
            header('Location: ../pages/speciality.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido actualizar los datos de la especialidad.');
            header('Location: ../pages/speciality.php');
            exit();
        }
    }


    public function eliminarEspecialidad($datos)
    {
        if ($this->specialityModel->delete('especialidades', $datos)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Usuario eliminado correctamente.');
            header('Location: ../pages/speciality.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'No se ha podido eliminar el usuario correctamente.');
            header('Location: ../pages/speciality.php');
            exit();
        }
    }

    public function actualizarDatos($datos, $condicion)
    {
        if ($this->specialityModel->update('especialidades', $datos, $condicion) == true) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Datos actualizados correctamente.');
            header('Location: ../pages/settings.php');
            exit();
        } else {
            echo "No se ha podido completar el registro";
        }
    }


}
