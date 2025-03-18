<?php

// Incluye el controlador de base de datos
require_once __DIR__ . '/../controllers/ControllerDatabase.php';

class Noticias {
    // Atributos
    private $id;
    private $titular;
    private $descripcion;
    private $imagen;

    // Constructor
    public function __construct($id = null, $titular = '', $descripcion = '', $imagen = '') {
        $this->id = $id;
        $this->titular = $titular;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getImagen() {
        return $this->imagen;
    }

  

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitular($titular) {
        $this->titular = $titular;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

   

    // Método para obtener todas las noticias
    public static function listNoticias() {
        $db = ControllerDatabase::connect();
        
        if ($db === null) {
            return [];
        }

        // Consulta para obtener las noticias
        $stmt = $db->query("SELECT * FROM noticias");
        $noticiasData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Convertir los datos en objetos Noticias
        $noticias = [];
        foreach ($noticiasData as $noticiaData) {
            $noticia = new Noticias(
                $noticiaData['id'],
                $noticiaData['titular'],
                $noticiaData['descripcion'],
                $noticiaData['imagen'],
            );
            $noticias[] = $noticia;
        }

        return $noticias;
    }
    public static function find($id) {
        $connection = ControllerDatabase::connect();
        $query = "SELECT * FROM noticias WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        $connection = ControllerDatabase::connect();
        $query = "SELECT * FROM noticias";
        $stmt = $connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Alias para compatibilidad con ControllerAdmin
    public static function getNoticias() {
        return self::findAll();
    }

    public static function create($data) {
        $connection = ControllerDatabase::connect();
        $query = "INSERT INTO noticias (titular, descripcion, imagen) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($query);
        $result = $stmt->execute([$data['titular'], $data['descripcion'], $data['imagen']]);
        if($result) {
            return $connection->lastInsertId();
        }
        return false;
    }

    public static function update($id, $data) {
        $connection = ControllerDatabase::connect();
        $query = "UPDATE noticias SET titular = ?, descripcion = ?, imagen = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
        return $stmt->execute([$data['titular'], $data['descripcion'], $data['imagen'], $id]);
    }

    public static function delete($id) {
        $connection = ControllerDatabase::connect();
        $query = "DELETE FROM noticias WHERE id = ?";
        $stmt = $connection->prepare($query);
        return $stmt->execute([$id]);
    }

}
