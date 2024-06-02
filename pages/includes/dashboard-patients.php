<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Pacientes</title>
  <link href="../assets/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/custom/css/userdetail.css">
  <script src="../assets/bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/custom/js/timeout.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="../assets/bootstrap-5.3/js/color-modes.js"></script>
  <script src="../assets/custom/js/logout.js"></script>
</head>

<body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
      <a class="navbar-brand" href="#">Panel personal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="start-patients.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="appointments-patients.php">Citas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="invoices-patients.php">Facturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="userdetail.php?usuario_id=<?php echo $DNI ?>">Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="cerrarSesion()">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4" id="contenido">