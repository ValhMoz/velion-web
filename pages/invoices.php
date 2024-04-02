<?php
require_once '../scripts/session_manager.php';
if ($rol == "paciente") {
    header("Location: 404.php");
    exit();
}
include '../controllers/InvoiceController.php';

// Crear una instancia del controlador de facturas
$invoiceController = new InvoiceController();

// Obtener todas las facturas
$facturas = $invoiceController->obtenerFacturas();
include_once 'dashboard.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Facturas</h1>
</div>

<!-- Modal eliminar factura -->
<div class="modal" id="eliminarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Deseas eliminar esta factura?</p>
            </div>
            <div class="modal-footer">
                <form action="../scripts/user_manager.php" method="post">
                    <input type="hidden" id="actionType" name="action" value="eliminar">
                    <button type="submit" class="btn btn-danger">Eliminar factura</button>
                </form>
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
                            <th scope="col" style="width: 5%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($facturas as $factura) : ?>
                            <tr>
                                <td><?php echo $factura['paciente_id']; ?></td>
                                <td><?php echo $factura['nombre']; ?></td>
                                <td><?php echo $factura['apellidos']; ?></td>
                                <td><?php echo $factura['fecha_emision']; ?></td>
                                <td><?php echo $factura['estado']; ?></td>
                                <td><?php echo $factura['monto']; ?>€</td>
                                <td>
                                    <form style="width: fit-content;" action="../../scripts/invoice_manager.php" method="GET">
                                        <input type="hidden" name="id" value="<?php echo $factura['factura_id']; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                            </svg></button>
                                        <button type="button" class="btn btn-danger btn-sm d-inline" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-action="eliminar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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

</main>

</body>

</html>