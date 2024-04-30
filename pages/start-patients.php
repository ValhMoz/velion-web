<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/MedicalHistoryController.php';
require_once '../controllers/AppointmentController.php';

$medHist = new MedicalHistoryController();
$app = new AppointmentController();

if ($rol == "administrador" ||  $rol == "fisioterapeuta") {
    header("Location: 404.php");
    exit();
}

include_once 'includes/dashboard-patients.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bienvenid@, <?php echo $nombre ?> </h1>
</div>

<!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Próximas citas</h1>
</div>

<div class="table-responsive small">
    <div class="row">
        Aquí se mostrarán las citas en forma de listas
        <div class="col">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Cita 1</h5>
                        <small>Fecha: 12/03/2024 Hora: 10:00</small>
                    </div>
                    <p class="mb-1">Información sobre la cita 1.</p>
                    <small>Nombre del paciente: Paciente 1</small>
                    <small>Nombre del fisioterapeuta: Fisioterapeuta 1</small>
                    <div class="text-end mt-2">
                        <button type="button" class="btn btn-danger">Cancelar cita</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div> -->

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Mis informes</h1>
</div>

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

<div class="table-responsive small">
    <div class="row">
        <!-- Aquí se mostrará el informe en forma de listas -->
        <div class="col">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Informe 1</h5>
                        <small>Fecha: <?php echo($informe['fecha'])?></small>
                    </div>
                    <p class="mb-1">Información sobre el informe 1.</p>
                    <small>Nombre del paciente: <?php echo($informe['nombre_paciente'] .$informe['apellidos_paciente'])?></small>
                    <small>Nombre del fisioterapeuta: <?php echo($informe['nombre_fisioterapeuta'] .$informe['apellidos_fisioterapeuta'] )?></small>
                    <div class="text-end mt-2">
                        <form action="../scripts/descargar_informe.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $factura['factura_id']; ?>">
                            <button type="submit" class="btn btn-success">Descargar</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

</div>

</body>

</html>