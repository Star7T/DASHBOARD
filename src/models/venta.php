<?php
require_once __DIR__ . '/../config/db.php';

class Venta {
    private $conn;
    private $table_name = "ventas";

    public $id_venta;
    public $fecha_venta;
    public $id_usuario;
    public $estado_venta;
    public $total_venta;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (fecha_venta, id_usuario, estado_venta, total_venta)
                  VALUES (:fecha_venta, :id_usuario, :estado_venta, :total_venta)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fecha_venta", $this->fecha_venta);
        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":estado_venta", $this->estado_venta);
        $stmt->bindParam(":total_venta", $this->total_venta);
        return $stmt->execute();
    }

    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_venta DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerUno($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_venta=:id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET 
                    fecha_venta=:fecha_venta,
                    id_usuario=:id_usuario,
                    estado_venta=:estado_venta,
                    total_venta=:total_venta
                  WHERE id_venta=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fecha_venta", $this->fecha_venta);
        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":estado_venta", $this->estado_venta);
        $stmt->bindParam(":total_venta", $this->total_venta);
        $stmt->bindParam(":id", $this->id_venta);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_venta=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
