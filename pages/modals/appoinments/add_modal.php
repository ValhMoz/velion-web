<!-- Modal pedir cita -->
<div class="modal fade" id="AsignarCita" tabindex="-1" role="dialog" aria-labelledby="modalAsignarCita" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <div id="paso1" class="pasos">
                    <h5>1. Selecciona un paciente</h5>
                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Escribe aquí para buscar...">
                    <datalist id="datalistOptions">
                        <?php foreach ($pacientes as $paciente) : ?>
                            <option value="<?php echo $paciente['usuario_id']; ?>"><?php echo $paciente['nombre'] . ' ' . $paciente['apellidos']; ?></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>
                <div id="paso2" class="pasos" style="display: none;">
                    <h5>2. Selecciona un fisioterapeuta</h5>
                    <select id="selectFisioterapeuta" class="form-select">
                        <option value="">Selecciona un fisioterapeuta</option>
                        <?php foreach ($fisioterapeutas as $fisioterapeuta) : ?>
                            <option value="<?php echo $fisioterapeuta['usuario_id']; ?>"><?php echo $fisioterapeuta['nombre'] . ' ' . $fisioterapeuta['apellidos']; ?></option>
                        <?php endforeach; ?>
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

<script>
    $(document).ready(function() {
        var pasoActual = 1;
        var totalPasos = 4;

        $('#btnSiguiente').click(function() {
            // Aquí puedes agregar la lógica de validación para el paso actual
            // Por ejemplo, puedes verificar que se haya seleccionado un paciente y un fisioterapeuta antes de avanzar al siguiente paso
            if (pasoActual === 1) {
                // Validar la selección de paciente
                if ($('#selectPaciente').val() === '') {
                    alert('Por favor, selecciona un paciente.');
                    return;
                }
            } else if (pasoActual === 2) {
                // Validar la selección de fisioterapeuta
                if ($('#selectFisioterapeuta').val() === '') {
                    alert('Por favor, selecciona un fisioterapeuta.');
                    return;
                }
            }
            // Resto de la lógica de avance de pasos...
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
            // Aquí puedes obtener los datos seleccionados por el usuario
            var paciente = $('#selectPaciente').val();
            var fisioterapeuta = $('#selectFisioterapeuta').val();
            var fecha = $('#fecha').val();
            var hora = $('input[name="hora"]:checked').val();

            // Aquí puedes enviar los datos al servidor utilizando AJAX
            $.ajax({
                url: 'ruta_al_servidor',
                type: 'POST',
                data: {
                    action: 'asignar',
                    paciente: paciente,
                    fisioterapeuta: fisioterapeuta,
                    fecha: fecha,
                    hora: hora
                },
                success: function(response) {
                    // Manejar la respuesta del servidor en caso de éxito
                    alert('Cita asignada correctamente.');
                    // Puedes recargar la página o realizar otras acciones necesarias después de confirmar la cita
                },
                error: function(xhr, status, error) {
                    // Manejar la respuesta del servidor en caso de error
                    alert('Error al asignar la cita. Por favor, inténtalo de nuevo.');
                }
            });
        });
    });
</script>