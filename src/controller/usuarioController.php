<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // Registrar usuario
    public function registrar($nombre, $email, $password, $rol) {
        $this->usuarioModel->nombre_usuario = $nombre;
        $this->usuarioModel->email = $email;
        $this->usuarioModel->password_hash = password_hash($password, PASSWORD_BCRYPT);
        $this->usuarioModel->rol = $rol;

        return $this->usuarioModel->crear();
    }

    // Login de usuario
    public function login($email, $password) {
        $usuario = $this->usuarioModel->verificarLogin($email, $password);

        if ($usuario) {
            // Guardamos sesión
            session_start();
            $_SESSION['usuario'] = [
                "id" => $usuario['id_usuario'],
                "nombre" => $usuario['nombre_usuario'],
                "rol" => $usuario['rol']
            ];
            return true;
        }
        return false;
    }

    // Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
    }

    // Obtener todos los usuarios (solo admin debería usar esto)
    public function listarUsuarios() {
        return $this->usuarioModel->leerTodos();
    }
}
?>
