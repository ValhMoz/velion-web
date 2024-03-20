<?php
require_once '../scripts/session_manager.php';
if($rol == "paciente"){
    header("Location: 404.php");
    exit();
}
require_once '../controllers/UserController.php';

$userController = new UserController();
$usuarios = $userController->obtenerUsuarios();
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Usuarios</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Agregar Usuario
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <!-- Nombre y Apellidos -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                    </div>

                    <!-- DNI y Género -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" pattern="\d{8}[A-Za-z]" title="Introduce un DNI válido (8 dígitos seguidos de una letra)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="genero" class="form-label">Género</label>
                            <select class="form-select" aria-label="Selecciona tu género">
                                <option selected>Selecciona tu género</option>
                                <option value="hombre">Hombre</option>
                                <option value="mujer">Mujer</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    <!-- Rol, Fecha de nacimiento, provincia y Municipio -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" aria-label="Selecciona tu rol">
                                <option selected>Selecciona tu rol</option>
                                <option value="administrador">Administrador</option>
                                <option value="paciente">Paciente</option>
                                <option value="fisioterapeuta">Fisioterapeuta</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                    </div>

                    <!-- Telefono, Dirección, provincia y Municipio -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" pattern="\d{8}[0-9]" title="Introduce un telefono válido, sin espacios (9 dígitos)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>

                    <!-- Correo electrónico, Contraseña y Código Postal -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="pass" minlength="8" name="pass" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="provincia" class="form-label">Provincia</label>
                            <select class="form-select" id="provincia" name="provincia" aria-label="Selecciona tu provincia">
                                <option selected>Selecciona tu provincia</option>
                                <option value="Córdoba">Córdoba</option>
                                <!-- Aquí puedes incluir las opciones de provincia -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="municipio" class="form-label">Municipio</label>
                            <select class="form-select" id="municipio">
                                <option value="">Selecciona un municipio</option>
                                <option value="Adamuz">Adamuz</option>
                                <option value="Aguilar de la Frontera">Aguilar de la Frontera</option>
                                <option value="Alcaracejos">Alcaracejos</option>
                                <option value="Almedinilla">Almedinilla</option>
                                <option value="Almodóvar del Río">Almodóvar del Río</option>
                                <option value="Añora">Añora</option>
                                <option value="Baena">Baena</option>
                                <option value="Belalcázar">Belalcázar</option>
                                <option value="Belmez">Belmez</option>
                                <option value="Benamejí">Benamejí</option>
                                <option value="Blázquez, Los">Blázquez, Los</option>
                                <option value="Bujalance">Bujalance</option>
                                <option value="Cabra">Cabra</option>
                                <option value="Cañete de las Torres">Cañete de las Torres</option>
                                <option value="Carcabuey">Carcabuey</option>
                                <option value="Cardeña">Cardeña</option>
                                <option value="Carlota, La">Carlota, La</option>
                                <option value="Carpio, El">Carpio, El</option>
                                <option value="Castro del Río">Castro del Río</option>
                                <option value="Conquista">Conquista</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Doña Mencía">Doña Mencía</option>
                                <option value="Dos Torres">Dos Torres</option>
                                <option value="Encinas Reales">Encinas Reales</option>
                                <option value="Espejo">Espejo</option>
                                <option value="Espiel">Espiel</option>
                                <option value="Fernán-Núñez">Fernán-Núñez</option>
                                <option value="Fuente la Lancha">Fuente la Lancha</option>
                                <option value="Fuente Obejuna">Fuente Obejuna</option>
                                <option value="Fuente Palmera">Fuente Palmera</option>
                                <option value="Fuente-Tójar">Fuente-Tójar</option>
                                <option value="Granjuela, La">Granjuela, La</option>
                                <option value="Guadalcázar">Guadalcázar</option>
                                <option value="Guijo, El">Guijo, El</option>
                                <option value="Hinojosa del Duque">Hinojosa del Duque</option>
                                <option value="Hornachuelos">Hornachuelos</option>
                                <option value="Iznájar">Iznájar</option>
                                <option value="Lucena">Lucena</option>
                                <option value="Luque">Luque</option>
                                <option value="Montalbán de Córdoba">Montalbán de Córdoba</option>
                                <option value="Montemayor">Montemayor</option>
                                <option value="Montilla">Montilla</option>
                                <option value="Montoro">Montoro</option>
                                <option value="Monturque">Monturque</option>
                                <option value="Moriles">Moriles</option>
                                <option value="Nueva Carteya">Nueva Carteya</option>
                                <option value="Obejo">Obejo</option>
                                <option value="Palenciana">Palenciana</option>
                                <option value="Palma del Río">Palma del Río</option>
                                <option value="Pedro Abad">Pedro Abad</option>
                                <option value="Pedroche">Pedroche</option>
                                <option value="Peñarroya-Pueblonuevo">Peñarroya-Pueblonuevo</option>
                                <option value="Posadas">Posadas</option>
                                <option value="Pozoblanco">Pozoblanco</option>
                                <option value="Priego de Córdoba">Priego de Córdoba</option>
                                <option value="Puente Genil">Puente Genil</option>
                                <option value="Rambla, La">Rambla, La</option>
                                <option value="Rute">Rute</option>
                                <option value="San Sebastián de los Ballesteros">San Sebastián de los Ballesteros</option>
                                <option value="Santa Eufemia">Santa Eufemia</option>
                                <option value="Santaella">Santaella</option>
                                <option value="Torrecampo">Torrecampo</option>
                                <option value="Valenzuela">Valenzuela</option>
                                <option value="Valsequillo">Valsequillo</option>
                                <option value="Victoria, La">Victoria, La</option>
                                <option value="Villa del Río">Villa del Río</option>
                                <option value="Villafranca de Córdoba">Villafranca de Córdoba</option>
                                <option value="Villaharta">Villaharta</option>
                                <option value="Villanueva de Córdoba">Villanueva de Córdoba</option>
                                <option value="Villanueva del Duque">Villanueva del Duque</option>
                                <option value="Villanueva del Rey">Villanueva del Rey</option>
                                <option value="Villaralto">Villaralto</option>
                                <option value="Villaviciosa de Córdoba">Villaviciosa de Córdoba</option>
                                <option value="Viso, El">Viso, El</option>
                                <option value="Zuheros">Zuheros</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cp" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="cp" name="cp" pattern="[0-9]{5}" title="Introduce un código postal válido (5 dígitos)" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Agregar Usuario</button>
            </div>
        </div>
    </div>
</div>



<div class="table-responsive small">
    <form class="row g-3">
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Filtro</label>
            <input type="text" class="form-control" id="inputPassword2" placeholder="Filtrar por ID...">
        </div>
        <div class="col-auto">
            <input type="text" class="form-control" id="inputPassword2" placeholder="Filtrar por nombre...">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Filtrar</button>
        </div>
    </form>


    <div class="row">
        <!-- Aquí se mostrarán los usuarios en forma de tabla -->
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">ID</th>
                            <th scope="col" style="width: 15%;">Nombre</th>
                            <th scope="col" style="width: 15%;">Apellidos</th>
                            <th scope="col" style="width: 15%;">Email</th>
                            <th scope="col" style="width: 10%;">Teléfono</th>
                            <th scope="col" style="width: 10%;">Ses.Dis.</th>
                            <th scope="col" style="width: 10%;">Rol</th>
                            <th scope="col" style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td><?php echo $usuario['usuario_id']; ?></td>
                                <td><?php echo $usuario['nombre']; ?></td>
                                <td><?php echo $usuario['apellidos']; ?></td>
                                <td><?php echo $usuario['email']; ?></td>
                                <td><?php echo $usuario['telefono']; ?></td>
                                <td><?php echo $usuario['sesiones_disponibles']; ?></td>
                                <td><?php echo $usuario['rol']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm">Ver</button>
                                    <button type="button" class="btn btn-warning btn-sm">Editar</button>
                                    <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

    <script>
        // Función para actualizar el modal según la acción seleccionada
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var action = button.data('action'); // Acción seleccionada
            var modal = $(this);

            // Actualizar título y acción del formulario según la acción seleccionada
            if (action === 'agregar') {
                modal.find('.modal-title').text('Agregar Usuario');
                modal.find('#actionType').val('agregar');
                modal.find('.modal-footer button').text('Agregar Usuario');
            } else if (action === 'ver') {
                modal.find('.modal-title').text('Ver Usuario');
                modal.find('#actionType').val('ver');
                modal.find('.modal-footer button').text('Cerrar');
            } else if (action === 'editar') {
                modal.find('.modal-title').text('Editar Usuario');
                modal.find('#actionType').val('editar');
                modal.find('.modal-footer button').text('Guardar Cambios');
            }
        });
    </script>

</div>