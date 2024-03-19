<?php
require_once '../scripts/session_manager.php';
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
                        <tr>
                            <td>1</td>
                            <td>12/03/2024</td>
                            <td>10:00</td>
                            <td>Información sobre la cita 1.</td>
                            <td>Paciente 1</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Confirmar</button>
                                <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>14/03/2024</td>
                            <td>11:00</td>
                            <td>Información sobre la cita 2.</td>
                            <td>Paciente 2</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Confirmar</button>
                                <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <!-- Repite estas filas para cada cita -->
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