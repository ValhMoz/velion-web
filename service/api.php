<?php
require '../controllers/ProductController.php';
require '../controllers/MedicalHistoryController.php';
require '../controllers/AppointmentController.php';
require '../controllers/UserController.php';
require '../controllers/LoginController.php';

header("Content-Type: application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Asegúrate de que la URL contenga al menos /api/productos
if ($uri[1] !== 'api' || ! isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode([
        "message" => "Recurso no encontrado"
    ]);
    exit();
}

$productController = new ProductController();
$appointmentController = new AppointmentController();
$medicalhistoryController = new MedicalHistoryController();
$userController = new UserController();
$loginController = new LoginController();

switch ($uri[2]) {
    case 'productos':
        if ($requestMethod == 'GET') {
            echo (json_encode($productController->obtenerProductos()));
        }
        break;
    case 'informes':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                $DNI = $uri[3];
                echo (json_encode($medicalhistoryController->obtenerInformeUsuario($DNI, true)));
            }
        }
        break;
    case 'informe':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                $DNI = $uri[3];
                echo (json_encode($medicalhistoryController->generarInformeMedico(1)));
            }
        }
        break;
    case 'citas':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                $DNI = $uri[3];
                echo (json_encode($appointmentController->obtenerCitasUsuario($DNI, true)));
            }
        }
        break;
    case 'registro':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                $DNI = $uri[3];
                echo (json_encode($appointmentController->obtenerCitasUsuario($DNI, true)));
            }
        }
        break;
        break;
    case 'recoverpass':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                $DNI = $uri[3];
                echo (json_encode($loginController->generatePasswordResetToken($email, true)));
            }
        }
        break;
    case 'usuarios':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                $DNI = $uri[3];
                echo (json_encode($userController->buscarUsuarios($DNI, "", true)));
            }
        } else if ($requestMethod == 'POST') {
            // Obtener el contenido del cuerpo de la solicitud POST
            $json = file_get_contents('php://input');

            // Decodificar el JSON
            $data = json_decode($json, true);
            $email = isset($_POST['email']) ? urldecode($_POST['email']) : '';
            $pass = isset($_POST['pass']) ? urldecode($_POST['pass']) : '';
            if ($email && $pass) {
                echo (json_encode($loginController->iniciarSesion($email, $pass, true)));
            } else {
                echo json_encode([
                    "message" => "Datos incompletos"
                ]);
            }
        }
        break;
    // Añadir más rutas según sea necesario
    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode([
            "message" => "Recurso no encontrado"
        ]);
        break;
}
