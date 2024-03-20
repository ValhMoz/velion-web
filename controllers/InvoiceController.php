<?php

require_once '../models/InvoiceModel.php';
require_once '../assets/fpdf186/fpdf.php';

class InvoiceController extends FPDF
{
    private $invoiceModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
    }

    public function obtenerFacturas()
    {
        $facturas =$this->invoiceModel->obtenerDatosFacturas();
        // include '../pages/patients-module/invoices.php';
        return $facturas;
    }

    // Función para generar la factura PDF
    function generarFacturaPDF($factura_id)
    {
        $factura = $this->invoiceModel->read('facturas', "id = $factura_id");
        // var_dump(json_encode($factura));

        // Verificar si se encontró la factura
        if ($factura) {
            // Crear instancia de FPDF
            $pdf = new FPDF();
            $pdf->AddPage();

            // Encabezado
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Factura #' . $factura_id, 0, 1, 'C');
            $pdf->Ln(10);

            // Datos del paciente
            if ($datosPaciente) {
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(0, 10, 'Nombre: ' . $datosPaciente['nombre'] . ' ' . $datosPaciente['apellidos'], 0, 1);
                $pdf->Cell(0, 10, 'Dirección: ' . $datosPaciente['direccion'], 0, 1);
                $pdf->Cell(0, 10, 'provincia: ' . $datosPaciente['provincia'], 0, 1);
                $pdf->Cell(0, 10, 'Municipio: ' . $datosPaciente['municipio'], 0, 1);
                $pdf->Cell(0, 10, 'Código Postal: ' . $datosPaciente['cp'], 0, 1);
                $pdf->Cell(0, 10, 'Correo Electrónico: ' . $datosPaciente['email'], 0, 1);
            } else {
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(0, 10, 'No se encontraron datos del paciente.', 0, 1);
            }

            // Otros detalles de la factura
            $pdf->Cell(0, 10, 'Fecha de emisión: ' . $fecha_emision, 0, 1);
            $pdf->Cell(0, 10, 'Monto: $' . $monto, 0, 1);
            $pdf->Cell(0, 10, 'Estado: ' . $estado, 0, 1);

            // Pie de página
            $pdf->SetY(-15);
            $pdf->SetFont('Arial', 'I', 8);
            $pdf->Cell(0, 10, '¡Gracias por su compra!', 0, 0, 'C');

            // Salida del PDF
            $pdf->Output('I', 'Factura_' . $factura_id . '.pdf');
            return $factura;
        } else {
            return false; // La factura no existe
        }
    }

    public function guardarFactura($datos)
    {
        $this->invoiceModel->insert("facturas", $datos);
    }
}
