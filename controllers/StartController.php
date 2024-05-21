<?php
require_once '../models/StartModel.php';
require '../assets/fpdf186/fpdf.php';

class StartController
{
    private $startModel;

    public function __construct()
    {
        $this->startModel = new StartModel();
    }

    public function obtenerUltimosUsuarios() {
        return  $this->startModel->obtenerUltimosUsuarios();

    }

}
