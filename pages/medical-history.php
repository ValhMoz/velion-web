<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/MedicalHistoryController.php';
if ($rol == "paciente") {
    header("Location: 404.php");
    exit();
}
$medicalhistory = new MedicalHistoryController();
$informes = $medicalhistory->obtenerInformes();
?>

<div class="container mt-5">

    <div class="d-flex align-items-start justify-content-between">
        <h1 class="mb-4">Historial Médico</h1>
        <?php if (isset($paciente)) : ?><form action="../scripts/medicalhistory_manager.php" method="post"><button type="button" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                        <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                    </svg>
                    Generar Reporte</button></form>><?php endif; ?>
    </div>


    <!-- Formulario de búsqueda -->
    <form action="../scripts/medicalhistory_manager.php" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="dni" placeholder="Buscar paciente por DNI" aria-label="Buscar paciente por DNI" aria-describedby="button-buscar">
            <button class="btn btn-outline-primary" type="submit" id="button-buscar" name="buscar">Buscar</button>
        </div>
    </form>

    <?php if (isset($paciente)) : ?>
        <!-- Información del paciente -->
        <div class="card mb-4">
            <div class="card-header">
                Información del Paciente
            </div>
            <div class="card-body">

                <h5 class="card-title">Nombre del Paciente: <?php echo $paciente['nombre']; ?></h5>
                <p class="card-text">Fecha de nacimiento: <?php echo $paciente['edad']; ?> años</p>
                <p class="card-text">Género: <?php echo $paciente['genero']; ?></p>
                <p class="card-text">Dirección: <?php echo $paciente['direccion']; ?></p>
                <p class="card-text">Teléfono: <?php echo $paciente['telefono']; ?></p>
            </div>
        </div>


        <!-- Historial Médico -->
        <div class="card mb-4">
            <div class="card-header">
                Historial Médico
            </div>
            <div class="card-body">

                <h5 class="card-title">Última Consulta: <?php echo $paciente['fecha_hora']; ?></h5>
                <p class="card-text">Diagnóstico: <?php echo $paciente['diagnostico']; ?></p>
                <p class="card-text">Tratamiento: <?php echo $paciente['tratamiento']; ?></p>
                <p class="card-text">Notas Adicionales: <?php echo $paciente['notas']; ?></p>

            </div>
        </div>

        <!-- Formulario para modificar datos médicos -->
        <div class="card">
            <div class="card-header">
                Modificar Datos Médicos
            </div>
            <div class="card-body">
                <form action="../scripts/medicalhistory_manager.php" method="post">
                    <div class="mb-3">
                        <label for="diagnostico" class="form-label">Nuevo Diagnóstico</label>
                        <textarea class="form-control" id="diagnostico" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tratamiento" class="form-label">Nuevo Tratamiento</label>
                        <textarea class="form-control" id="tratamiento" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notas" class="form-label">Nuevas Notas Adicionales</label>
                        <textarea class="form-control" id="notas" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
</div>
<?php endif; ?>