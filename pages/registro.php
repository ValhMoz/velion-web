<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Registro</title>
  <link href="../assets/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap-5.3/js/color-modes.js"></script>
  <script src="../assets/bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">

        <!-- Formulario de Registro -->
        <form>
          <h2 class="mb-3">Registro</h2>

          <!-- Nombre de usuario -->
          <div class="mb-3">
            <label for="username" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>

          <!-- Correo electrónico -->
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <!-- Contraseña -->
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <!-- Confirmar contraseña -->
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
          </div>

          <div class="mb-3">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" requiredChecked>
            <label class="form-check-label" for="flexCheckDefault">
              Acepto los <a href="../core/terminos.php">términos y condiciones del servicio</a>
            </label>
          </div>

          <!-- Botón de Registro -->
          <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>

      </div>
    </div>
  </div>
</body>

</html>