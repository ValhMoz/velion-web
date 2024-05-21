<!-- Modal -->
<div class="modal fade" id="edit_<?php echo $cita['cita_id']; ?>" tabindex="-1" aria-labelledby="agregarCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCitaModalLabel">Agregar Nueva Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../scripts/appoinmtment_manager.php" method="post" id="agregarCitaForm">
                <div class="modal-body">
                    <input type="hidden" id="actionType" name="action" value="asignar">
                    <div class="mb-3">
                        <label for="paciente_id" class="form-label">ID del Paciente</label>
                        <input type="text" class="form-control" list="pacienteOptions" id="paciente_id" value="<?php echo $paciente['usuario_id']; ?>">
                        <datalist id="pacienteOptions">
                            <?php foreach ($pacientes as $paciente) : ?>
                                <option value="<?php echo $paciente['usuario_id']; ?>"><?php echo $paciente['nombre'] . ' ' . $paciente['apellidos']; ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="especialidad_id" class="form-label">Especialidad</label>
                        <input class="form-control" list="especialidadOptions" id="especialidad_id" value="<?php echo $especialidad['especialidad_id']; ?>">
                        <datalist id="especialidadOptions">
                            <?php foreach ($especialidades as $especialidad) : ?>
                                <option value="<?php echo $especialidad['especialidad_id']; ?>"><?php echo $especialidad['especialidad_id'] . ' - ' . $especialidad['descripcion']; ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="fisioterapeuta_id" class="form-label">ID del Fisioterapeuta</label>
                        <input class="form-control" list="fisioterapeutaOptions" id="fisioterapeuta_id" value="<?php echo $fisioterapeuta['usuario_id']; ?>">
                        <datalist id="fisioterapeutaOptions">
                            <?php foreach ($fisioterapeutas as $fisioterapeuta) : ?>
                                <option value="<?php echo $fisioterapeuta['usuario_id']; ?>"><?php echo $fisioterapeuta['nombre'] . ' ' . $fisioterapeuta['apellidos']; ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" required>
                    </div>
                    <div class="mb-3">
                        <label for="duracion_minutos" class="form-label">Duración (minutos)</label>
                        <input type="number" class="form-control" id="duracion_minutos" name="duracion_minutos" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" value="<?php echo $fisioterapeuta['usuario_id']; ?>">
                            <option value="Programada">Programada</option>
                            <option value="Cancelada">Cancelada</option>
                            <option value="Realizada">Realizada</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="agregarCitaForm" class="btn btn-primary">Guardar Cita</button>
                </div>
            </form>
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
                <form action="../scripts/appointment_manager.php" method="post">
                    <input type="hidden" id="action" name="action" value="confirmar">
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
                <form action="../scripts/appointment_manager.php" method="post">
                    <input type="hidden" id="action" name="action" value="eliminar">
                    <input type="hidden" id="cita_id" name="cita_id" value=" <?php echo $cita['cita_id']?>">
                    <button type="submit" class="btn btn-danger" id="btnEliminar">Eliminar cita</button>
                </form>
            </div>
        </div>
    </div>
</div>