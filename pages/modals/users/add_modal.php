<!-- Modal agregar usuario -->
<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../scripts/user_manager.php" method="post">
                <div class="modal-body">
                    <input type="hidden" id="actionType" name="action" value="agregar">

                    <div id="userDetails">
                        <!-- Nombre y Apellidos -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                        </div>

                        <!-- DNI y Género -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="usuario_id" pattern="\d{8}[A-Za-z]" title="Introduce un DNI válido (8 dígitos seguidos de una letra)" required>
                            </div>
                            <div class="col-md-6">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-select" id="genero" name="genero" aria-label="Selecciona tu género">
                                    <option selected>Selecciona tu género</option>
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>

                        <!-- Rol, Fecha de nacimiento -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="rol" class="form-label">Rol</label>
                                <select class="form-select" id="rol" name="rol" aria-label="Selecciona tu rol">
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

                        <!-- Telefono, Dirección -->
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

                        <!-- Correo electrónico, Contraseña, Provincia, Municipio y Código Postal -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="pass" name="pass" minlength="8" name="pass" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="provincia" class="form-label">Provincia</label>
                                <input type="text" class="form-control" id="provincia" name="provincia" required>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="municipio" class="form-label">Municipio</label>
                                <input type="text" class="form-control" id="municipio" name="municipio" required>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cp" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="cp" name="cp" pattern="[0-9]{5}" title="Introduce un código postal válido (5 dígitos)" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>