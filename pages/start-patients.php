<?php
require_once '../scripts/session_manager.php';
if($rol == "administrador" ||  $rol == "fisioterapeuta")
{
    header("Location: 404.php");
    exit();
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bienvenid@, <?php echo $nombre ?> </h1>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Próximas citas</h1>
</div>

<div class="table-responsive small">
    <div class="row">
        <!-- Aquí se mostrarán las citas en forma de listas -->
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
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Cita 2</h5>
                        <small>Fecha: 14/03/2024 Hora: 11:00</small>
                    </div>
                    <p class="mb-1">Información sobre la cita 2.</p>
                    <small>Nombre del paciente: Paciente 2</small>
                    <small>Nombre del fisioterapeuta: Fisioterapeuta 2</small>
                    <div class="text-end mt-2">
                        <button type="button" class="btn btn-danger">Cancelar cita</button>
                    </div>
                </li>
                <!-- Repite estas listas para cada cita -->
            </ul>
        </div>
    </div>

</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-start">
        <li class="page-item disabled">
            <a class="page-link">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Mis informes</h1>
</div>

<div class="table-responsive small">
    <div class="row">
        <!-- Aquí se mostrarán las citas en forma de listas -->
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
                        <button type="button" class="btn btn-success">Descargar</button>
                    </div>
                </li>
                <!-- Repite estas listas para cada cita -->
            </ul>
        </div>
    </div>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-start">
        <li class="page-item disabled">
            <a class="page-link">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>