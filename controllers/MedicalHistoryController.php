<?php
require_once '../models/MedicalHistoryModel.php';
require_once '../assets/fpdf186/fpdf.php';


class MedicalHistoryController extends FPDF{

    function generarInformeMedico($usuario_id) {
        // Crear instancia de FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Encabezado del informe
        $pdf->Cell(0, 10, 'Informe Médico', 0, 1, 'C');
        $pdf->Ln(10);

        // Obtener datos del usuario y su historial médico
        $row = $result->fetch_assoc();
        $nombreCompleto = $row["nombre"] . " " . $row["apellidos"];
        $fechaNacimiento = $row["fecha_nacimiento"];
        $genero = $row["genero"];
        $fechaConsulta = $row["fecha"];
        $descripcion = $row["descripcion"];
        $diagnostico = $row["diagnostico"];
        $tratamiento = $row["tratamiento"];
        $notas = $row["notas"];

        // Escribir información en el PDF
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Paciente: ' . $nombreCompleto, 0, 1);
        $pdf->Cell(0, 10, 'Fecha de nacimiento: ' . $fechaNacimiento, 0, 1);
        $pdf->Cell(0, 10, 'Género: ' . $genero, 0, 1);
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Fecha de la consulta: ' . $fechaConsulta, 0, 1);
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Descripción: ' . $descripcion, 0, 1);
        $pdf->Ln();
        $pdf->Cell(0, 10, 'Diagnóstico: ' . $diagnostico, 0, 1);
        $pdf->Ln();
        $pdf->Cell(0, 10, 'Tratamiento: ' . $tratamiento, 0, 1);
        $pdf->Ln();
        $pdf->Cell(0, 10, 'Notas: ' . $notas, 0, 1);

        // Salida del PDF
        $pdf->Output();
    }

    function actualizarInformeMedico(){}
}



?>
