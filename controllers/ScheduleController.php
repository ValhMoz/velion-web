<?php
require_once '../models/ScheduleModel.php';
require '../assets/fpdf186/fpdf.php';

class ScheduleController
{
    private $scheduleModel;

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
    }

    public function obtenerHorariosPaginados($iniciar, $articulos_x_pagina)
    {
        return $this->scheduleModel->obtenerHorariosPaginados($iniciar, $articulos_x_pagina);
    }

    public function obtenerHorarios()
    {
        return $this->scheduleModel->read('horarios');
    }

    public function obtenerHorariosPorNombre($filtro_horario)
    {
        $horarioBuscado = $this->scheduleModel->obtenerHorariosPorNombre($filtro_horario);

        if ($horarioBuscado) {
            return $horarioBuscado;
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha encontrado ningún horario con los criterios seleccionados.');
            header('Location: ../pages/schedule.php');
            exit();
        }
    }

    public function añadirNuevoHorario($datos)
    {
        if ($this->scheduleModel->insert('horarios', $datos)) {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Horario añadido correctamente.');
            header('Location: ../pages/schedule.php');
            exit();
        } else {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido añadir el horario correctamente.');
            header('Location: ../pages/schedule.php');
            exit();
        }
    }


    public function editarHorario($datos, $condicion)
    {
        if ($this->scheduleModel->update('horarios', $datos, $condicion)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Datos de horario actualizados correctamente.');
            header('Location: ../pages/schedule.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido actualizar los datos del horario.');
            header('Location: ../pages/schedule.php');
            exit();
        }
    }


    public function eliminarHorario($datos)
    {
        if ($this->scheduleModel->delete('horarios', $datos)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Horario eliminado correctamente.');
            header('Location: ../pages/schedule.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'No se ha podido eliminar el horario correctamente.');
            header('Location: ../pages/schedule.php');
            exit();
        }
    }

    public function exportarDatos()
    {
        $horarios = $this->scheduleModel->read('horarios');
    
        // Instanciar un nuevo objeto FPDF
        $pdf = new FPDF(); // Orientación horizontal, unidad de medida en mm, tamaño de página A4
    
        // Agregar una nueva página al PDF
        $pdf->AddPage();

        // Definir el alias para el total de páginas
        // $pdf->AliasNbPages();
    
        // Definir el título del reporte
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 10, 'Reporte de Horarios', 1, 1, 'C');
    
        // Definir los encabezados de la tabla
        $pdf->SetFont('Arial', 'B', 8); // Cambiar el tamaño de la letra
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(27, 10, 'ID', 1, 0, 'C'); // Reducir la anchura de la celda
        $pdf->Cell(88, 10, iconv('UTF-8', 'windows-1252', 'Descripción'), 1, 0, 'C'); // Ajustar la anchura de la celda
        $pdf->Cell(30, 10, 'Estado', 1, 0, 'C'); // Ajustar la anchura de la celda
        $pdf->Cell(45, 10, iconv('UTF-8', 'windows-1252', 'Última modificación'), 1, 0, 'C'); // Ajustar la anchura de la celda
        $pdf->Ln(); // Salto de línea para la siguiente fila
    
        // Obtener los datos de los usuarios (ejemplo usando una consulta a BD)
        $horarios = $this->obtenerHorarios(); // Suponiendo que 'obtenerUsuarios' devuelve un array de usuarios
    
        // Recorrer los usuarios y mostrarlos en la tabla
        $pdf->SetFont('Arial', '', 8);
        foreach ($horarios as $horario) {
            $pdf->Cell(27, 10, $horario['id'], 1, 0, 'C');
            $pdf->Cell(88, 10, iconv('UTF-8', 'windows-1252', $horario['nombre']), 1, 0, 'L');
            $pdf->Cell(30, 10, $horario['estado'], 1, 0, 'C');
            $pdf->Cell(45, 10, $horario['ult_modificacion'], 1, 0, 'C');
            $pdf->Ln(); // Salto de línea para la siguiente fila
        }

        // Crear el footer en cada página
        // $pdf->SetFont('Arial', '', 8);
        // $pdf->SetY(-15); // Posicionamiento vertical del footer (1.5 cm desde el final)
        // $pdf->Cell(0, 10, 'Pagina ' . $pdf->PageNo() . 'de {nb}', 0, 0, 'C'); // Page No. and Total Pages
            
        // Generar el archivo PDF y descargarlo
        $pdf->Output('ReporteHorarios.pdf', 'D', true); // 'D' para descargar, 'F' para guardar en el servidor
    }
    
}
