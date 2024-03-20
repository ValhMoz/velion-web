<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reinicio de Contraseña</title>
    <link href="../assets/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/bootstrap-5.3/css/dashboard.css" rel="stylesheet">
    <script src="../assets/bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/bootstrap-5.3/js/dashboard.js"></script>
    <script src="../assets/custom/js/timeout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/bootstrap-5.3/js/color-modes.js"></script>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Formulario de Reinicio de Contraseña -->
                <form action="../scripts/resetPassword_manager.php" method="post">
                    <h2 class="mb-3">Reinicio de Contraseña</h2>

                    <!-- Correo Electrónico
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div> -->

                    <!-- Contraseña Nueva -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" minlength="8" required>
                    </div>

                    <!-- Botón de Reinicio de Contraseña -->
                    <button type="submit" class="btn btn-primary">Reiniciar Contraseña</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
