<?php
require_once '../scripts/session_manager.php';

if ($rol == "administrador" ||  $rol == "fisioterapeuta") {
    include_once './includes/dashboard.php';
}else {
    include_once './includes/dashboard-patients.php';
}

?>

<?php
// Verificar si hay una alerta de usuario
if (isset($_SESSION['alert'])) {
    $alert_type = $_SESSION['alert']['type'];
    $alert_message = $_SESSION['alert']['message'];
    // Mostrar la alerta
    echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show" role="alert">' . $alert_message . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    // Eliminar la variable de sesión después de mostrar la alerta
    unset($_SESSION['alert']);
}
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
                        <input type="hidden" id="action" name="action" value="actualizar_datos">
                        <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $DNI ?>">

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

</main>

<script>
    function validatePassword() {
        var password = document.getElementById("pass").value;
        var confirmPassword = document.getElementById("confirmPass").value;
        if (password != confirmPassword) {
            document.getElementById("passwordError").innerHTML = "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
            return false;
        }
        return true;
    }
</script>

</body>

</html>