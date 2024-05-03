<!-- Modal editar usuario -->
<div class="modal fade" id="edit_<?php echo $horario['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Horario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../scripts/schedule_manager.php" method="post">
                <div class="modal-body">
                    <input type="hidden" id="actionType" name="action" value="editar_usuario">
                    <div id="userDetails">
                        <!-- Nombre y ID del Fisioterapeuta -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $horario['nombre']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fisioterapeuta_id" class="form-label">DNI del Fisioterapeuta</label>
                                <input type="text" class="form-control" id="fisioterapeuta_id" name="fisioterapeuta_id" value="<?php echo $horario['fisioterapeuta_id']; ?>" required>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" aria-label="Selecciona el estado">
                                    <option value="" disabled>Selecciona el estado</option>
                                    <option value="activo" <?php if ($horario['estado'] === 'activo') echo 'selected'; ?>>Activo</option>
                                    <option value="pendiente" <?php if ($horario['estado'] === 'pendiente') echo 'selected'; ?>>Pendiente</option>
                                    <option value="cancelado" <?php if ($horario['estado'] === 'cancelado') echo 'selected'; ?>>Cancelado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal eliminar usuario -->
<div class="modal fade" id="delete_<?php echo $horario['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Deseas eliminar el horario con nombre: <?php echo $horario['nombre']; ?> y con ID: <?php echo $horario['id']; ?>?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/schedule_manager.php" method="post">
                    <input type="hidden" id="action" name="action" value="eliminar_horario">
                    <input type="hidden" id="id" name="id" value="<?php echo $horario['id']; ?>">
                    <button type="submit" class="btn btn-danger">Eliminar horario</button>
                </form>
            </div>
        </div>
    </div>
</div>