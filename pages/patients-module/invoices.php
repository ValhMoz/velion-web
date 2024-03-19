<?php
    include '../../scripts/session_manager.php';
    // include '../../controllers/InvoiceController.php';

    // // Crear una instancia del controlador de facturas
    // $invoiceController = new InvoiceController();

    // // Obtener todas las facturas
    // $facturas = $invoiceController->obtenerFacturas();

    // // Función para formatear la fecha
    // function formatFecha($fecha) {
    //     return date('d/m/Y', strtotime($fecha));
    // }
    var_dump($facturas)
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Facturas</h1>
</div>

<div class="table-responsive small">
    <form class="row g-3">
        <!-- Filtros de búsqueda (si es necesario) -->
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
                        <?php foreach ($facturas as $factura): ?>
                            <tr>
                                <td><?php echo $factura['id']; ?></td>
                                <td><?php echo $factura['nombre']; ?></td>
                                <td><?php echo $factura['apellidos']; ?></td>
                                <td><?php echo $factura['fecha_emision']; ?></td>
                                <td><?php echo $factura['estado']; ?></td>
                                <td><?php echo $factura['monto']; ?>$</td>
                                <td><a href="descargar_factura.php?id=<?php echo $factura['id']; ?>" class="btn btn-primary btn-sm">Descargar</a></td>
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
        <!-- Paginación (si es necesario) -->
    </ul>
</nav>
