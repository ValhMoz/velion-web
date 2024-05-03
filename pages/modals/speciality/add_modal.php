<!-- Modal -->
<div class="modal fade" id="agregarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir especialidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="descipcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" required>
            </div>
            <div class="modal-footer">
                <form action="../scripts/speciality_manager.php" method="post">
                    <input type="hidden" id="actionType" name="action" value="añadir">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>