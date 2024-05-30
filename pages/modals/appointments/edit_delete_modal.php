<!-- Modal -->
<div class="modal fade" id="edit_<?php echo $cita['cita_id']; ?>" tabindex="-1" aria-labelledby="agregarCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCitaModalLabel">Editar Cita</h5>
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
                <form action="../scripts/appointment_manager.php" method="post" id="formCitas">
                    <p>¿Deseas confirmar esta cita de <?php echo $cita['paciente_nombre'] . " " . $cita['paciente_apellidos']; ?>?</p>
                    <input type="hidden" id="actionCitas" name="action" value="confirmar">
                    <input type="hidden" id="cita_id" name="cita_id" value="<?php echo $cita['cita_id'] ?>">
                </form>
                <form action="../scripts/medicalhistory_manager.php" method="post" id="formHistorialMedico">
                    <div class="card">
                        <div class="card-header">
                            Generar Historial Médico
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="diagnostico" class="form-label">Diagnóstico</label>
                                <textarea class="form-control" name="diagnostico" id="diagnostico" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tratamiento" class="form-label">Tratamiento</label>
                                <textarea class="form-control" name="tratamiento" id="tratamiento" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="notas" class="form-label">Notas Adicionales</label>
                                <textarea class="form-control" name="notas" id="notas" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="submitForms" class="btn btn-success">Confirmar cita</button>
            </div>
            <script>
                document.getElementById("submitForms").addEventListener("click", function() {
                    document.getElementById("formHistorialMedico").submit(); // Envía el formulario de historial médico primero
                });
                
                // Agregar un listener para el evento 'submit' en el formulario de historial médico
                document.getElementById("formHistorialMedico").addEventListener("submit", function() {
                    // Agregar el código aquí para manejar la respuesta después de enviar el formulario de historial médico
                    // Por ejemplo, si la respuesta indica que el historial médico se creó con éxito, entonces enviar el formulario de citas
                    document.getElementById("formCitas").submit(); // Envía el formulario de citas después de crear el historial médico
                });
            </script>
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
                    <input type="hidden" id="cita_id" name="cita_id" value=" <?php echo $cita['cita_id'] ?>">
                    <button type="submit" class="btn btn-danger" id="btnEliminar">Eliminar cita</button>
                </form>
            </div>
        </div>
    </div>
</div>