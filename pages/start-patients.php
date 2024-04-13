<?php
require_once '../scripts/session_manager.php';
// require_once '../controllers/AppointmentController.php';
require_once '../controllers/MedicalHistoryController.php';
// $app = new AppointmentController();
$medHist = new MedicalHistoryController();

if ($rol == "administrador" ||  $rol == "fisioterapeuta") {
    header("Location: 404.php");
    exit();
}

// $citas = $app->obtenerCitasUsuario($DNI);
$informes = $medHist->obtenerInformesUsuario($DNI);

include_once './includes/dashboard-patients.php';
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

<div class="table-responsive small">
    <div class="row">
        <!-- Aquí se mostrará el informe en forma de listas -->
        <div class="col">
            <ul class="list-group">
                <?php foreach ($informes as $informe):?>
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
                <?php endforeach?>
                <!-- Repite estas listas para cada cita -->
            </ul>
        </div>
    </div>
</div>

</div>

</body>

</html>