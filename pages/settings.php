<?php
// Inicia la sesión si no está iniciada
session_start();

// Verifica si hay un nombre de usuario y un correo electrónico en la sesión
if (isset($_SESSION['email'])) {
    $nombreUsuario = $_SESSION['username'];
    $correoElectronico = $_SESSION['email'];
} else {
    // Si no hay un nombre de usuario y un correo electrónico en la sesión, redirige a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <!-- Vista de perfil del usuario -->
            <div class="card">
                <!-- <img src="" class="card-img-top" alt="Avatar"> -->
                <div class="card-body">
                    <h5 class="card-title">Nombre de Usuario: <?php echo $nombreUsuario ?> </h5>
                    <p class="card-text">Correo electrónico: <?php echo $correoElectronico ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Formulario de cambio de datos -->
            <h2 class="mb-4">Cambiar Datos</h2>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" placeholder="Correo electrónico" required>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input type="pass" class="form-control" id="pass" placeholder="Contraseña" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Confirmar Contraseña" required>
                    <div id="passwordError" class="text-danger"></div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
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