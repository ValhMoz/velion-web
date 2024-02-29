<?php
include("../core/login.php");  // Asegúrate de incluir login.php primero

// Obtener el nombre de usuario y datos del usuario desde la sesión
$datosUsuario = obtenerDatosUsuario($_SESSION["username"], $conexion);
$nombreUsuario = $datosUsuario["username"];
$correoElectronico = $datosUsuario["email"];
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <!-- Vista de perfil del usuario -->
            <div class="card">
                <!-- <img src="" class="card-img-top" alt="Avatar"> -->
                <div class="card-body">
                    <h5 class="card-title">Nombre de Usuario:  <?php echo $nombreUsuario ?> </h5>
                    <p class="card-text">Correo electrónico: <?php echo $correoElectronico ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Formulario de cambio de datos -->
            <h2 class="mb-4">Cambiar Datos</h2>
            <form>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" placeholder="Correo electrónico">
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" placeholder="Contraseña">
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>