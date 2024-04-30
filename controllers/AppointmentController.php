<?php

require_once '../models/AppointmentModel.php';

class AppointmentController
{
    private $appointmentModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
    }

    public function obtenerCitasPaginadas($iniciar, $articulos_x_pagina){
        return $this->appointmentModel->obtenerCitasPaginadas($iniciar, $articulos_x_pagina);
    }

    public function obtenerCitas(){
        return $this->appointmentModel->read('citas');
    }

    // public function obtenerCitasHoy() {
    //     return $this->appointmentModel->obtenerCitasHoy();
    // }

    public function obtenerCitasUsuario($DNI, $iniciar, $articulos_x_pagina) {
        return $this->appointmentModel->obtenerCitasUsuario($DNI, $iniciar, $articulos_x_pagina);
    }

    public function obtenerListaPacientes() {
        return $this->appointmentModel->read('usuarios', 'rol = \'paciente\'');
    }

    public function obtenerListaFisioterapeutas() {
        return $this->appointmentModel->read('usuarios', 'rol = \'fisioterapeuta\'');
    }

}

?>