<!-- Modal Rechazar usuario -->
<div class="modal fade" id="firmar_<?php echo $documento['documento_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Firmar documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Deseas firmar el documento con ID: <?php echo $documento['documento_id']; ?>?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/schedule_manager.php" method="post">
                    <input type="hidden" id="action" name="action" value="eliminar_horario">
                    <input type="hidden" id="id" name="id" value="<?php echo $documento['documento_id']; ?>">
                    <button type="submit" class="btn btn-danger">Firmar documento</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Rechazar usuario -->
<div class="modal fade" id="rechazar_<?php echo $documento['documento_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rechazar documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Deseas rechazar el documento con ID: <?php echo $documento['documento_id']; ?>?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/schedule_manager.php" method="post">
                    <input type="hidden" id="action" name="action" value="eliminar_horario">
                    <input type="hidden" id="id" name="id" value="<?php echo $documento['documento_id']; ?>">
                    <button type="submit" class="btn btn-danger">Rechazar documento</button>
                </form>
            </div>
        </div>
    </div>
</div>