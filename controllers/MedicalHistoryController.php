<?php
require_once '../models/MedicalHistoryModel.php';
require_once '../assets/fpdf186/fpdf.php';


class MedicalHistoryController extends FPDF
{

    private $medicalhistoryModel;

    public function __construct()
    {
        $this->medicalhistoryModel = new MedicalHistoryModel();
    }

    function generarInformeMedico()
    {
        // Crear una instancia de FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Configurar fuente y tamaño
        $pdf->SetFont('Arial', 'B', 16);

        // Título del informe
        $pdf->Cell(0, 10, 'Informe Medico', 0, 1, 'C');

        // Datos del paciente, facultativo, diagnóstico, tratamiento y observaciones
        $nombre_paciente = "Juan Pérez";
        $fecha_nacimiento = "01/01/1980";
        $genero = "Masculino";
        $nombre_facultativo = "Dr. María García";
        $especialidad = "Fisioterapeuta";
        $diagnostico = "Fractura de muñeca.";
        $tratamiento = "Reposo y rehabilitación.";
        $observaciones = "El paciente debe acudir a consulta de seguimiento en 2 semanas.";

        // Generar los recuadros con la información
        $pdf->SetFillColor(230, 230, 230);

        // Recuadro para los datos del paciente
        $pdf->Rect(10, 20, 90, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Datos del Paciente', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, 25);
        $pdf->Cell(0, 10, 'Nombre: ' . $nombre_paciente, 0, 1, 'L');
        $pdf->SetXY(10, 30);
        $pdf->Cell(0, 10, 'Fecha de Nacimiento: ' . $fecha_nacimiento, 0, 1, 'L');
        $pdf->SetXY(10, 35);
        $pdf->Cell(0, 10, 'Género: ' . $genero, 0, 1, 'L');

        // Recuadro para los datos del facultativo
        $pdf->Rect(110, 20, 90, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(110, 20);
        $pdf->Cell(0, 10, 'Datos del Facultativo', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(110, 25);
        $pdf->Cell(0, 10, 'Nombre: ' . $nombre_facultativo, 0, 1, 'L');
        $pdf->SetXY(110, 30);
        $pdf->Cell(0, 10, 'Especialidad: ' . $especialidad, 0, 1, 'L');

        // Recuadro para el diagnóstico
        $pdf->Rect(10, 70, 190, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(9, 60);
        $pdf->Cell(0, 10, 'Diagnóstico Médico', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(15, 75);
        $pdf->MultiCell(0, 10, $diagnostico);

        // Recuadro para el tratamiento
        $pdf->Rect(10, 120, 190, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(9, 110);
        $pdf->Cell(0, 10, 'Tratamiento', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(15, 125);
        $pdf->MultiCell(0, 10, $tratamiento);

        // Recuadro para las observaciones
        $pdf->Rect(10, 170, 190, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(9, 160);
        $pdf->Cell(0, 10, 'Observaciones', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(15, 175);
        $pdf->MultiCell(0, 10, $observaciones);

        // Salida del PDF
        $pdf->Output();
    }

    function actualizarInformeMedico($datos)
    {
        $this->medicalhistoryModel->update('historial_medico', $datos, $datos[0]['usuario_id']);
    }

    function obtenerInformes()
    {
        return ($this->medicalhistoryModel->read('historial_medico'));
    }
}
