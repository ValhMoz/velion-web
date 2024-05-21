<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles del Paciente - Gestión de Clínicas</title>
  <link href="../assets/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/bootstrap-5.3/css/dashboard.css" rel="stylesheet">
  <script src="../assets/bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/custom/js/timeout.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="../assets/bootstrap-5.3/js/color-modes.js"></script>
  <script src="../assets/custom/js/logout.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .profile-header {
      background: url('https://via.placeholder.com/1200x400') no-repeat center center;
      background-size: cover;
      height: 250px;
      position: relative;
    }
    .profile-picture {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      border: 5px solid #fff;
      position: absolute;
      bottom: -75px;
      left: 20px;
    }
    .profile-info {
      margin-top: 80px;
    }
    .profile-info h1 {
      margin-bottom: 0;
    }
    .profile-info p {
      color: #6c757d;
    }
    .nav-pills .nav-link {
      border-radius: 0;
      color: #495057;
    }
    .nav-pills .nav-link.active {
      background-color: #0d6efd;
    }
    .content-section {
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="profile-header">
      <img src="https://via.placeholder.com/150" alt="Foto de Perfil" class="profile-picture">
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="profile-info text-center">
          <h1>Juan Pérez</h1>
          <p>Paciente</p>
        </div>
      </div>
      <div class="col-md-9">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-about-tab" data-bs-toggle="pill" data-bs-target="#pills-about" type="button" role="tab" aria-controls="pills-about" aria-selected="true">Acerca de</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-appointments-tab" data-bs-toggle="pill" data-bs-target="#pills-appointments" type="button" role="tab" aria-controls="pills-appointments" aria-selected="false">Citas</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-history-tab" data-bs-toggle="pill" data-bs-target="#pills-history" type="button" role="tab" aria-controls="pills-history" aria-selected="false">Historial Médico</button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
            <div class="content-section">
              <h3>Acerca de</h3>
              <p>Juan Pérez es un paciente de 45 años que ha estado bajo nuestro cuidado desde 2015. Vive en Ciudad de México y trabaja como ingeniero. En su tiempo libre, disfruta de la lectura y el senderismo.</p>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-appointments" role="tabpanel" aria-labelledby="pills-appointments-tab">
            <div class="content-section">
              <h3>Próximas Citas</h3>
              <ul class="list-group">
                <li class="list-group-item">20/05/2024 - Consulta de seguimiento</li>
                <li class="list-group-item">25/05/2024 - Examen de sangre</li>
                <li class="list-group-item">30/05/2024 - Evaluación de ECG</li>
              </ul>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab">
            <div class="content-section">
              <h3>Historial Médico</h3>
              <ul class="list-group">
                <li class="list-group-item">15/04/2024 - Tratamiento para hipertensión</li>
                <li class="list-group-item">12/03/2024 - Consulta general</li>
                <li class="list-group-item">20/01/2024 - Evaluación de colesterol</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
