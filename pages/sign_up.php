<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Registro</title>
  <link href="../assets/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap-5.3/js/color-modes.js"></script>
  <script src="../assets/bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>
</head>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">

        <!-- Formulario de Registro -->
        <form action="../scripts/signup_manager.php" method="post" onsubmit="return validatePassword()">
          <h2 class="mb-3">Registro</h2>

          <!-- Nombre y Apellidos -->
          <div class="row mb-3">
            <div class="col">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="col">
              <label for="apellidos" class="form-label">Apellidos</label>
              <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
          </div>

          <!-- DNI y Género -->
          <div class="row mb-3">
            <div class="col">
              <label for="usuario_id" class="form-label">DNI</label>
              <input type="text" class="form-control" id="usuario_id" name="usuario_id" pattern="\d{8}[A-Za-z]" title="Introduce un DNI válido (8 dígitos seguidos de una letra)" oninput="return validarInput()" required>
              <div id="idError" class="text-danger"></div>
            </div>
            <div class="col">
              <label for="genero" class="form-label">Género</label>
              <select class="form-select" id="genero" name="genero" aria-label="Selecciona tu género">
                <option selected>Selecciona tu género</option>
                <option value="hombre">Hombre</option>
                <option value="mujer">Mujer</option>
                <option value="otro">Otro</option>
              </select>
            </div>
          </div>

          <!-- Fecha de nacimiento -->
          <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
          </div>

          <!-- Teléfono y Dirección -->
          <div class="row mb-3">
            <div class="col">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="telefono" name="telefono" pattern="\d{8}[0-9]" title="Introduce un telefono válido, sin espacios (9 dígitos)" required>
            </div>
            <div class="col">
              <label for="direccion" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
          </div>

          <!-- provincia, Municipio y CP -->
          <div class="row mb-3">
            <div class="col">
              <label for="provincia" class="form-label">Provincia</label>
              <select class="form-select" id="ps-prov" name="provincia" required></select>
            </div>

            <div class="col">
              <label for="municipio" class="form-label">Municipio</label>
              <select class="form-select" id="ps-mun" name="municipio" required></select>
            </div>

            <div class="col">
              <label for="cp" class="form-label">Código Postal</label>
              <input type="text" class="form-control" id="cp" name="cp" pattern="[0-9]{5}" title="Introduce un código postal válido (5 dígitos)" required>
            </div>
          </div>

          <!-- Correo electrónico -->
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <!-- Contraseña y Confirmar contraseña -->
          <div class="row mb-3">
            <div class="col">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="pass" minlength="8" name="pass" required>
            </div>
            <div class="col">
              <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
              <input type="password" class="form-control" id="confirmPass" name="confirmPass" required>
              <div id="passwordError" class="text-danger"></div>
            </div>
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

    // Función para validar el DNI
    function validarDNI(dni) {
      var dniRegex = /^[0-9]{8}[a-zA-Z]$/;
      if (!dniRegex.test(dni)) {
        return false;
      }
      var letrasDNI = 'TRWAGMYFPDXBNJZSQVHLCKE';
      var numeroDNI = dni.substring(0, 8);
      var letraDNI = dni.substring(8).toUpperCase();
      var resto = numeroDNI % 23;
      var letraCalculada = letrasDNI.charAt(resto);
      return letraDNI === letraCalculada;
    }

    // Función para manejar el evento de entrada
    function validarInput() {
      var dniInput = document.getElementById('dni');
      var dni = dniInput.value;
      var resultado = document.getElementById('resultado');

      if (validarDNI(dni)) {
        resultado.textContent = 'El DNI es válido.';
        resultado.style.color = 'green';
      } else {
        resultado.textContent = 'El DNI no es válido.';
        resultado.style.color = 'red';
      }
    }
  </script>
  <script>
    var prov = document.getElementById('ps-prov');
    var mun = document.getElementById('ps-mun');
    // Create PS
    new Pselect().create(prov, mun);


    document.getElementById('ps-mun').addEventListener('change', function onChange() {
      document.getElementById('code').innerText = 'Código: ' + document.getElementById('ps-mun').value;
    });
  </script>
</body>

</html>