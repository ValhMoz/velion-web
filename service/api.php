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
if ($uri[1] !== 'api' || !isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(["message" => "Recurso no encontrado"]);
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
            if (isset($uri[3])) {
                // Implementar lógica para obtener un solo producto
            } else {
                echo(json_encode($productController->obtenerProductos()));
            }
        } else if ($requestMethod == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $productController->agregarProducto('productos', $data);
        }
        break;
    case 'informes':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                $DNI = $uri[3];
                echo(json_encode($medicalhistoryController->obtenerInformeUsuario($DNI, true)));
            } else {
                //echo $medicalhistoryController->obtenerInformeUsuario($DNI);
            }
        } else if ($requestMethod == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $productController->agregarProducto('productos', $data);
        }
        break;
    case 'citas':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                $DNI = $uri[3];
                echo(json_encode($appointmentController->obtenerCitasUsuario($DNI, true)));
            } else {
                //echo $medicalhistoryController->obtenerInformeUsuario($DNI);
            }
        } else if ($requestMethod == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $productController->agregarProducto('productos', $data);
        }
        break;
    case 'usuarios':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                
            } else {
                
            }
        } else if ($requestMethod == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo(json_encode($loginController->iniciarSesion()));
        }
        break;
        // Añadir más rutas según sea necesario
    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(["message" => "Recurso no encontrado"]);
        break;
}
