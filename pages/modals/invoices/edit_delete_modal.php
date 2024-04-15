<!-- Modal eliminar factura -->
<div class="modal fade" id="delete_<?php echo $factura['factura_id']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Deseas eliminar esta factura con ID: <?php echo $factura['factura_id']; ?>?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/user_manager.php" method="post">
                    <input type="hidden" id="actionType" name="action" value="eliminar">
                    <button type="submit" class="btn btn-danger">Eliminar factura</button>
                </form>
            </div>
        </div>
    </div>
</div>
