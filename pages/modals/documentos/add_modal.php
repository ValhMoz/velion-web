<!-- Modal añadir documento -->
<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir nuevo documento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../scripts/documento_manager.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="actionType" name="action" value="subir_documento">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del documento</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ruta_documento" class="form-label">Seleccionar documento</label>
                        <input class="form-control" type="file" id="ruta_documento" name="ruta_documento" required>
                    </div>
                    <div class="mb-3">
                        <label for="paciente_id" class="form-label">ID del Paciente</label>
                        <input type="text" class="form-control" id="paciente_id" name="paciente_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="fisioterapeuta_id" class="form-label">ID del Fisioterapeuta</label>
                        <input type="text" class="form-control" id="fisioterapeuta_id" name="fisioterapeuta_id" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir Documento</button>
                </div>
            </form>
        </div>
    </div>
</div>