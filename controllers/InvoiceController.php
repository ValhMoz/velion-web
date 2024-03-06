<?php
require_once '../models/InvoiceModel.php';
require_once '../assets/fpdf186/fpdf.php';  //include FPDF library

class InvoiceController
{
    private $invoiceModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
    }

    public function generarFactura(){}
}

?>