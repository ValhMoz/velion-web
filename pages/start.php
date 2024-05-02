<?php
require_once '../scripts/session_manager.php';
include_once './includes/dashboard.php';

if ($rol == "paciente") {
    header("Location: 404.php");
    exit();
}

?>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="tutorial">
                    <h4>Bienvenido</h4>
                    <p>Creado por: Sergio Física y Miguel Ortega</p>
                    <p>Github: <a href="https://github.com/Z2V-LABS/clinic-managment">https://github.com/Z2V-LABS/clinic-managment</a></p>
                    <p>Uso básico: Navega entre las diferentes opciones del menu lateral izquierdo haciendo clic en los botones.</p>
                </div>
                <div class="calendar">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="7">
                                    <span class="prev-month">&lt;</span>
                                    <?php echo date('F Y'); ?>
                                    <span class="next-month">&gt;</span>
                                </th>
                            </tr>
                            <tr>
                                <th>Lun</th>
                                <th>Mar</th>
                                <th>Mié</th>
                                <th>Jue</th>
                                <th>Vie</th>
                                <th>Sáb</th>
                                <th>Dom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $firstDayOfMonth = strtotime('first day of this month');
                            $lastDayOfMonth = strtotime('last day of this month');
                            $daysInMonth = date('t', $firstDayOfMonth);
                            $currentDate = strtotime('today');
                            $currentDay = date('j', $currentDate);
                            $dayOfWeek = date('N', $firstDayOfMonth);

                            echo '<tr>';

                            // Generar días del mes anterior si no es lunes
                            if ($dayOfWeek != 1) {
                                echo str_repeat('<td class="prev-month"></td>', $dayOfWeek - 1);
                            }

                            // Generar días del mes actual
                            for ($currentDay = 1; $currentDay <= $daysInMonth; $currentDay++) {
                                // Nueva fila cada 7 días
                                if ($dayOfWeek == 1 && $currentDay != 1) {
                                    echo '</tr><tr>';
                                }
                                // Marcar el día de hoy
                                $class = ($currentDay == date('j', $currentDate)) ? 'today' : 'day';
                                echo '<td class="' . $class . '">' . $currentDay . '</td>';
                                $dayOfWeek = ($dayOfWeek == 7) ? 1 : $dayOfWeek + 1;
                            }

                            // Generar días del mes siguiente si no es domingo
                            if ($dayOfWeek != 1) {
                                echo str_repeat('<td class="next-month"></td>', 8 - $dayOfWeek);
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var prevMonth = document.querySelector('.prev-month');
            var nextMonth = document.querySelector('.next-month');

            prevMonth.addEventListener('click', function() {
                var currentMonth = '<?php echo date('n'); ?>';
                var currentYear = '<?php echo date('Y'); ?>';
                var prevMonth = (currentMonth == 1) ? 12 : currentMonth - 1;
                var prevYear = (currentMonth == 1) ? currentYear - 1 : currentYear;
                window.location.href = '?month=' + prevMonth + '&year=' + prevYear;
            });

            nextMonth.addEventListener('click', function() {
                var currentMonth = '<?php echo date('n'); ?>';
                var currentYear = '<?php echo date('Y'); ?>';
                var nextMonth = (currentMonth == 12) ? 1 : parseInt(currentMonth) + 1;
                var nextYear = (currentMonth == 12) ? parseInt(currentYear) + 1 : currentYear;
                window.location.href = '?month=' + nextMonth + '&year=' + nextYear;
            });
        });
    </script>
    </main>
</body>

</html>