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
  <style>
    body {
      background-image: url('../assets/custom/img/fondo-patients.png');
    }

    .navbar-dark .navbar-nav .nav-link {
      color: #000 !important;
    }

    .navbar-dark .navbar-brand {
      color: #000 !important;
    }

    .navbar-dark .navbar-toggler-icon {
      filter: invert(1);
    }

    .custom-bg {
      background-image: url('../assets/custom/img/fondo-patients.png');
    }

    .custom-blur {
      backdrop-filter: blur(40px);
      border: 2px solid #222;
      color: #000 !important;
      background: none;
    }

    .custom-bg-color {
      background-color: #222;
      border: none;
      color: #FFFFFF;
    }

    .rounded-table {
      border-radius: 6px;
      overflow: hidden;
      /* Esto asegura que el contenido dentro de la tabla no se desborde */
    }

    .custom-btn {
      background-color: #222;
      /* Fondo oscuro */
      color: white;
      /* Texto blanco */
      border-color: #222;
      /* Borde del mismo color que el fondo */
    }
  </style>
</head>

<body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark shadow">
    <div class="container">
      <img src="../assets/custom/img/foto_perfil.jpg" alt="Foto de Perfil" class="rounded-circle me-2"
        style="width: 30px; height: 30px;">
      <a class="navbar-brand" href="#"><?php echo $nombre . ' ' . $apellidos; ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="start-patients.php">
              <i class="bi bi-house-door"></i> Inicio
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="appointments-patients.php">
              <i class="bi bi-calendar"></i> Citas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="invoices-patients.php">
              <i class="bi bi-receipt"></i> Facturas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">
              <i class="bi bi-shop"></i> Tienda
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="userdetail.php?usuario_id=<?php echo $DNI ?>">
              <i class="bi bi-person"></i> Perfil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="cerrarSesion()">
              <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4" id="contenido">