<!-- Modal
<div class="modal fade" id="edit_<?php echo $cita['cita_id']; ?>" tabindex="-1" aria-labelledby="agregarCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCitaModalLabel">Editar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../scripts/appointment_manager.php" method="post" id="editarCitaForm">
                <div class="modal-body">
                    <input type="hidden" id="actionType" name="action" value="asignar">
                    <input type="hidden" id="cita_id" name="cita_id" value="<?php echo $cita['cita_id']?>">
                    <input type="hidden" id="paciente_id" name="paciente_id" value="<?php echo $DNI?>">
                    <input type="hidden" id="estado" name="estado" value="<?php echo $cita['estado']?>">
                    <div class="mb-3">
                        <label for="especialidad_id" class="form-label">Especialidad</label>
                        <select class="form-select" name="especialidad_id" id="especialidad_id" required>
                            <option value="<?php echo $especialidad['especialidad_id']?>" hidden selected><?php echo $especialidad['especialidad_id'] . ' - ' . $especialidad['descripcion']; ?></option>
                            <?php foreach ($especialidades as $especialidad) : ?>
                                <option value="<?php echo $especialidad['especialidad_id']; ?>"><?php echo $especialidad['especialidad_id'] . ' - ' . $especialidad['descripcion']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fisioterapeuta_id" class="form-label">ID del Fisioterapeuta</label>
                        <select class="form-select" name="fisioterapeuta_id" id="fisioterapeuta_id" required>
                            <option value="<?php echo $fisioterapeuta['usuario_id']; ?>" hidden selected><?php echo $fisioterapeuta['nombre'] . ' ' . $fisioterapeuta['apellidos']; ?></option>
                            <?php foreach ($fisioterapeutas as $fisioterapeuta) : ?>
                                <option value="<?php echo $fisioterapeuta['usuario_id']; ?>"><?php echo $fisioterapeuta['nombre'] . ' ' . $fisioterapeuta['apellidos']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" value="<?php echo $cita['fecha_hora']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cita</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

<!-- Modal eliminar cita -->
<div class="modal fade" id="delete_<?php echo $cita['cita_id']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="text-align: left">¿Deseas eliminar esta cita de <?php echo $cita['paciente_nombre'] . " " . $cita['paciente_apellidos']; ?>?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/appointment_manager.php" method="post">
                    <input type="hidden" id="action" name="action" value="eliminar-patient">
                    <input type="hidden" id="cita_id" name="cita_id" value=" <?php echo $cita['cita_id'] ?>">
                    <button type="submit" class="btn btn-danger" id="btnEliminar">Eliminar cita</button>
                </form>
            </div>
        </div>
    </div>
</div>