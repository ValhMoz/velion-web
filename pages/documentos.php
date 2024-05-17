<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/DocumentoController.php';

// $userController = new UserController();

if ($rol == "Paciente") {
    header("Location: 404.php");
    exit();
}

// if (!$_GET) {
//     header('location:users.php?pagina=1');
// }


// $articulos_x_pagina = 10;

// $usuarios = $userController->obtenerUsuarios();

// $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pagina;

// // Obtener el valor de los filtros, si están presentes en el formulario
// $filtro_usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : '';
// $filtro_rol = isset($_POST['rol']) ? $_POST['rol'] : '';

// // Obtener usuarios aplicando los filtros si es necesario
// if (!empty($filtro_usuario_id) || !empty($filtro_rol)) {
//     // Si se aplica al menos un filtro
//     $usuariosPaginados = $userController->buscarUsuarios($filtro_usuario_id, $filtro_rol);
// } else {
//     // Si no se aplican filtros, obtener usuarios paginados
//     $usuariosPaginados = $userController->obtenerUsuariosPaginados($iniciar, $articulos_x_pagina);
// }


// // // Obtener el valor del filtro, si está presente en la URL
// // $filtro_usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : '';


// // // Obtener usuarios aplicando el filtro si es necesario
// // if (!empty($filtro_usuario_id)) {
// //     $usuariosPaginados = $userController->obtenerUsuariosPorID($filtro_usuario_id);
// // } else {
// //     $usuariosPaginados = $userController->obtenerUsuariosPaginados($iniciar, $articulos_x_pagina);
// // }

// $n_botones_paginacion = ceil(count($usuarios) / ($articulos_x_pagina));



// if ($_GET['pagina'] > $n_botones_paginacion) {
//     header('location:users.php?pagina=1');
// }


include_once './includes/dashboard.php';
include_once './modals/users/add_modal.php';

?>

<div class="container">
    <h1 class="mt-5">Gestión de Documentos</h1>
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

    <!-- Formulario para subir documentos -->
    <form action="../scripts/documento_manager.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del documento</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="ruta_documento" class="form-label">Seleccionar documento</label>
            <input class="form-control" type="file" id="ruta_documento" name="ruta_documento" required>
        </div>
        <div class="mb-3">
            <label for="paciente_id" class="form-label">ID del Paciente</label>
            <input type="text" class="form-control" id="paciente_id" name="paciente_id" required>
        </div>
        <div class="mb-3">
            <label for="sanitario_id" class="form-label">ID del Sanitario</label>
            <input type="text" class="form-control" id="sanitario_id" name="sanitario_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir Documento</button>
    </form>

    <!-- Lista de documentos -->
    <h2 class="mt-5">Documentos Pendientes de Firma</h2>
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
            $documentos = (new DocumentoController())->obtenerDocumentosPorPaciente(1);
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