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
        <form action="./scripts/signup_manager.php" method="post" onsubmit="return validatePassword()">
          <h2 class="mb-3">Registro</h2>

          <!-- Nombre -->
          <div class="mb-3">
            <label for="username" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>

          <!-- Apellidos -->
          <div class="mb-3">
            <label for="username" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>

          <!-- DNI -->
          <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" pattern="\d{8}[A-Za-z]" title="Introduce un DNI válido (8 dígitos seguidos de una letra)" required>
          </div>

          <!-- Género -->
          <div class="mb-3">
            <label for="dni" class="form-label">Género</label>
            <select class="form-select" aria-label="Selecciona tu género">
              <option selected>Selecciona tu género</option>
              <option value="hombre">Hombre</option>
              <option value="mujer">Mujer</option>
              <option value="otro">Otro</option>
            </select>
          </div>

          <!-- Fecha de nacimiento -->
          <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
          </div>


          <!-- Telefono -->
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" pattern="\d{8}[0-9]" title="Introduce un telefono válido, sin espacios (9 dígitos)" required>
          </div>

          <!-- Direccion -->
          <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
          </div>

          <!-- Correo electrónico -->
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <!-- Contraseña -->
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="pass" minlength="8" name="pass" required>
          </div>

          <!-- Confirmar contraseña -->
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
            <input type="password" class="form-control" id="confirmPass" name="confirmPass" required>
            <div id="passwordError" class="text-danger"></div>
          </div>

          <!-- CheckBox para aceptar términos y condiciones -->
          <div class="mb-3">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" requiredChecked>
            <label class="form-check-label" for="flexCheckDefault">
              Acepto los <a href="terms.php">términos y condiciones del servicio</a>
            </label>
          </div>

          <!-- Botón de Registro -->
          <button type="submit" class="btn btn-primary">Registrarse</button>
          <a href="#" onclick="history.back();" class="btn btn-secondary">Volver atrás</a>
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
</body>

</html>