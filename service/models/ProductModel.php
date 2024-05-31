<?php
class ProductModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function read($table) {
        $query = "SELECT * FROM " . $table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO " . $table . " ($columns) VALUES ($values)";
        $stmt = $this->conn->prepare($query);

        foreach ($data as $key => &$val) {
            $stmt->bindParam(":$key", $val);
        }

        return $stmt->execute();
    }
}
?>
