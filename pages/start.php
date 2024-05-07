<?php
require_once '../scripts/session_manager.php';
include_once './includes/dashboard.php';

if ($rol == "Paciente") {
    header("Location: 404.php");
    exit();
}

?>

<div class="container">
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <!-- Tarjeta de usuarios registrados -->
            <div class="col">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios Registrados</h5>
                        <p class="card-text fs-1">500</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de fisioterapeutas -->
            <div class="col">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Fisioterapeutas</h5>
                        <p class="card-text fs-1">50</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de facturas -->
            <div class="col">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Facturas</h5>
                        <p class="card-text fs-1">200</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de citas -->
            <div class="col">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Citas</h5>
                        <p class="card-text fs-1">1000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" container mt-5">
        <div class="col">
            <div>
                <h4>Bienvenido</h4>
                <p>Creado por: Sergio Física y Miguel Ortega</p>
                <p>Github: <a href="https://github.com/Z2V-LABS/clinic-managment-web">https://github.com/Z2V-LABS/clinic-managment-web</a></p>
                <p>Uso básico: Navega entre las diferentes opciones del menu lateral izquierdo haciendo clic en los botones.</p>
            </div>
        </div>
    </div>
</div>

</main>

</body>

</html>