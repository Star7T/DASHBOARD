<?php
require_once __DIR__ . '/../models/Venta.php';

class VentaController {
    private $ventaModel;

    public function __construct() {
        $this->ventaModel = new Venta();
    }

    public function crear($data) {
        $this->ventaModel->fecha_venta = $data['fecha_venta'];
        $this->ventaModel->id_usuario = $data['id_usuario'];
        $this->ventaModel->estado_venta = $data['estado_venta'];
        $this->ventaModel->total_venta = $data['total_venta'];
        return $this->ventaModel->crear();
    }

    public function listar() {
        return $this->ventaModel->leerTodos();
    }

    public function obtener($id) {
        return $this->ventaModel->leerUno($id);
    }

    public function actualizar($id, $data) {
        $this->ventaModel->id_venta = $id;
        $this->ventaModel->fecha_venta = $data['fecha_venta'];
        $this->ventaModel->id_usuario = $data['id_usuario'];
        $this->ventaModel->estado_venta = $data['estado_venta'];
        $this->ventaModel->total_venta = $data['total_venta'];
        return $this->ventaModel->actualizar();
    }

    public function eliminar($id) {
        return $this->ventaModel->eliminar($id);
    }
}
?>
