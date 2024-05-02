<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/AppointmentController.php';
$appoinmentController = new AppointmentController();

if ($rol == "administrador" ||  $rol == "fisioterapeuta") {
    header("Location: 404.php");
    exit();
}

$articulos_x_pagina = 5;

if(!$_GET){
    header ('location:appointments-patients.php?pagina=1');
}

$iniciar = ($_GET['pagina']-1)*$articulos_x_pagina;

$citas = $appoinmentController->obtenerCitasUsuario($DNI,$iniciar, $articulos_x_pagina);

$n_botones_paginacion = ceil(count($citas)/($articulos_x_pagina));

// if($_GET['pagina']>$n_botones_paginacion){
//     header ('location:appointments-patients.php?pagina=1');
// }

include_once './includes/dashboard-patients.php';
include_once 'modals/appointments/add_modal.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Citas</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AsignarCita">
        Pedir Cita
    </button>
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
    <form class="row g-3">
        <div class="col-auto">
            <input type="date" class="form-control" id="">
        </div>
        <div class="col-auto">
            <select class="form-select" id="estado" name="estado">
                <option selected>Selecciona un estado</option>
                <option value="programada">Programada</option>
                <option value="realizada">Realizada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Filtrar</button>
        </div>
    </form>

    <div class="row">
        <!-- Aquí se mostrarán las citas en forma de listas -->
        <div class="col">
            <ul class="list-group">
                <?php foreach ($citas as $cita) : ?>
                    <li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Cita <?php echo $cita['cita_id'] ?></h5>
                            <small>Fecha y Hora: <?php echo $cita['fecha_hora'] ?></small>
                        </div>
                        <p class="mb-1">Información sobre la cita <?php echo $cita['cita_id'] ?>.</p>
                        <small>Nombre del paciente: <?php echo $cita['paciente_id'] ?></small>
                        <small>Nombre del fisioterapeuta: <?php echo $cita['fisioterapeuta_id'] ?></small>
                        <div class="text-end mt-2">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $cita['cita_id']; ?>">Modificar cita</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $cita['cita_id']; ?>">Cancelar cita</button>
                            <?php include 'modals/appointments/edit_delete_modal.php'; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
                <!-- Repite estas listas para cada cita -->
            </ul>
        </div>
    </div>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-start">
        <li class="page-item <? echo $_GET['pagina']<=1 ? 'disabled' : '' ?>">
            <a class="page-link" href="appointments-patients.php?pagina=<?php echo $_GET['pagina']-1?>">Anterior</a>
        </li>
        <?php for($i=0; $i<$n_botones_paginacion; $i++): ?>
        <li class="page-item <? echo $_GET['pagina']==$i+1 ? 'active' : '' ?>"><a class="page-link" href="appointments-patients.php?pagina=<?php echo $i+1?>"><?php echo $i+1?></a></li>
        <?php endfor ?>
        <li class="page-item <? echo $_GET['pagina']>=$n_botones_paginacion ? 'disabled' : '' ?>">
            <a class="page-link" href="appointments-patients.php?pagina=<?php echo $_GET['pagina']+1?>">Siguiente</a>
        </li>
    </ul>
</nav>

</body>

</html>