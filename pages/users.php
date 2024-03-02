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

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Usuarios</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Agregar Usuario
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Paciente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">ID</label>
                        <input type="text" class="form-control form-control-lg" id="inputAddress">
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Nombre</label>
                        <input type="text" class="form-control form-control-lg" id="inputAddress">
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Apellidos</label>
                        <input type="text" class="form-control form-control-lg" id="inputAddress">
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Dirección</label>
                        <input type="text" class="form-control form-control-lg" id="inputAddress">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Teléfono</label>
                        <input type="text" class="form-control form-control-lg" id="inputCity">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Correo</label>
                        <input type="text" class="form-control form-control-lg" id="inputCity">
                    </div>
                    <div class="col-md-6">
                        <label for="inputZip" class="form-label">Código Postal</label>
                        <input type="text" class="form-control form-control-lg" id="inputZip">
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Ciudad</label>
                        <select id="inputState" class="form-select form-select-lg">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Añadir Paciente</button>
            </div>
        </div>
    </div>
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


    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">E-mail</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../core/conn.php";

            // Consulta SQL
            $sql = "SELECT ID_Paciente, Nombre_P, Apellido_P, Telefono_P, Direccion_P, CorreoElectronico_P FROM pacientes";
            $result = $conn->query($sql);

            // Comprobar si hay resultados
            if ($result->num_rows > 0) {
                // Salida de datos de cada fila
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["ID_Paciente"] . '</td>';
                    echo '<td>' . $row["Nombre_P"] . '</td>';
                    echo '<td>' . $row["Apellido_P"] . '</td>';
                    echo '<td>' . $row["CorreoElectronico_P"] . '</td>';
                    echo '<td>' . $row["Direccion_P"] . '</td>';
                    echo '<td>' . $row["Telefono_P"] . '</td>';
                    echo '<td>Acciones aquí</td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='7'>0 resultados</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
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