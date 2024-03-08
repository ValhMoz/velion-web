<?php
    require_once '../scripts/session_manager.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Vista de perfil del usuario -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4">Perfil de Usuario</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nombre:</strong> <?php echo $nombreUsuario ?></li>
                        <li class="list-group-item"><strong>Apellidos:</strong> <?php echo $apellidos ?></li>
                        <li class="list-group-item"><strong>Correo Electrónico:</strong> <?php echo $correoElectronico ?></li>
                        <li class="list-group-item"><strong>Teléfono:</strong> <?php echo $telefono ?></li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> <?php echo $fechaNacimiento ?></li>
                        <li class="list-group-item"><strong>Dirección:</strong> <?php echo $direccion ?></li>
                        <li class="list-group-item"><strong>Sesiones disponibles:</strong> <?php echo $sessiones_disponibles ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Formulario de cambio de datos -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4">Cambiar Datos</h2>
                    <form action="actualizar_datos.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="<?php echo $correoElectronico ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
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