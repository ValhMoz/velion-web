<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/MedicalHistoryController.php';

$medHist = new MedicalHistoryController();

if ($rol == "Administrador" ||  $rol == "Fisioterapeuta") {
    header("Location: 404.php");
    exit();
}

if (!$_GET) {
    header('location:start-patients.php?pagina=1');
}

$articulos_x_pagina = 4;

$iniciar = ($_GET['pagina'] - 1) * $articulos_x_pagina;

$informe = $medHist->obtenerInforme($DNI);

$n_botones_paginacion = ceil(count($informe) / ($articulos_x_pagina));

if($_GET['pagina']>$n_botones_paginacion){
    header ('location:appointments-patients.php?pagina=1');
}

include_once 'includes/dashboard-patients.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bienvenid@, <?php echo $nombre ?> </h1>
</div>

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
                        <h5 class="mb-2">Informe 1</h5>
                        <small>Fecha: <?php echo $informe[0]['fecha']; ?></small>
                    </div>
                    <p class="mb-1">Información sobre el informe.</p>
                    <small>Nombre del paciente: <?php echo $informe[0]['nombre_paciente'] . " " . $informe[0]['apellidos_paciente']; ?></small>
                    <small>Nombre del fisioterapeuta: <?php echo $informe[0]['nombre_fisioterapeuta'] . " " . $informe[0]['apellidos_fisioterapeuta']; ?></small>
                    <div class="text-end mt-2">
                        <form action="../scripts/medicalhistory_manager.php" method="GET">
                            <input type="hidden" id="id" name="id" value="<?php echo $factura[0]['historial_id']; ?>">
                            <button type="submit" class="btn btn-success">Descargar</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-start">
        <li class="page-item <? echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="appointments-patients.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
        </li>
        <?php for ($i = 0; $i < $n_botones_paginacion; $i++) : ?>
            <li class="page-item <? echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="appointments-patients.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
        <?php endfor ?>
        <li class="page-item <? echo $_GET['pagina'] >= $n_botones_paginacion ? 'disabled' : '' ?>">
            <a class="page-link" href="appointments-patients.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
        </li>
    </ul>
</nav>

</div>

</body>

</html>