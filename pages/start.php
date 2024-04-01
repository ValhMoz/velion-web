<?php
require_once '../scripts/session_manager.php';
if ($rol == "paciente") {
    header("Location: 404.php");
    exit();
}
require_once '../controllers/AppointmentController.php';

$appoinmentController = new AppointmentController();
$citas = $appoinmentController->obtenerCitasHoy();
include_once 'dashboard.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bienvenid@, <?php echo $nombre ?> </h1>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Citas de hoy</h1>
</div>

<div class="table-responsive small">
    <form class="row g-3">
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Filtro</label>
            <input type="text" class="form-control" id="inputPassword2" placeholder="Filtrar por nombre...">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Filtrar</button>
        </div>
    </form>
    <div class="row">
        <!-- Aquí se mostrarán las citas en forma de tabla -->
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">ID</th>
                            <th scope="col" style="width: 15%;">Fecha</th>
                            <th scope="col" style="width: 15%;">Hora</th>
                            <th scope="col" style="width: 25%;">Fisioterapeuta asociado</th>
                            <th scope="col" style="width: 25%;">Paciente</th>
                            <th scope="col" style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($citas as $cita) : ?>
                            <tr>
                                <td><?php echo $cita['cita_id']; ?></td>
                                <td><?php echo $cita['fecha_hora']; ?></td>
                                <td><?php echo $cita['hora']; ?></td>
                                <td><?php echo $cita['nombre_fisioterapeuta']; ?></td>
                                <td><?php echo $cita['nombre_paciente']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm">Confirmar</button>
                                    <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-start">
        <li class="page-item disabled">
            <a class="page-link">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>

</div>

</main>

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