<!-- Modal eliminar cita -->
<div class="modal fade" id="delete_<?php echo $cita['cita_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel" style="color:#FFFFFF">Eliminar cita</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color:#FFFFFF; text-align:left;">¿Deseas eliminar esta cita de <?php echo $cita['paciente_nombre'] . ' ' . $cita['paciente_apellidos']; ?>?</p>
      </div>
      <div class="modal-footer">
        <form action="../scripts/appointment_manager.php" method="post">
            <input type="hidden" name="action" id="action" value="eliminar-patient">
            <input type="hidden" name="cita_id" id="cita_id" value="<?php echo $cita['cita_id']; ?>">
            <button type="submit" class="btn btn-danger">Eliminar cita</button>
        </form>
      </div>
    </div>
  </div>
</div>
