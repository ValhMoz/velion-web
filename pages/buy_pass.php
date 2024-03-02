<?php
    // Inicia la sesión si no está iniciada
    session_start();

    // Verifica si hay un nombre de usuario en la sesión
    if (isset($_SESSION['username'])) {
        $nombreUsuario = $_SESSION['username'];
    } else {
        // Si no hay un nombre de usuario en la sesión, redirige a la página de inicio de sesión
        header('Location: ./404.php');
        exit();
    }
?>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check" viewBox="0 0 16 16">
            <title>Check</title>
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
    </svg>

    <div class="container py-3">
        <header>
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal text-body-emphasis">Precios</h1>
                <p class="fs-5 text-body-secondary">Seleccione un bono para comprar.</p>
            </div>
        </header>

        <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">10 sesiones</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">100€<small class="text-body-secondary fw-light">/año</small></h1>
                            <br>
                            <br>
                            <br>
                            <!-- <ul class="list-unstyled mt-3 mb-4">
                                <li>10 users included</li>
                                <li>2 GB of storage</li>
                                <li>Email support</li>
                                <li>Help center access</li>
                            </ul> -->
                            <button type="button" id="buy" class="w-100 btn btn-lg btn-outline-primary">Haz click aquí para comprar</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">20 sesiones</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">180€<small class="text-body-secondary fw-light">/año</small></h1>
                            <br>
                            <br>
                            <br>
                            <!-- <ul class="list-unstyled mt-3 mb-4">
                                <li>10 users included</li>
                                <li>2 GB of storage</li>
                                <li>Email support</li>
                                <li>Help center access</li>
                            </ul> -->
                            <button type="button" id="buy" class="w-100 btn btn-lg btn-outline-primary">Haz click aquí para comprar</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">30 sesiones</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">260€<small class="text-body-secondary fw-light">/año</small></h1>
                            <br>
                            <br>
                            <br>
                            <!-- <ul class="list-unstyled mt-3 mb-4">
                                <li>10 users included</li>
                                <li>2 GB of storage</li>
                                <li>Email support</li>
                                <li>Help center access</li>
                            </ul> -->
                            <button type="button" id="buy" class="w-100 btn btn-lg btn-outline-primary">Haz click aquí para comprar</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Esperar a que el DOM esté listo
        $(document).ready(function() {
            // Manejar el evento de clic en el botón por su clase
            $('#buy').on('click', function() {
                // Redirigir a checkout.php
                window.location.href = 'checkout.php';
            });
        });
    </script>
</body>