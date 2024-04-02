<?php
require_once '../scripts/session_manager.php';
if ($rol == "administrador" ||  $rol == "fisioterapeuta") {
    header("Location: 404.php");
    exit();
}
include_once 'dashboard-patients.php';

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Vista de perfil del usuario -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4">Perfil de Usuario</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nombre:</strong> <?php echo $nombre ?></li>
                        <li class="list-group-item"><strong>Apellidos:</strong> <?php echo $apellidos ?></li>
                        <li class="list-group-item"><strong>Correo Electrónico:</strong> <?php echo $correo ?></li>
                        <li class="list-group-item"><strong>DNI:</strong> <?php echo $DNI ?></li>
                        <li class="list-group-item"><strong>Teléfono:</strong> <?php echo $telefono ?></li>
                        <!-- <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> <?php echo $fecha_nacimiento ?></li> -->
                        <li class="list-group-item"><strong>Dirección:</strong> <?php echo $direccionCompleta ?></li>
                        <li class="list-group-item"><strong>Sesiones disponibles:</strong> <?php echo $sesiones ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Formulario de cambio de datos -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4">Cambiar Datos</h2>
                    <form action="../scripts/user_manager.php" method="POST">
                        <input type="hidden" id="actionType" name="action" value="actualizar_datos">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="<?php echo $correo ?>">
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Confirmar Contraseña" required>
                            <div id="passwordError" class="text-danger"></div>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="return validatePassword()">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

</body>

</html>
