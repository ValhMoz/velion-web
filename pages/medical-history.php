<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/MedicalHistoryController.php';
if ($rol == "informe") {
    header("Location: 404.php");
    exit();
}
$medicalhistory = new MedicalHistoryController();
$informes = $medicalhistory->obtenerInformes();
include_once 'dashboard.php';
?>

<div class="container mt-5">

    <div class="d-flex align-items-start justify-content-between">
        <h1 class="mb-4">Historial Médico</h1>
        <?php if (isset($informe)) : ?><form action="../scripts/medicalhistory_manager.php" method="post"><button type="button" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                        <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                    </svg>
                    Generar Reporte</button></form><?php endif; ?>
    </div>

    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Escriba el ID del paciente..." oninput="showReport()">
    <datalist id="datalistOptions">
        <?php foreach ($informes as $informe) : ?>
            <option value="<?php echo($informe['paciente_id']); ?>">
        <?php endforeach; ?>

    </datalist>

    <?php if (isset($informe)) : ?>
        <!-- Información del informe -->
        <div class="card mb-4">
            <div class="card-header">
                Información del informe
            </div>
            <div class="card-body" id="informeSeleccionado">

                <h5 class="card-title">Nombre del informe: <?php echo $informe['nombre_paciente']; ?></h5>
                <p class="card-text">Fecha de nacimiento: <?php echo $informe['fecha_nacimiento_paciente']; ?> años</p>
                <p class="card-text">Género: <?php echo $informe['genero_paciente']; ?></p>
                <p class="card-text">Dirección: <?php echo $informe['direccion_paciente']  . " " . $informe['provincia_paciente'] . " " . $informe['cp_paciente'] ; ?></p>
                <p class="card-text">Teléfono: <?php echo $informe['telefono_paciente']; ?></p>
            </div>
        </div>


        <!-- Historial Médico -->
        <div class="card mb-4">
            <div class="card-header">
                Historial Médico
            </div>
            <div class="card-body">
                <h5 class="card-title">Fecha del informe: <?php echo $informe['fecha']; ?></h5>
                <p class="card-text">Diagnóstico: <?php echo $informe['diagnostico']; ?></p>
                <p class="card-text">Tratamiento: <?php echo $informe['tratamiento']; ?></p>
                <p class="card-text">Notas Adicionales: <?php echo $informe['notas']; ?></p>

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
    <?php endif; ?>

</div>

<script>
    function showReport() {
        var input = document.getElementById('exampleDataList');
        var selectedOption = input.value;
        var dataList = document.getElementById('datalistOptions');
        var options = dataList.getElementsByTagName('option');
        for (var i = 0; i < options.length; i++) {
            if (options[i].value === selectedOption) {
                var reportContent = JSON.parse(options[i].getAttribute('data-report'));
                var informeSeleccionadoDiv = document.getElementById('informeSeleccionado');
                informeSeleccionadoDiv.innerHTML = '<h2>Informe Seleccionado</h2>';
                for (var key in reportContent) {
                    if (reportContent.hasOwnProperty(key)) {
                        informeSeleccionadoDiv.innerHTML += '<p>' + key + ': ' + reportContent[key] + '</p>';
                    }
                }
                break;
            }
        }
    }
</script>

</main>

</body>

</html>
