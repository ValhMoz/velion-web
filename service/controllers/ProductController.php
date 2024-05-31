<?php
require_once '../models/ProductModel.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function obtenerProductos() {
        $productos = $this->productModel->read('productos');
        header("Content-Type: application/json");
        echo json_encode($productos);
    }

    public function agregarProducto($tabla, $datos) {
        $result = $this->productModel->insert($tabla, $datos);
        if ($result) {
            header("HTTP/1.1 201 Created");
            echo json_encode(["message" => "Producto creado con éxito"]);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(["message" => "Error al crear el producto"]);
        }
    }
}
?>
