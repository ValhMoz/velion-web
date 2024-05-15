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

    public function generarInformeMedico($paciente_id)
    {
        $informe = $this->medicalhistoryModel->obtenerInforme($paciente_id);
        // Crear una instancia de FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Configurar fuente y tamaño
        $pdf->SetFont('Arial', 'B', 16);

        // Título del informe
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Informe Médico'), 0, 1, 'C');

        // Datos del paciente, facultativo, diagnóstico, tratamiento y observaciones
        $nombre_paciente = $informe[0]['nombre_paciente'] . ' ' . $informe[0]['apellidos_paciente'];
        $fecha_nacimiento = $informe[0]['fecha'];
        $genero = $informe[0]['genero_paciente'];
        $nombre_facultativo = $informe[0]['nombre_fisioterapeuta'] . ' ' . $informe[0]['apellidos_fisioterapeuta'];
        $especialidad = "Fisioterapeuta";
        $diagnostico = $informe[0]['diagnostico'];
        $tratamiento = $informe[0]['tratamiento'];
        $observaciones = $informe[0]['notas'];

        // Generar los recuadros con la información
        $pdf->SetFillColor(230, 230, 230);

        // Recuadro para los datos del paciente
        $pdf->Rect(10, 20, 90, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Datos del Paciente'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, 25);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Nombre: ') . iconv('UTF-8', 'windows-1252', $nombre_paciente), 0, 1, 'L');
        $pdf->SetXY(10, 30);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Fecha de Nacimiento: ') . iconv('UTF-8', 'windows-1252', $fecha_nacimiento), 0, 1, 'L');
        $pdf->SetXY(10, 35);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Género: ') . iconv('UTF-8', 'windows-1252', $genero), 0, 1, 'L');

        // Recuadro para los datos del facultativo
        $pdf->Rect(110, 20, 90, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(110, 20);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Datos del Facultativo'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(110, 25);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Nombre: ') . iconv('UTF-8', 'windows-1252', $nombre_facultativo), 0, 1, 'L');
        $pdf->SetXY(110, 30);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Especialidad: ') . iconv('UTF-8', 'windows-1252', $especialidad), 0, 1, 'L');

        // Recuadro para el diagnóstico
        $pdf->Rect(10, 70, 190, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(9, 60);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Diagnóstico Médico'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(15, 75);
        $pdf->MultiCell(0, 10, iconv('UTF-8', 'windows-1252', $diagnostico));

        // Recuadro para el tratamiento
        $pdf->Rect(10, 120, 190, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(9, 110);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Tratamiento'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(15, 125);
        $pdf->MultiCell(0, 10, iconv('UTF-8', 'windows-1252', $tratamiento));

        // Recuadro para las observaciones
        $pdf->Rect(10, 170, 190, 30, 'DF');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(9, 160);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Observaciones'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(15, 175);
        $pdf->MultiCell(0, 10, iconv('UTF-8', 'windows-1252', $observaciones));

        // Salida del PDF
        $pdf->Output('', '', true);
    }

    public function actualizarInformeMedico($datos, $condicion)
    {
        if ($this->medicalhistoryModel->update('historial_medico', $datos, $condicion)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Informe médico actualizado correctamente.');
            header("Location: ../pages/medical-history.php");
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido actualizar el informe médico.');
            header("Location: ../pages/medical-history.php");
            exit();
        }
    }

    public function obtenerInformeUsuario($DNI)
    {
        if (!$this->medicalhistoryModel->obtenerInforme($DNI)) {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha encontrado ningún informe médico para el usuario seleccionado.');
            header("Location: ../pages/medical-history.php");
            exit();
        }
        return ($this->medicalhistoryModel->obtenerInforme($DNI));
    }

    public function obtenerCitasUsuario($usuario_id)
    {
        $condicion = "paciente_id = '$usuario_id' OR fisioterapeuta_id = '$usuario_id'";
        $tabla = "citas";

        // Realiza la consulta utilizando la función read() del BaseModel
        $citas = $this->medicalhistoryModel->read($tabla, $condicion);

        return $citas;
    }

    public function obtenerInforme($DNI){
        return $this->medicalhistoryModel->obtenerInforme($DNI);
    }

    public function obtenerListaPacientes() {
        return $this->medicalhistoryModel->read('usuarios', 'rol = \'paciente\'');
    }
}
