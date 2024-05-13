<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Nueva Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario para añadir nueva cita -->
        <form action="procesar_cita.php" method="POST">
          <div class="mb-3">
            <label for="paciente_id" class="form-label">ID del Paciente</label>
            <input type="text" class="form-control" id="paciente_id" name="paciente_id" required>
          </div>
          <div class="mb-3">
            <label for="fisioterapeuta_id" class="form-label">ID del Fisioterapeuta</label>
            <input type="text" class="form-control" id="fisioterapeuta_id" name="fisioterapeuta_id" required>
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
            <label for="especialidad_id" class="form-label">Especialidad</label>
            <select class="form-select" id="especialidad_id" name="especialidad_id" required>
              <!-- Aquí puedes añadir opciones de especialidades desde la base de datos -->
              <option value="">Seleccionar</option>
              <option value="1">Especialidad 1</option>
              <option value="2">Especialidad 2</option>
              <!-- Añade más opciones según tus necesidades -->
            </select>
          </div>
          <div class="mb-3">
            <label for="horario_id" class="form-label">Horario</label>
            <select class="form-select" id="horario_id" name="horario_id" required>
              <!-- Aquí puedes añadir opciones de horarios desde la base de datos -->
              <option value="">Seleccionar</option>
              <option value="1">Horario 1</option>
              <option value="2">Horario 2</option>
              <!-- Añade más opciones según tus necesidades -->
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar Cita</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
