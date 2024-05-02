<!-- Modal pedir cita -->
<div class="modal fade" id="edit_<?php echo $cita['cita_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editarModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <!-- Pasos -->
                <div id="paso1" class="pasos">
                    <h5>1. Selecciona un paciente</h5>
                    <select class="form-select" id="">
                        <option value="<?php echo $usuario['paciente_id']; ?>"><?php echo $cita['paciente_nombre'] . " " . $cita['paciente_apellidos']; ?></option>
                    </select>
                </div>
                <div id="paso2" class="pasos" style="display: none;">
                    <h5>2. Selecciona un fisioterapeuta</h5>
                    <select class="form-select" name="" id="">
                        <option value=""></option>
                    </select>
                </div>
                <div id="paso3" class="pasos" style="display: none;">
                    <h5>3. Selecciona un día</h5>
                    <div class="mb-3">
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
<div class="modal fade" id="confirm_<?php echo $cita['cita_id']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Deseas confirmar esta cita de <?php echo $cita['paciente_nombre'] . " " . $cita['paciente_apellidos']; ?>?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/user_manager.php" method="post">
                    <input type="hidden" id="cita_id" name="cita_id" value=" <?php echo $cita['cita_id']?>">
                    <button type="submit" class="btn btn-success" id="btnCompletar">Confirmar cita</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal eliminar cita -->
<div class="modal fade" id="delete_<?php echo $cita['cita_id']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Deseas eliminar esta cita de <?php echo $cita['paciente_nombre'] . " " . $cita['paciente_apellidos']; ?>?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/user_manager.php" method="post">
                    <input type="hidden" id="action" name="action" value="eliminar">
                    <input type="hidden" id="cita_id" name="cita_id" value=" <?php echo $cita['cita_id']?>">
                    <button type="submit" class="btn btn-danger" id="btnEliminar">Eliminar cita</button>
                </form>
            </div>
        </div>
    </div>
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

        $('#btnConfirmar').click(function() {
            var pacienteId = $('#exampleDataList').val();
            var fisioterapeutaId = $('#selectFisioterapeuta').val();
            var fecha = $('#fecha_nacimiento').val();
            var hora = $('input[name="hora"]:checked').val();

            $.ajax({
                type: 'POST',
                url: '../scripts/appointment_manager.php',
                data: {
                    action: 'editar',
                    paciente_id: pacienteId,
                    fisioterapeuta_id: fisioterapeutaId,
                    fecha: fecha,
                    hora: hora
                },
                success: function(response) {
                    $('#edit_<?php echo $cita['cita_id']; ?>').modal('hide');
                },
                error: function(xhr, status, error) {
                    alert('Error al asignar la cita: ' + error);
                }
            });
        });

        $('#btnEliminar').click(function() {
            var cita_id = $('#cita_id').val();

            $.ajax({
                type: 'POST',
                url: '../scripts/appointment_manager.php',
                data: {
                    action: 'eliminar',
                    cita_id: cita_id
                },
                success: function(response) {
                    $('#delete_<?php echo $cita['cita_id']; ?>').modal('hide');
                },
                error: function(xhr, status, error) {
                    alert('Error al asignar la cita: ' + error);
                }
            });
        });

        $('#btnCompletar').click(function() {
            var cita_id = $('#cita_id').val();

            $.ajax({
                type: 'POST',
                url: '../scripts/appointment_manager.php',
                data: {
                    action: 'confirmar',
                    cita_id: cita_id
                },
                success: function(response) {
                    $('#delete_<?php echo $cita['cita_id']; ?>').modal('hide');
                },
                error: function(xhr, status, error) {
                    alert('Error al confirmar la cita: ' + error);
                }
            });
        });

    });
</script>
