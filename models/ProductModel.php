<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel{

    public function __construct() {
        parent::__construct();
    }

    public function getProductsPaginated($inicio, $articulosPorPagina) {
        $query = "SELECT p.producto_id, p.nombre, p.descripcion, p.monto, c.nombre AS categoria 
        FROM productos p 
        JOIN categorias c ON p.categoria_id = c.categoria_id 
        LIMIT ?, ?
        ";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param('ii', $inicio, $articulosPorPagina);
        $stmt->execute();
        $result = $stmt->get_result();
        $productos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $productos;
    }

    public function searchProducts($productoId, $categoria) {
        $query = "SELECT p.producto_id, p.nombre, p.monto, c.nombre AS categoria 
                  FROM productos p 
                  JOIN categorias c ON p.categoria_id = c.categoria_id 
                  WHERE (p.producto_id LIKE :productoId OR :productoId IS NULL) 
                  AND (c.categoria_id = :categoria OR :categoria IS NULL)";
        $stmt = self::$conexion->prepare($query);
        $productoId = !empty($productoId) ? "%$productoId%" : null;
        $stmt->bind_param(':productoId', $productoId, PDO::PARAM_STR);
        $stmt->bind_param(':categoria', $categoria, PDO::PARAM_INT);
          $stmt->execute();
        $result = $stmt->get_result();
        $productos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $productos;
    }

}
?>
