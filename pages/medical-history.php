<?php
    require_once '../scripts/session_manager.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Paciente</title>
    <link href="../assets/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/bootstrap-5.3/css/dashboard.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Perfil del Paciente</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" value="Juan" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" value="Pérez Gómez" disabled>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" value="123456789" disabled>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" value="Calle Principal, 123" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" value="juan@example.com" disabled>
                        </div>
                        <div class="form-group">
                            <label for="genero">Género:</label>
                            <input type="text" class="form-control" id="genero" value="Masculino" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
