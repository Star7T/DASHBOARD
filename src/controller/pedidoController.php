<?php
require_once __DIR__ . '/../models/Pedido.php';

class PedidoController {
    private $pedidoModel;

    public function __construct() {
        $this->pedidoModel = new Pedido();
    }

    public function crear($data) {
        $this->pedidoModel->id_venta = $data['id_venta'];
        $this->pedidoModel->id_producto = $data['id_producto'];
        $this->pedidoModel->cantidad = $data['cantidad'];
        $this->pedidoModel->precio_unitario = $data['precio_unitario'];
        return $this->pedidoModel->crear();
    }

    public function listar() {
        return $this->pedidoModel->leerTodos();
    }

    public function obtener($id) {
        return $this->pedidoModel->leerUno($id);
    }

    public function actualizar($id, $data) {
        $this->pedidoModel->id_detalle = $id;
        $this->pedidoModel->id_venta = $data['id_venta'];
        $this->pedidoModel->id_producto = $data['id_producto'];
        $this->pedidoModel->cantidad = $data['cantidad'];
        $this->pedidoModel->precio_unitario = $data['precio_unitario'];
        return $this->pedidoModel->actualizar();
    }

    public function eliminar($id) {
        return $this->pedidoModel->eliminar($id);
    }
}
?>
