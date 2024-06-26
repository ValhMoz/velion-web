<?php
// if ($rol == "Paciente") {
//     header("Location: 404.php");
//     exit();
// }

// if (!$_GET) {
//     header('location:users.php?pagina=1');
// }

include_once './includes/dashboard.php';
?>

<div class="container mt-5">
        <h1 class="mb-4">Pedir Cita</h1>
        <form action="../controllers/AppointmentController.php?action=book" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad</label>
                <select id="especialidad" name="especialidad" class="form-select" required>
                    <option value="">Seleccione una especialidad</option>
                    <!-- Opciones de especialidades cargadas dinámicamente -->
                </select>
                <div class="invalid-feedback">Por favor, seleccione una especialidad.</div>
            </div>
            <div class="mb-3">
                <label for="fisioterapeuta" class="form-label">Fisioterapeuta</label>
                <select id="fisioterapeuta" name="fisioterapeuta" class="form-select" required>
                    <option value="">Seleccione un fisioterapeuta</option>
                    <!-- Opciones de fisioterapeutas cargadas dinámicamente -->
                </select>
                <div class="invalid-feedback">Por favor, seleccione un fisioterapeuta.</div>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control" required>
                <div class="invalid-feedback">Por favor, seleccione una fecha.</div>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <select id="hora" name="fecha_hora" class="form-select" required>
                    <option value="">Seleccione una hora</option>
                    <!-- Opciones de horas disponibles cargadas dinámicamente -->
                </select>
                <div class="invalid-feedback">Por favor, seleccione una hora.</div>
            </div>
            <input type="hidden" name="paciente_id" value="<?php echo $_SESSION['usuario_id']; ?>">
            <button type="submit" class="btn btn-primary">Reservar Cita</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Cargar especialidades al cargar la página
            $.ajax({
                url: '../controllers/AppointmentController.php',
                type: 'GET',
                data: { action: 'obtenerEspecialidades' },
                success: function(response) {
                    var especialidades = JSON.parse(response);
                    especialidades.forEach(function(especialidad) {
                        $('#especialidad').append(new Option(especialidad.descripcion, especialidad.especialidad_id));
                    });
                }
            });

            // Cargar fisioterapeutas según la especialidad seleccionada
            $('#especialidad').change(function() {
                var especialidad_id = $(this).val();
                $.ajax({
                    url: '../controllers/AppointmentController.php',
                    type: 'GET',
                    data: { action: 'obtenerFisioterapeutasPorEspecialidad', especialidad_id: especialidad_id },
                    success: function(response) {
                        $('#fisioterapeuta').empty().append(new Option('Seleccione un fisioterapeuta', ''));
                        var fisioterapeutas = JSON.parse(response);
                        fisioterapeutas.forEach(function(fisioterapeuta) {
                            $('#fisioterapeuta').append(new Option(fisioterapeuta.nombre + ' ' + fisioterapeuta.apellidos, fisioterapeuta.usuario_id));
                        });
                    }
                });
            });

            // Cargar horas disponibles según la fecha seleccionada y el fisioterapeuta
            $('#fecha, #fisioterapeuta').change(function() {
                var fecha = $('#fecha').val();
                var fisioterapeuta_id = $('#fisioterapeuta').val();
                if (fecha && fisioterapeuta_id) {
                    $.ajax({
                        url: '../controllers/AppointmentController.php',
                        type: 'GET',
                        data: { action: 'obtenerHorasDisponibles', fecha: fecha, fisioterapeuta_id: fisioterapeuta_id },
                        success: function(response) {
                            $('#hora').empty().append(new Option('Seleccione una hora', ''));
                            var horas = JSON.parse(response);
                            horas.forEach(function(hora) {
                                $('#hora').append(new Option(hora, hora));
                            });
                        }
                    });
                }
            });

            // Validación de formulario Bootstrap
            (function() {
                'use strict';
                var forms = document.querySelectorAll('.needs-validation');
                Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            })();
        });
    </script>

</div>

</main>

</body>

</html>