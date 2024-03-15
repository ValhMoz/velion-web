<?php
    require_once '../../scripts/session_manager.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Facturas</h1>
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
    <!-- Aquí se mostrarán las facturas en forma de tabla -->
    <div class="col">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">ID</th>
                        <th scope="col" style="width: 15%;">Nombre</th>
                        <th scope="col" style="width: 15%;">Apellidos</th>
                        <th scope="col" style="width: 15%;">Fecha de Emisión</th>
                        <th scope="col" style="width: 15%;">Estado</th>
                        <th scope="col" style="width: 15%;">Monto</th>
                        <th scope="col" style="width: 15%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nombre1</td>
                        <td>Apellidos1</td>
                        <td>12/03/2024</td>
                        <td>Pagada</td>
                        <td>$100</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">Descargar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Nombre2</td>
                        <td>Apellidos2</td>
                        <td>14/03/2024</td>
                        <td>Pendiente</td>
                        <td>$150</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">Descargar</button>
                        </td>
                    </tr>
                    <!-- Repite estas filas para cada factura -->
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
</div>