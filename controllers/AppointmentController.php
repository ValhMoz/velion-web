<?php

require_once '../models/AppointmentModel.php';

class AppointmentController
{
    private $appointmentModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
    }

    public function obtenerCitas(){
        return $this->appointmentModel->read('citas');
    }

    public function obtenerCitasHoy() {
        return $this->appointmentModel->obtenerDatosCitasHoy();
    }

    public function obtenerCitasUsuario($DNI) {
        return $this->appointmentModel->read("citas", 'paciente_id', $DNI);
    }

}

?>