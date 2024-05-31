<?php

require './controllers/ProductController.php';

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

$controller = new ProductController();

switch ($uri[2]) {
    case 'productos':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                // Implementar lógica para obtener un solo producto
            } else {
                echo $controller->obtenerProductos();
            }
        } else if ($requestMethod == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->agregarProducto('productos', $data);
        }
        break;
    case 'informes':
        if ($requestMethod == 'GET') {
            if (isset($uri[3])) {
                // Implementar lógica para obtener un solo producto
            } else {
                echo $controller->obtenerProductos();
            }
        } else if ($requestMethod == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->agregarProducto('productos', $data);
        }
        break;
    case 'citas':
        break;
    case 'usuarios':
        break;
        // Añadir más rutas según sea necesario
    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(["message" => "Recurso no encontrado"]);
        break;
}
