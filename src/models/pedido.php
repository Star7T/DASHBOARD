<?php
require_once __DIR__ . '/../config/db.php';

class Pedido {
    private $conn;
    private $table_name = "detalleventa";

    public $id_detalle;
    public $id_venta;
    public $id_producto;
    public $cantidad;
    public $precio_unitario;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (id_venta, id_producto, cantidad, precio_unitario)
                  VALUES (:id_venta, :id_producto, :cantidad, :precio_unitario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_venta", $this->id_venta);
        $stmt->bindParam(":id_producto", $this->id_producto);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":precio_unitario", $this->precio_unitario);
        return $stmt->execute();
    }

    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_detalle DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerUno($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_detalle=:id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET 
                    id_venta=:id_venta, 
                    id_producto=:id_producto, 
                    cantidad=:cantidad, 
                    precio_unitario=:precio_unitario
                  WHERE id_detalle=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_venta", $this->id_venta);
        $stmt->bindParam(":id_producto", $this->id_producto);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":precio_unitario", $this->precio_unitario);
        $stmt->bindParam(":id", $this->id_detalle);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_detalle=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
