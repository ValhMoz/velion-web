<?php
require_once '../scripts/session_manager.php';
include_once 'dashboard.php';

if ($rol == "paciente") {
    header("Location: 404.php");
    exit();
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bienvenid@, <?php echo $nombre ?> </h1>
</div>

<h1 class="mb-4">Tutorial de uso del ERP-CRM para Clínica de Fisioterapia</h1>

<section id="usuarios" class="mb-5">
    <h2>Módulo de Usuarios</h2>
    <p>En este módulo puedes gestionar los usuarios del sistema, incluyendo administradores, fisioterapeutas y pacientes.</p>
</section>

<section id="citas" class="mb-5">
    <h2>Módulo de Citas</h2>
    <p>Administra las citas de los pacientes, asigna horarios a los fisioterapeutas y gestiona la disponibilidad de consultorios.</p>
</section>

<section id="facturas" class="mb-5">
    <h2>Módulo de Facturas</h2>
    <p>Crea y gestiona las facturas para los tratamientos realizados, facilitando el control financiero de la clínica.</p>
</section>

<section id="historial" class="mb-5">
    <h2>Módulo de Historial Médico</h2>
    <p>Accede al historial médico de los pacientes, registra tratamientos anteriores y lleva un seguimiento detallado de su evolución.</p>
    <img src="historial.png" alt="Módulo de Historial Médico" class="img-fluid">
</section>

<section id="reportes" class="mb-5">
    <h2>Módulo de Reportes</h2>
    <p>Genera informes y estadísticas sobre la actividad de la clínica, analizando datos relevantes para la toma de decisiones.</p>
</section>

<section id="pacientes" class="mb-5">
    <h2>Área de Pacientes</h2>
    <p>Los pacientes tienen acceso a un área especial donde pueden ver su historial médico, gestionar sus citas y realizar pagos en línea.</p>
</section>

</main>

</body>

</html>