<?php
require_once __DIR__ . '/../config/db.php';

class Usuario {
    private $conn;
    private $table_name = "Usuarios";

    public $id_usuario;
    public $nombre_usuario;
    public $email;
    public $password_hash;
    public $rol;
    public $fecha_creacion;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear un nuevo usuario
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre_usuario, email, password_hash, rol) 
                  VALUES (:nombre_usuario, :email, :password_hash, :rol)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre_usuario", $this->nombre_usuario);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password_hash", $this->password_hash);
        $stmt->bindParam(":rol", $this->rol);

        return $stmt->execute();
    }

    // Leer todos los usuarios
    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un usuario por ID
    public function leerUno($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_usuario = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar usuario
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre_usuario = :nombre_usuario, 
                      email = :email, 
                      rol = :rol 
                  WHERE id_usuario = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre_usuario", $this->nombre_usuario);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":rol", $this->rol);
        $stmt->bindParam(":id", $this->id_usuario);

        return $stmt->execute();
    }

    // Eliminar usuario
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_usuario = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Buscar usuario por email
    public function obtenerPorEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar login
    public function verificarLogin($email, $password) {
        $usuario = $this->obtenerPorEmail($email);

        if ($usuario && password_verify($password, $usuario['password_hash'])) {
            return $usuario;
        }
        return false;
    }
}
?>
