<!-- Modal -->
<div class="modal fade" id="AsignarCita" tabindex="-1" aria-labelledby="agregarCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCitaModalLabel">Agregar Nueva Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../scripts/appointment_manager.php" method="post" id="agregarCitaForm">
                <div class="modal-body">
                    <input type="hidden" id="actionType" name="action" value="asignar">
                    <div class="mb-3">
                        <label for="paciente_id" class="form-label">ID del Paciente</label>
                        <input type="text" class="form-control" list="pacienteOptions" id="paciente_id" name="paciente_id" placeholder="Escribe aquí para buscar...">
                        <datalist id="pacienteOptions">
                            <?php foreach ($pacientes as $paciente) : ?>
                                <option value="<?php echo $paciente['usuario_id']; ?>"><?php echo $paciente['nombre'] . ' ' . $paciente['apellidos']; ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="especialidad_id" class="form-label">Especialidad</label>
                        <input class="form-control" list="especialidadOptions" id="especialidad_id" name="especialidad_id" placeholder="Escribe aquí para buscar...">
                        <datalist id="especialidadOptions">
                            <?php foreach ($especialidades as $especialidad) : ?>
                                <option value="<?php echo $especialidad['especialidad_id']; ?>"><?php echo $especialidad['especialidad_id'] . ' - ' . $especialidad['descripcion']; ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="fisioterapeuta_id" class="form-label">ID del Fisioterapeuta</label>
                        <input class="form-control" list="fisioterapeutaOptions" id="fisioterapeuta_id" name="fisioterapeuta_id" placeholder="Escribe aquí para buscar...">
                        <datalist id="fisioterapeutaOptions"></datalist>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" required>
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

<?php
// Procesar la selección de especialidad y actualizar la lista de fisioterapeutas
if (isset($_POST['especialidad_id'])) {
    $especialidad_seleccionada = $_POST['especialidad_id'];

    // Filtrar la lista de fisioterapeutas por la especialidad seleccionada
    $fisioterapeutas_filtrados = array_filter($fisioterapeutas, function($fisioterapeuta) use ($especialidad_seleccionada) {
        return $fisioterapeuta['especialidad_id'] == $especialidad_seleccionada;
    });

    // Crear opciones para el select de fisioterapeutas
    $options = '';
    foreach ($fisioterapeutas_filtrados as $fisioterapeuta) {
        $options .= '<option value="' . $fisioterapeuta['usuario_id'] . '">' . $fisioterapeuta['nombre'] . ' ' . $fisioterapeuta['apellidos'] . '</option>';
    }

    // Imprimir las opciones actualizadas de fisioterapeutas
    echo $options;
    exit; // Detener la ejecución del resto de la página
}
?>
