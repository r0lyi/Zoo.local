<?php
// models/Foro.php
require_once __DIR__ . '/../controllers/ControllerDatabase.php';

class Foro {
    private $id;
    private $usuario_id;
    private $titulo;
    private $contenido;
    private $fecha;

    public function __construct($usuario_id = 0, $titulo = '', $contenido = '', $fecha = null) {
        $this->usuario_id = $usuario_id;
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->fecha = $fecha;
    }

    // Getters y Setters
    public function getId() { return $this->id; }
    public function getUsuarioId() { return $this->usuario_id; }
    public function getTitulo() { return $this->titulo; }
    public function getContenido() { return $this->contenido; }
    public function getFecha() { return $this->fecha; }
    public function setId($id) { $this->id = $id; }
    public function setUsuarioId($usuario_id) { $this->usuario_id = $usuario_id; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setContenido($contenido) { $this->contenido = $contenido; }
    public function setFecha($fecha) { $this->fecha = $fecha; }

    // Métodos CRUD estáticos (usando la tabla "publicaciones")
    public static function find($id) {
        $connection = ControllerDatabase::connect();
        $query = "SELECT * FROM publicaciones WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        $connection = ControllerDatabase::connect();
        $query = "SELECT * FROM publicaciones";
        $stmt = $connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $connection = ControllerDatabase::connect();
        $query = "INSERT INTO publicaciones (usuario_id, titulo, contenido) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($query);
        // La columna "fecha" se asigna automáticamente por defecto.
        $result = $stmt->execute([$data['usuario_id'], $data['titulo'], $data['contenido']]);
        if($result) {
            return $connection->lastInsertId();
        }
        return false;
    }

    public static function update($id, $data) {
        $connection = ControllerDatabase::connect();
        $query = "UPDATE publicaciones SET usuario_id = ?, titulo = ?, contenido = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
        return $stmt->execute([$data['usuario_id'], $data['titulo'], $data['contenido'], $id]);
    }

    public static function delete($id) {
        $connection = ControllerDatabase::connect();
        $query = "DELETE FROM publicaciones WHERE id = ?";
        $stmt = $connection->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>
