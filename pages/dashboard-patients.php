<?php
  require_once '../scripts/session_manager.php';
  if($rol == "administrador" ||  $rol == "fisioterapeuta")
{
    header("Location: 404.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Pacientes</title>
  <link href="../assets/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/custom/js/timeout.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="../assets/bootstrap-5.3/js/color-modes.js"></script>

</head>

<body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
      <a class="navbar-brand" href="#">Panel personal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="cargarPagina('start-patients')">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="cargarPagina('appointments-patients')">Citas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="cargarPagina('invoices-patients')">Facturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="cargarPagina('shop')">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="cargarPagina('settings')">Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="cerrarSesion()">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4" id="contenido">
    <h2>Bienvenido a tu Panel de Pacientes</h2>
  </div>

  <script>
    // Función para cargar el contenido de una URL en un elemento HTML
    function cargarContenido(url, elemento) {
      $.ajax({
        url: url,
        method: 'GET',
        dataType: 'html',
        success: function(html) {
          // Asignar el HTML al contenido del elemento
          elemento.html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Error al cargar el contenido:', errorThrown);
        }
      });
    }
  </script>
  <script>
    $(document).ready(function() {
      // Obtener la referencia al elemento <main> con id "contenido"
      const contenido = $('#contenido');

      // Cargar el contenido de inicio.php
      cargarContenido('start-patients.php', contenido);
    });

    // Función para cargar la página y activar el botón correspondiente
    function cargarPagina(pagina) {
      // Realizar la petición Ajax con jQuery
      $.ajax({
        url: pagina + '.php',
        method: 'GET',
        dataType: 'html',
        success: function(data) {
          // Actualizar el contenido de la etiqueta main con la respuesta Ajax
          $('#contenido').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Error:', errorThrown);
        }
      });
    }
  </script>
  <script>
    function cerrarSesion() {
      // Realiza una solicitud AJAX a la API de cerrar sesión
      $.ajax({
        url: '../scripts/logout_manager.php', // Ruta de la API de cerrar sesión
        type: 'POST', // Método de la solicitud
        success: function(response) {
          // Redirige al usuario a index.php después de cerrar sesión
          window.location.href = '../index.php';
        },
        error: function(xhr, status, error) {
          // Maneja el error si ocurre
          console.error(error);
        }
      });
    }
  </script>

</body>

</html>