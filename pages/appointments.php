<?php
require_once '../scripts/session_manager.php';
if($rol == "paciente"){
    header("Location: 404.php");
    exit();
}
require_once '../controllers/AppointmentController.php';

$appoinmentController = new AppointmentController();
$citas = $appoinmentController->obtenerCitas();

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Citas</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAsignarCita">
        Asignar Cita
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAsignarCita" tabindex="-1" role="dialog" aria-labelledby="modalAsignarCita" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <!-- Pasos -->
                <div id="paso1" class="pasos">
                    <h5>1. Selecciona un paciente</h5>
                    <select name="" id="">
                        <option value=""></option>
                    </select>
                </div>
                <div id="paso2" class="pasos" style="display: none;">
                    <h5>2. Selecciona un fisioterapeuta</h5>
                    <select name="" id="">
                        <option value=""></option>
                    </select>
                </div>
                <div id="paso3" class="pasos" style="display: none;">
                    <h5>3. Selecciona un día</h5>
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                </div>
                <div id="paso4" class="pasos" style="display: none;">
                    <h5>4. Selecciona una hora</h5>
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

<!-- Modal confirmar cita -->
<div class="modal fade" id="confirmarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar cita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../scripts/user_manager.php" method="post">
                <div class="modal-body">
                    <input type="hidden" id="actionType" name="action" value="confirmar">

                    <p>¿Deseas confirmar esta cita?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Confirmar cita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal eliminar cita -->
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar cita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../scripts/user_manager.php" method="post">
                <div class="modal-body">
                    <input type="hidden" id="actionType" name="action" value="eliminar">

                    <p>¿Deseas eliminar esta cita?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Eliminar cita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="table-responsive small">
    <form class="row g-3">
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Filtro</label>
            <input type="text" class="form-control" id="inputPassword2" placeholder="Filtrar por nombre...">
        </div>
        <div class="col-auto">
            <input type="date" class="form-control" id="">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Filtrar</button>
        </div>
    </form>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">ID</th>
                            <th scope="col" style="width: 15%;">Fecha</th>
                            <th scope="col" style="width: 20%;">Paciente</th>
                            <th scope="col" style="width: 20%;">Fisioterapeuta asociado</th>
                            <!-- <th scope="col" style="width: 10%;">Consulta</th> -->
                            <th scope="col" style="width: 10%;">Estado</th>
                            <th scope="col" style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <?php foreach ($citas as $cita) : ?>
                            <tr>
                                <td><?php echo $cita['cita_id']; ?></td>
                                <td><?php echo $cita['fecha_hora']; ?></td>
                                <td><?php echo $cita['paciente_id']; ?></td>
                                <td><?php echo $cita['fisioterapeuta_id']; ?></td>
                                <!-- <td><?php echo $cita['sala_consulta']; ?></td> -->
                                <td><?php echo $cita['estado']; ?></td>
                                <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmarModal" data-action="confirmar">Confirmar</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-action="eliminar">Eliminar</button>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
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
</div>

<script>
    $(document).ready(function() {
        var pasoActual = 1;
        var totalPasos = 4;

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