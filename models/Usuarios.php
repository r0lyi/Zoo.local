<?php
// models/Usuarios.php
require_once __DIR__ . '/../controllers/ControllerDatabase.php';

class Usuarios {
    private $id;
    private $nombre;
    private $correo;
    private $contraseña_hash;
    private $tipo_usuario;

    // Constructor
    public function __construct($nombre = '', $correo = '', $contraseña_hash = '', $tipo_usuario = 'usuario') {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contraseña_hash = $contraseña_hash;
        $this->tipo_usuario = $tipo_usuario;
    }

    // Getters y Setters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getCorreo() { return $this->correo; }
    public function getContraseñaHash() { return $this->contraseña_hash; }
    public function getTipoUsuario() { return $this->tipo_usuario; }
    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setContraseñaHash($contraseña_hash) { $this->contraseña_hash = $contraseña_hash; }
    public function setTipoUsuario($tipo_usuario) { $this->tipo_usuario = $tipo_usuario; }

    // Método para guardar (insertar) el usuario en la base de datos
    public function guardar() {
        $connection = ControllerDatabase::connect();
        $query = "INSERT INTO usuarios (nombre, correo, contraseña_hash, tipo_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        return $stmt->execute([$this->nombre, $this->correo, $this->contraseña_hash, $this->tipo_usuario]);
    }

    // Métodos estáticos para operaciones CRUD

    public static function find($id) {
        $connection = ControllerDatabase::connect();
        $query = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        $connection = ControllerDatabase::connect();
        $query = "SELECT * FROM usuarios";
        $stmt = $connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $connection = ControllerDatabase::connect();
        $query = "INSERT INTO usuarios (nombre, correo, contraseña_hash, tipo_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $result = $stmt->execute([$data['nombre'], $data['correo'], $data['contraseña_hash'] ?? '', $data['tipo_usuario']]);
        if($result) {
            return $connection->lastInsertId();
        }
        return false;
    }

    public static function update($id, $data) {
        $connection = ControllerDatabase::connect();
        $query = "UPDATE usuarios SET nombre = ?, correo = ?, tipo_usuario = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
        return $stmt->execute([$data['nombre'], $data['correo'], $data['tipo_usuario'], $id]);
    }

    public static function delete($id) {
        $connection = ControllerDatabase::connect();
        $query = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $connection->prepare($query);
        return $stmt->execute([$id]);
    }

    // Métodos adicionales para manejo de tokens
    public static function verificarCorreoExistente($correo) {
        $connection = ControllerDatabase::connect();
        $query = "SELECT * FROM usuarios WHERE correo = :correo";
        $statement = $connection->prepare($query);
        $statement->bindParam(':correo', $correo);
        $statement->execute();
        return $statement->rowCount() > 0;
    }

    public static function obtenerPorCorreo($correo) {
        $connection = ControllerDatabase::connect();
        $query = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorId($id) {
        $connection = ControllerDatabase::connect();
        $query = "SELECT id, nombre, correo, tipo_usuario FROM usuarios WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function guardarToken($usuarioId, $token) {
        $connection = ControllerDatabase::connect();
        $query = "UPDATE usuarios SET token = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$token, $usuarioId]);
        return $stmt->rowCount() > 0;
    }

    public static function eliminarTokenPorId($id) {
        $connection = ControllerDatabase::connect();
        $query = "UPDATE usuarios SET token = NULL WHERE id = ?";
        $stmt = $connection->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>
