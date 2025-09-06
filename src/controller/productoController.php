<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $productoModel;

    public function __construct() {
        $this->productoModel = new Producto();
    }

    public function crear($data) {
        $this->productoModel->nombre_producto = $data['nombre_producto'];
        $this->productoModel->descripcion = $data['descripcion'];
        $this->productoModel->stock = $data['stock'];
        $this->productoModel->stock_minimo = $data['stock_minimo'];
        $this->productoModel->precio_compra = $data['precio_compra'];
        $this->productoModel->precio_venta = $data['precio_venta'];
        $this->productoModel->id_proveedor = $data['id_proveedor'];
        $this->productoModel->activo = $data['activo'];

        return $this->productoModel->crear();
    }

    public function listar() {
        return $this->productoModel->leerTodos();
    }

    public function obtener($id) {
        return $this->productoModel->leerUno($id);
    }

    public function actualizar($id, $data) {
        $this->productoModel->id_producto = $id;
        $this->productoModel->nombre_producto = $data['nombre_producto'];
        $this->productoModel->descripcion = $data['descripcion'];
        $this->productoModel->stock = $data['stock'];
        $this->productoModel->stock_minimo = $data['stock_minimo'];
        $this->productoModel->precio_compra = $data['precio_compra'];
        $this->productoModel->precio_venta = $data['precio_venta'];
        $this->productoModel->id_proveedor = $data['id_proveedor'];
        $this->productoModel->activo = $data['activo'];

        return $this->productoModel->actualizar();
    }

    public function eliminar($id) {
        return $this->productoModel->eliminar($id);
    }
}
?>
