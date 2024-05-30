<?php

require_once '../models/AppointmentModel.php';
require_once '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta para tu configuración

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class AppointmentController
{
    private $appointmentModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
    }

    public function verificarYEjecutar() {
        $ultimaEjecucion = $this->appointmentModel->obtenerUltimaEjecucion();
        $hoy = date('Y-m-d');

        if ($ultimaEjecucion !== $hoy) {
            $this->enviarRecordatorios();
            $this->appointmentModel->actualizarUltimaEjecucion($hoy);
        }
    }

    public function enviarRecordatorios()
    {
        $citasProximas = $this->appointmentModel->obtenerCitasProximas();
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor de correo
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sergiofrubio@gmail.com';
            $mail->Password = 'wcgs pxws wttd aeco';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del remitente
            $mail->setFrom('sergiofrubio@gmail.com', 'SIGEFI');

            foreach ($citasProximas as $cita) {
                // Configuración del destinatario
                $mail->addAddress($cita['paciente_email'], $cita['paciente_nombre'] . ' ' . $cita['paciente_apellidos']);

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Recordatorio de Cita';
                $mail->Body = 'Estimado/a ' . $cita['paciente_nombre'] . ' ' . $cita['paciente_apellidos'] . ',<br><br>'
                    . 'Le recordamos que tiene una cita programada con ' . $cita['fisioterapeuta_nombre'] . ' ' . $cita['fisioterapeuta_apellidos'] . ' el día ' . date('d-m-Y H:i', strtotime($cita['fecha_hora'])) . '.<br><br>'
                    . 'Saludos,<br>'
                    . 'Su Clínica';

                $mail->send();
                $mail->clearAddresses(); // Limpia los destinatarios para el próximo ciclo
            }

            echo "Los recordatorios de citas se han enviado correctamente.";
        } catch (Exception $e) {
            echo "No se pudieron enviar los recordatorios. Error: {$mail->ErrorInfo}";
        }
    }

    public function obtenerCitasPaginadas($iniciar, $articulos_x_pagina)
    {
        return $this->appointmentModel->obtenerCitasPaginadas($iniciar, $articulos_x_pagina);
    }

    public function obtenerCitas()
    {
        return $this->appointmentModel->read('citas');
    }

    public function obtenerCitasUsuarioPaginadas($DNI, $iniciar, $articulos_x_pagina)
    {
        return $this->appointmentModel->obtenerCitasUsuarioPaginadas($DNI, $iniciar, $articulos_x_pagina);
    }

    public function obtenerCitasUsuario($DNI)
    {
        return $this->appointmentModel->obtenerCitasUsuario($DNI);
    }

    public function obtenerListaPacientes()
    {
        return $this->appointmentModel->read('usuarios', 'rol = \'Paciente\'');
    }

    public function obtenerListaFisioterapeutas()
    {
        return $this->appointmentModel->read('usuarios', 'rol = \'Fisioterapeuta\'');
    }

    public function obtenerEspecialidades()
    {
        return $this->appointmentModel->read('especialidades');
    }

    public function asignarCita($tabla, $datos)
    {
        if ($this->appointmentModel->insert($tabla, $datos)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Cita añadida correctamente.');
            header('Location: ../pages/appointments.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido añadir la cita correctamente.');
            header('Location: ../pages/appointments.php');
            exit();
        }
    }

    public function editarCita($tabla, $datos, $condicion)
    {
        if ($this->appointmentModel->update($tabla, $datos, $condicion)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Cita actualizada correctamente.');
            header('Location: ../pages/appointments.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido actualizar la cita correctamente.');
            header('Location: ../pages/appointments.php');
            exit();
        }
    }

    public function eliminarCita($tabla, $condicion)
    {
        if ($this->appointmentModel->delete($tabla, $condicion)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Cita eliminada correctamente.');
            header('Location: ../pages/appointments.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido eliminar la cita correctamente.');
            header('Location: ../pages/appointments.php');
            exit();
        }
    }

    public function confirmarCita($tabla, $datos, $condicion)
    {
        if ($this->appointmentModel->update($tabla, $datos, $condicion)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Cita eliminada correctamente.');
            header('Location: ../pages/appointments.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido eliminar la cita correctamente.');
            header('Location: ../pages/appointments.php');
            exit();
        }
    }

    public function buscarCitas($filtro_usuario_id, $filtro_fecha_hora, $filtro_estado, $filtro_especialidad)
    {

        $citasFiltradas = $this->appointmentModel->buscarCitas($filtro_usuario_id, $filtro_fecha_hora, $filtro_estado, $filtro_especialidad);
        if (!empty($citasFiltradas)) {
            header('Location: ../pages/appointments.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se han encontrado citas con los criterios especificados.');
            header('Location: ../pages/appointments.php');
            exit();
        }
    }

    public function buscarCitasPatients($filtro_usuario_id, $filtro_fecha_hora, $filtro_estado, $filtro_especialidad)
    {

        $citasFiltradas = $this->appointmentModel->buscarCitas($filtro_usuario_id, $filtro_fecha_hora, $filtro_estado, $filtro_especialidad);
        if (!empty($citasFiltradas)) {
            header('Location: ../pages/appointments-patients.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se han encontrado la citas con los criterios especificados.');
            header('Location: ../pages/appointments-patients.php');
            exit();
        }
    }

}
