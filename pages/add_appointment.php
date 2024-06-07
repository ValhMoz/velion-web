<?php
require_once '../scripts/session_manager.php';
require_once '../controllers/AppointmentController.php';
$appointmentController = new AppointmentController();

$fisioterapeutas = $appointmentController->obtenerListaFisioterapeutas();

$filtro_usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : '';
$filtro_fecha = isset($_POST['date']) ? $_POST['date'] : '';

if(!empty($filtro_fecha) && !empty($filtro_usuario_id)) {
    $slots = $appointmentController->getSlots($filtro_fecha, $filtro_usuario_id);
    echo(json_encode($slots));
    
}

include './includes/dashboard.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seleccione una Cita</title>
</head>
<body>
    <h1>Seleccione una Cita</h1>
    <form  method="post">
        <input type="hidden" id="action" name="get_available_slots" value="get_available_slots">
        <label for="fisioterapeuta">Fisioterapeuta:</label>
        <select id="fisioterapeuta" name="fisioterapeuta_id">
            <?php foreach ($fisioterapeutas as $fisioterapeuta): ?>
                <option value="<?= $fisioterapeuta['usuario_id'] ?>"><?= $fisioterapeuta['nombre'] . ' ' . $fisioterapeuta['apellidos'] ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date">
        <br><br>
        <button type="subtmit">Buscar Horarios Disponibles</button>
    </form>


    <h1>Horarios disponibles</h1>
    <form action="../scripts/appointment.php" method="post">
        <input type="hidden" id="action" name="get_available_slots" value="get_available_slots">
        <label for="fisioterapeuta">Horarios:</label>
        <select id="fisioterapeuta" name="fisioterapeuta_id">
            <?php foreach ($slots as $slot): ?>
                <option value="<?= $slot ?>"><?= $slot?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <br><br>
        <button type="subtmit">Confirmar cita</button>
    </form>
</body>
</html>
