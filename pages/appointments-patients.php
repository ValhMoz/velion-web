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

include_once 'dashboard-patients.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Citas</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAsignarCita">
        Pedir Cita
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAsignarCita" tabindex="-1" role="dialog" aria-labelledby="modalAsignarCita" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pedir Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <!-- Pasos -->
                <div id="paso1" class="pasos">
                    <h5>1. Selecciona un fisioterapeuta</h5>
                    <select name="" id="">
                        <option value=""></option>
                    </select>
                </div>
                <div id="paso2" class="pasos" style="display: none;">
                    <h5>2. Selecciona un día</h5>
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                </div>
                <div id="paso3" class="pasos" style="display: none;">
                    <h5>3. Selecciona una hora</h5>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center">Horas de la Mañana</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="radio" name="hora" value="09:00"> 09:00</td>
                                            <td><input type="radio" name="hora" value="10:00"> 10:00</td>
                                            <td><input type="radio" name="hora" value="11:00"> 11:00</td>
                                            <td><input type="radio" name="hora" value="12:00"> 12:00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center">Horas de la Tarde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="radio" name="hora" value="17:00"> 17:00</td>
                                            <td><input type="radio" name="hora" value="18:00"> 18:00</td>
                                            <td><input type="radio" name="hora" value="19:00"> 19:00</td>
                                            <td><input type="radio" name="hora" value="20:00"> 20:00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnAnterior" style="display: none;">Anterior</button>
                <button type="button" class="btn btn-primary" id="btnSiguiente">Siguiente</button>
                <button type="button" class="btn btn-success" id="btnConfirmar" style="display: none;">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal eliminar cita -->
<div class="modal" id="eliminarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Deseas eliminar esta cita?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/user_manager.php" method="post">
                    <input type="hidden" id="actionType" name="action" value="eliminar">
                    <button type="submit" class="btn btn-danger">Eliminar cita</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive small">
    <form class="row g-3">
        <div class="col-auto">
            <label for="" class="visually-hidden">Filtro</label>
            <input type="date" class="form-control" id="">
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
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-action="eliminar">Cancelar cita</button>
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


</div>

<script>
    $(document).ready(function() {
        var pasoActual = 1;
        var totalPasos = 3;

        $('#btnSiguiente').click(function() {
            if (pasoActual < totalPasos) {
                $('#paso' + pasoActual).hide();
                $('#paso' + (pasoActual + 1)).show();
                if (pasoActual === totalPasos - 1) {
                    $('#btnSiguiente').hide();
                    $('#btnConfirmar').show();
                } else {
                    $('#btnAnterior').show();
                }
                pasoActual++;
            }
        });

        $('#btnAnterior').click(function() {
            if (pasoActual > 1) {
                $('#paso' + pasoActual).hide();
                $('#paso' + (pasoActual - 1)).show();
                $('#btnSiguiente').show();
                $('#btnConfirmar').hide();
                if (pasoActual === 2) {
                    $('#btnAnterior').hide();
                }
                pasoActual--;
            }
        });
    });
</script>

</body>

</html>