<?php
require_once '../models/AppointmentModel.php';

class AppointmentController
{
    private $appointmentModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
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

      // Obtiene todos los fisioterapeutas por especialidad
      public function obtenerFisioterapeutasPorEspecialidad($especialidad_id)
      {
          return $this->appointmentModel->read('usuarios', 'rol = \'Fisioterapeuta\' AND especialidad = ' . $especialidad_id);
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

    public function asignarCitaPatients($tabla, $datos)
    {
        if ($this->appointmentModel->insert($tabla, $datos)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Cita añadida correctamente.');
            header('Location: ../pages/appointments-patients.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido añadir la cita correctamente.');
            header('Location: ../pages/appointments-patients.php');
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

    public function eliminarCitaPatient($tabla, $condicion)
    {
        if ($this->appointmentModel->delete($tabla, $condicion)) {
            $_SESSION['alert'] = array('type' => 'success', 'message' => 'Cita eliminada correctamente.');
            header('Location: ../pages/appointments-patients.php');
            exit();
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido eliminar la cita correctamente.');
            header('Location: ../pages/appointments-patients.php');
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
            return $citasFiltradas;
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
            return $citasFiltradas;
        } else {
            $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se han encontrado la citas con los criterios especificados.');
            header('Location: ../pages/appointments-patients.php');
            exit();
        }
    }

    public function obtenerHorasDisponibles($fisioterapeuta_id, $fecha)
    {
        $bookedSlots = $this->appointmentModel->getAvailableSlots($fisioterapeuta_id, $fecha);
        $allSlots = $this->generateTimeSlots($fecha);
        $availableSlots = array_diff($allSlots, $bookedSlots);
        return json_encode(array_values($availableSlots));
    }

    private function generateTimeSlots($date)
    {
        $start = new DateTime($date . ' 08:00');
        $end = new DateTime($date . ' 17:00');
        $interval = new DateInterval('PT60M');
        $slots = [];

        while ($start < $end) {
            $slots[] = $start->format('H:i');
            $start->add($interval);
        }

        return $slots;
    }

    // Método para manejar la solicitud de cita
    public function book()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paciente_id = $_POST['paciente_id'];
            $fisioterapeuta_id = $_POST['fisioterapeuta_id'];
            $fecha_hora = $_POST['fecha_hora'];

            $success = $this->appointmentModel->bookAppointment($paciente_id, $fisioterapeuta_id, $fecha_hora);
            if ($success) {
                $_SESSION['alert'] = array('type' => 'success', 'message' => 'Cita reservada exitosamente.');
                header('Location: ../pages/appointments.php');
                exit();
            } else {
                $_SESSION['alert'] = array('type' => 'warning', 'message' => 'No se ha podido reservar la cita.');
                header('Location: ../pages/appointments.php');
                exit();
            }
        }
    }

}

if (isset($_GET['action'])) {
    $controller = new AppointmentController();

    switch ($_GET['action']) {
        case 'obtenerEspecialidades':
            $especialidades = $controller->obtenerEspecialidades();
            echo json_encode($especialidades);
            break;

        case 'obtenerFisioterapeutasPorEspecialidad':
            $especialidad_id = $_GET['especialidad_id'];
            $fisioterapeutas = $controller->obtenerFisioterapeutasPorEspecialidad($especialidad_id);
            echo json_encode($fisioterapeutas);
            break;

        case 'obtenerHorasDisponibles':
            $fecha = $_GET['fecha'];
            $fisioterapeuta_id = $_GET['fisioterapeuta_id'];
            $horas = $controller->obtenerHorasDisponibles($fisioterapeuta_id, $fecha);
            echo json_encode($horas);
            break;
    }
}
?>
