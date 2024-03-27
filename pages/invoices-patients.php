<?php
include '../scripts/session_manager.php';
if($rol == "administrador" ||  $rol == "fisioterapeuta")
{
    header("Location: 404.php");
    exit();
}
include '../controllers/InvoiceController.php';

// Crear una instancia del controlador de facturas
$invoiceController = new InvoiceController();

// Obtener todas las facturas
$facturas = $invoiceController->obtenerFacturasUsuario($DNI);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Facturas</h1>
</div>

<div class="table-responsive small">
    <form class="row g-3">
        <div class="col-auto">
            <input type="date" class="form-control" id="">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Filtrar</button>
        </div>
    </form>
    <div class="row">
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
                                    <form action="../scripts/invoice_manager.php" method="GET">
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
