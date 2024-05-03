<?php
require_once '../scripts/session_manager.php';
include '../controllers/InvoiceController.php';
$invoiceController = new InvoiceController();

if ($rol == "paciente") {
    header("Location: 404.php");
    exit();
}

$articulos_x_pagina = 10;

if(!$_GET){
    header ('location:invoices.php?pagina=1');
}

$iniciar = ($_GET['pagina']-1)*$articulos_x_pagina;

$facturas = $invoiceController->obtenerFacturas();

$facturasPaginadas = $invoiceController->obtenerFacturasPaginadas($iniciar, $articulos_x_pagina);

$n_botones_paginacion = ceil(count($facturas)/($articulos_x_pagina));

if($_GET['pagina']>$n_botones_paginacion){
    header ('location:invoices.php?pagina=1');
}

include_once './includes/dashboard.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Facturas</h1>
</div>

<?php
// Verificar si hay una alerta de usuario
if (isset($_SESSION['alert'])) {
    $alert_type = $_SESSION['alert']['type'];
    $alert_message = $_SESSION['alert']['message'];
    // Mostrar la alerta
    echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show" role="alert">' . $alert_message . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    // Eliminar la variable de sesión después de mostrar la alerta
    unset($_SESSION['alert']);
}
?>

<div class="table-responsive small">
    <form class="row g-3">
        <div class="col-auto">
            <input type="text" class="form-control" id="usuario_id" name="usuario_id" placeholder="Filtrar por ID de usuario...">
        </div>
        <div class="col-auto">
            <select class="form-select" id="estado" name="estado">
                <option selected>Selecciona un estado</option>
                <option value="hombre">Pagada</option>
                <option value="mujer">Pendiente</option>
            </select>
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
                            <th scope="col" style="width: 10%;">Nombre</th>
                            <th scope="col" style="width: 10%;">Apellidos</th>
                            <th scope="col" style="width: 10%;">Fecha de Emisión</th>
                            <th scope="col" style="width: 17%;">Descripcion</th>
                            <th scope="col" style="width: 10%;">Estado</th>
                            <th scope="col" style="width: 10%;">Monto</th>
                            <th scope="col" style="width: 5%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($facturasPaginadas as $factura) : ?>
                            <tr>
                                <td><?php echo $factura['factura_id']; ?></td>
                                <td><?php echo $factura['nombre']; ?></td>
                                <td><?php echo $factura['apellidos']; ?></td>
                                <td><?php echo $factura['fecha_emision']; ?></td>
                                <td><?php echo $factura['descripcion']; ?></td>
                                <td>
                                    <?php
                                    $estado = $factura['estado'];

                                    switch ($estado) {
                                        case 'Pendiente':
                                            $text_gb_class = 'text-bg-warning';
                                            break;
                                        case 'Pagada':
                                            $text_gb_class = 'text-bg-success';
                                            break;
                                        default:
                                            $text_gb_class = 'text-bg-warning';
                                    }
                                    ?>
                                    <span class="badge <?php echo $text_gb_class; ?>">
                                        <?php echo $estado; ?>
                                    </span>
                                </td>
                                <td><?php echo $factura['monto']; ?>€</td>
                                <td>
                                    <form style="width: fit-content;" action="../../scripts/invoice_manager.php" method="GET">
                                        <input type="hidden" name="id" value="<?php echo $factura['factura_id']; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                            </svg></button>
                                        <button type="button" class="btn btn-danger btn-sm d-inline" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $factura['factura_id']?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg></button>

                                        <?php include 'modals/invoices/edit_delete_modal.php'; ?>
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
            <li class="page-item <? echo $_GET['pagina']<=1 ? 'disabled' : '' ?>">
                <a class="page-link" href="invoices.php?pagina=<?php echo $_GET['pagina']-1?>">Anterior</a>
            </li>
            <?php for($i=0; $i<$n_botones_paginacion; $i++): ?>
            <li class="page-item <? echo $_GET['pagina']==$i+1 ? 'active' : '' ?>"><a class="page-link" href="invoices.php?pagina=<?php echo $i+1?>"><?php echo $i+1?></a></li>
            <?php endfor ?>
            <li class="page-item <? echo $_GET['pagina']>=$n_botones_paginacion ? 'disabled' : '' ?>">
                <a class="page-link" href="invoices.php?pagina=<?php echo $_GET['pagina']+1?>">Siguiente</a>
            </li>
        </ul>
    </nav>

</div>

</main>

</body>

</html>