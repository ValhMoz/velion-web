<?php
    require_once '../scripts/session_manager.php';
?>

       <div class="container mt-5">
        <h1 class="mb-4">Historial Médico</h1>

        <!-- Filtro de búsqueda -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Buscar paciente" aria-label="Buscar paciente" aria-describedby="button-buscar">
            <button class="btn btn-outline-primary" type="button" id="button-buscar">Buscar</button>
        </div>

        <!-- Información del paciente -->
        <div class="card mb-4">
            <div class="card-header">
                Información del Paciente
            </div>
            <div class="card-body">
                <h5 class="card-title">Nombre del Paciente: John Doe</h5>
                <p class="card-text">Edad: 30 años</p>
                <p class="card-text">Género: Masculino</p>
                <p class="card-text">Altura: 170 cm</p>
                <p class="card-text">Peso: 70 kg</p>
            </div>
        </div>

        <!-- Historial Médico -->
        <div class="card mb-4">
            <div class="card-header">
                Historial Médico
            </div>
            <div class="card-body">
                <h5 class="card-title">Última Consulta: 01/03/2024</h5>
                <p class="card-text">Diagnóstico: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="card-text">Tratamiento: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="card-text">Notas Adicionales: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>

        <!-- Formulario para modificar datos médicos -->
        <div class="card">
            <div class="card-header">
                Modificar Datos Médicos
            </div>
            <div class="card-body">
                <form>
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

        <!-- Botón para generar reporte -->
        <div class="mt-4">
            <button type="button" class="btn btn-success">Generar Reporte</button>
        </div>
    </div>
