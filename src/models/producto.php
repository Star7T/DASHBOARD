<?php
require_once __DIR__ . '/../config/db.php';

class Producto {
    private $conn;
    private $table_name = "productos";

    public $id_producto;
    public $nombre_producto;
    public $descripcion;
    public $stock;
    public $stock_minimo;
    public $precio_compra;
    public $precio_venta;
    public $id_proveedor;
    public $activo;
    public $fecha_creacion;
    public $fecha_actualizacion;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre_producto, descripcion, stock, stock_minimo, precio_compra, precio_venta, id_proveedor, activo)
                  VALUES (:nombre_producto, :descripcion, :stock, :stock_minimo, :precio_compra, :precio_venta, :id_proveedor, :activo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre_producto", $this->nombre_producto);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":stock_minimo", $this->stock_minimo);
        $stmt->bindParam(":precio_compra", $this->precio_compra);
        $stmt->bindParam(":precio_venta", $this->precio_venta);
        $stmt->bindParam(":id_proveedor", $this->id_proveedor);
        $stmt->bindParam(":activo", $this->activo);
        return $stmt->execute();
    }

    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerUno($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_producto = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET 
                    nombre_producto=:nombre_producto, 
                    descripcion=:descripcion, 
                    stock=:stock, 
                    stock_minimo=:stock_minimo, 
                    precio_compra=:precio_compra, 
                    precio_venta=:precio_venta, 
                    id_proveedor=:id_proveedor, 
                    activo=:activo 
                  WHERE id_producto=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre_producto", $this->nombre_producto);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":stock_minimo", $this->stock_minimo);
        $stmt->bindParam(":precio_compra", $this->precio_compra);
        $stmt->bindParam(":precio_venta", $this->precio_venta);
        $stmt->bindParam(":id_proveedor", $this->id_proveedor);
        $stmt->bindParam(":activo", $this->activo);
        $stmt->bindParam(":id", $this->id_producto);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_producto=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
