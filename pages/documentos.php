<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/DocumentoController.php';

$documentoController = new documentoController();

if (!$_GET) {
    header('location:documentos.php?pagina=1');
}

$articulos_x_pagina = 10;

$documentos = $documentoController->obtenerDocumentos();
// echo(json_encode($documentos));

$iniciar = ($_GET['pagina'] - 1) * $articulos_x_pagina;

// // Obtener el valor del filtro, si está presente en la URL
$filtro_documento_id = isset($_POST['estado']) ? $_POST['estado'] : '';

// Obtener documentos aplicando los filtros si es necesario
if (!empty($filtro_documento_id)) {
    // Si se aplica al menos un filtro
    $documentosPaginados = $documentoController->buscarDocumentos($filtro_documento_id);
} else {
    // Si no se aplican filtros, obtener documentos paginados
    $documentosPaginados = $documentoController->obtenerDocumentosPaginados($iniciar, $articulos_x_pagina);
}

$n_botones_paginacion = ceil(count($documentos) / ($articulos_x_pagina));

if ($_GET['pagina'] > $n_botones_paginacion) {
    header('location:documentos.php?pagina=1');
}

if ($rol == "Paciente") {
    include_once './includes/dashboard-patients.php';
}else{
    include_once './includes/dashboard.php';
}

include_once './modals/documentos/add_modal.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestión de Documentos</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
            <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793l.896-.443zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
        </svg>
        Subir documento
    </button>
</div>

<?php
// Verificar si hay una alerta de usuario
if (isset($_SESSION['alert'])) {
    // Mostrar la alerta
    echo '<div class="alert alert-' . $_SESSION['alert']['type'] . ' alert-dismissible fade show" role="alert">' . $_SESSION['alert']['message'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    unset($_SESSION['alert']);
}
?>

<form class="row g-3" method="post" action="">
    <div class="col-auto">
        <input type="text" class="form-control" id="usuario_id" name="usuario_id" placeholder="Filtrar por ID de usuario...">
    </div>
    <div class="col-auto">
        <select class="form-select" id="estado" name="estado" aria-label="Selecciona un estado">
            <option selected hidden>Selecciona un estado</option>
            <option value="Firmado">Firmado</option>
            <option value="Pendiente">Pendiente</option>
        </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Filtrar</button>
    </div>
</form>

<!-- Lista de documentos -->
<h2 class="mt-2">Documentos Pendientes de Firma</h2>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha de Subida</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Obtener documentos del paciente (ejemplo con paciente_id = 1)
        // $documentos = (new DocumentoController())->obtenerDocumentosPorPaciente(1);
        foreach ($documentos as $documento) {
            echo '<tr>
                            <td>' . $documento['documento_id'] . '</td>
                            <td>' . $documento['nombre'] . '</td>
                            <td>' . $documento['descripcion'] . '</td>
                            <td>' . $documento['fecha_subida'] . '</td>
                            <td>' . $documento['estado'] . '</td>
                            <td>
                                <a href="../scripts/documento_manager.php?action=firmar&documento_id=' . $documento['documento_id'] . '" class="btn btn-success btn-sm">Firmar</a>
                                <a href="../scripts/documento_manager.php?action=rechazar&documento_id=' . $documento['documento_id'] . '" class="btn btn-danger btn-sm">Rechazar</a>
                            </td>
                        </tr>';
        }
        ?>
    </tbody>
</table>
</div>
</body>

</html>