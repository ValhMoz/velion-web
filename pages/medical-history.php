<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/MedicalHistoryController.php';

if ($rol == "Paciente") {
    header("Location: 404.php");
    exit();
}

$medicalhistory = new MedicalHistoryController();

// Manejar la búsqueda del historial médico
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $informe = $medicalhistory->obtenerInformeUsuario($user_id);
}

$pacientes = $medicalhistory->obtenerListaPacientes();

include_once './includes/dashboard.php';
?>

<div class="container mt-5">

    <?php
    // Verificar si hay una alerta de usuario
    if (isset($_SESSION['alert'])) {
        $alert_type = $_SESSION['alert']['type'];
        $alert_message = $_SESSION['alert']['message'];
        // Mostrar la alerta
        echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show" role="alert">' . $alert_message . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        // Eliminar la variable de sesión después de mostrar la alerta
        unset($_SESSION['alert']);
    }
    ?>

    <div class="d-flex align-items-start justify-content-between">
        <h1 class="mb-4">Historial Médico</h1>
        <?php if (isset($informe)) : ?>
            <form action="../scripts/medicalhistory_manager.php" method="GET">
                <input type="hidden" name="id" value="<?php echo $informe[0]['historial_id']; ?>">
                <button type="submit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                        <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                    </svg>
                    Generar Reporte</button>
            </form>
        <?php endif; ?>
    </div>

    <!-- Formulario para buscar el historial médico -->
    <form class="form input mb-3" action="" method="post">
        <input class="form-control" list="datalistOptions" id="user_id" name="user_id" placeholder="Escribe aquí para buscar...">
        <datalist id="datalistOptions">
            <?php foreach ($pacientes as $paciente) : ?>
                <option value="<?php echo $paciente['usuario_id']; ?>"><?php echo $paciente['nombre'] . ' ' . $paciente['apellidos']; ?></option>
            <?php endforeach; ?>
        </datalist>
        <!-- <button type="submit" class="btn btn-primary">Buscar</button> -->
    </form>

    <?php if (isset($informe)) : ?>
        <!-- Información del informe -->
        <div class="card mb-4">
            <div class="card-header">
                Información del informe
            </div>
            <div class="card-body" id="informeSeleccionado">
                <h5 class="card-title">Nombre del paciente: <?php echo $informe[0]['nombre_paciente'] . ' ' . $informe[0]['apellidos_paciente']; ?></h5>
                <p class="card-text">Fecha de nacimiento: <?php echo $informe[0]['fecha_nacimiento_paciente']; ?> años</p>
                <p class="card-text">Género: <?php echo $informe[0]['genero_paciente']; ?></p>
                <p class="card-text">Dirección: <?php echo $informe[0]['direccion_paciente']  . " " . $informe[0]['provincia_paciente'] . " " . $informe[0]['cp_paciente']; ?></p>
                <!-- <p class="card-text">Teléfono: <?php echo $informe[0]['telefono_paciente']; ?></p> -->
            </div>
        </div>


        <!-- Historial Médico -->
        <div class="card mb-4">
            <div class="card-header">
                Historial Médico
            </div>
            <div class="card-body">
                <h5 class="card-title">Fecha del informe: <?php echo $informe[0]['fecha']; ?></h5>
                <p class="card-text">Diagnóstico: <?php echo $informe[0]['diagnostico']; ?></p>
                <p class="card-text">Tratamiento: <?php echo $informe[0]['tratamiento']; ?></p>
                <p class="card-text">Notas Adicionales: <?php echo $informe[0]['notas']; ?></p>

            </div>
        </div>

        <!-- Formulario para modificar datos médicos -->
        <div class="card">
            <div class="card-header">
                Modificar Datos Médicos
            </div>
            <div class="card-body">
                <form action="../scripts/medicalhistory_manager.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $informe[0]['historial_id']; ?>">
                    <div class="mb-3">
                        <label for="diagnostico" class="form-label">Nuevo Diagnóstico</label>
                        <textarea class="form-control" name="diagnostico" id="diagnostico" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tratamiento" class="form-label">Nuevo Tratamiento</label>
                        <textarea class="form-control" name="tratamiento" id="tratamiento" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notas" class="form-label">Nuevas Notas Adicionales</label>
                        <textarea class="form-control" name="notas" id="notas" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

</div>

</main>

</body>

</html>