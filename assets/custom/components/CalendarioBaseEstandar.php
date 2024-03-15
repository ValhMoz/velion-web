<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <!-- Enlace a Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionales para el círculo */
        .custom-circle {
            width: 60%;
            height: 60%;
            background-color: #000;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1; /* Para que el círculo esté detrás del número */
        }

        /* Estilo para el botón activo */
        .active-button {
            background-color: transparent;
            color: #fff;
        }

        /* Estilo para mover los botones de los días hacia la izquierda */
        .move-left {
            margin-left: -0.35rem; /* Ajusta este valor según sea necesario */
        }

        /* Estilo para el número en el botón activo */
        .active-button .number {
            color: #fff; /* Color blanco */
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">

<div class="container mx-auto mt-10 border border-gray-400 p-4 rounded-lg max-w-sm">
    <div class="flex justify-between items-center mb-5">
        <button type="button" id="prevButton" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">Anterior</button>
        <h1 id="monthDisplay" class="text-lg font-bold">Enero</h1>
        <button type="button" id="nextButton" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">Siguiente</button>
    </div>

    <!-- Días de la semana -->
    <div class="grid grid-cols-7 gap-4 text-center mb-4">
        <div>L</div>
        <div>M</div>
        <div>M</div>
        <div>J</div>
        <div>V</div>
        <div>S</div>
        <div>D</div>
    </div>

    <!-- Rejilla de botones del mes -->
    <div class="grid grid-cols-7 gap-4 mx-auto" id="daysGrid">
    </div>
</div>

<script>
    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    const daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    let currentMonthIndex = new Date().getMonth();

    // Función para determinar si el año es bisiesto
    function isLeapYear(year) {
        return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
    }

    // Función para cambiar al mes anterior
    document.getElementById("prevButton").addEventListener("click", function() {
        currentMonthIndex--;
        if (currentMonthIndex < 0) {
            currentMonthIndex = monthNames.length - 1;
        }
        displayMonth(currentMonthIndex);
    });

    // Función para cambiar al siguiente mes
    document.getElementById("nextButton").addEventListener("click", function() {
        currentMonthIndex++;
        if (currentMonthIndex >= monthNames.length) {
            currentMonthIndex = 0;
        }
        displayMonth(currentMonthIndex);
    });

    // Función para mostrar el mes actual
    function displayMonth(index) {
        const monthDisplay = document.getElementById("monthDisplay");
        monthDisplay.textContent = monthNames[index];
        generateButtons(daysInMonth[index], index);
    }

    // Función para generar los botones de los días del mes
    function generateButtons(days, index) {
        // Ajustar los días de febrero si es bisiesto
        if (index === 1 && isLeapYear(new Date().getFullYear())) {
            days = 29;
        }

        const grid = document.getElementById("daysGrid");
        grid.innerHTML = ""; // Limpiar el contenido anterior del grid

        for (let i = 1; i <= days; i++) {
            const button = document.createElement('button');
            button.type = 'button';
            button.classList.add('arp', 'bib', 'bag', 'alm', 'axu', 'relative', 'border', 'border-gray-400', 'rounded-md', 'h-12', 'w-12', 'move-left');
            button.innerHTML = `<span class="number">${i}</span>`;
            button.onclick = function() {
                toggleButton(this);
            };
            grid.appendChild(button);
        }
    }

    // Función para alternar el estado de un botón
    function toggleButton(button) {
        if (button.classList.contains('active-button')) {
            button.classList.remove('active-button');
            const circle = button.querySelector('.custom-circle');
            if (circle) {
                button.removeChild(circle);
            }
            const number = button.querySelector('.number');
            if (number) {
                number.style.color = '#000'; // Cambia el color del número a negro
            }
        } else {
            highlightButton(button);
        }
    }

    // Función para resaltar el botón seleccionado
    function highlightButton(button) {
        // Quita la clase 'active-button' de todos los botones
        document.querySelectorAll('.arp').forEach(btn => {
            btn.classList.remove('active-button');
            const circle = btn.querySelector('.custom-circle');
            if (circle) {
                btn.removeChild(circle);
            }
            const number = btn.querySelector('.number');
            if (number) {
                number.style.color = '#000'; // Cambia el color del número a negro
            }
        });
        // Agrega la clase 'active-button' al botón clicado
        button.classList.add('active-button');
        // Crea y agrega el círculo al botón clicado
        const circle = document.createElement('div');
        circle.classList.add('custom-circle');
        button.appendChild(circle);
        // Cambia el color del número a blanco
        const number = button.querySelector('.number');
        if (number) {
            number.style.color = '#fff';
        }
    }

    // Mostrar el mes actual al cargar la página
    displayMonth(currentMonthIndex);
</script>

</body>
</html>