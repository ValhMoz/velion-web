<?php
    require_once '../scripts/session_manager.php';
    if($rol == "paciente"){
        header("Location: 404.php");
        exit();
    }
    include '../controllers/InvoiceController.php';

    // Crear una instancia del controlador de facturas
    $invoiceController = new InvoiceController();

    // Obtener todas las facturas
    $facturas = $invoiceController->obtenerFacturas();
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
                <?php foreach ($facturas as $factura) : ?>
                            <tr>
                                <td><?php echo $factura['paciente_id']; ?></td>
                                <td><?php echo $factura['nombre']; ?></td>
                                <td><?php echo $factura['apellidos']; ?></td>
                                <td><?php echo $factura['fecha_emision']; ?></td>
                                <td><?php echo $factura['estado']; ?></td>
                                <td><?php echo $factura['monto']; ?>€</td>
                                <td>
                                    <form action="../../scripts/descargar_factura.php" method="GET">
                                        <input type="hidden" name="id" value="<?php echo $factura['factura_id']; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm" style="padding: 6px 12px;">Descargar</button>
                                    </form>
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
</div>