<?php
require_once '../scripts/session_manager.php';
include_once './includes/dashboard.php';

if ($rol == "paciente") {
    header("Location: 404.php");
    exit();
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bienvenid@, <?php echo $nombre ?> </h1>
</div>



</main>

</body>

</html>