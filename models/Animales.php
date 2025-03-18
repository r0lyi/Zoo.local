<?php

include_once __DIR__ . '/../controllers/ControllerDatabase.php';

class Animales {
    private $id;
    private $especie;
    private $imagen;

    public function __construct($id = null, $especie = '', $imagen = '') {
        $this->id = $id;
        $this->especie = $especie;
        $this->imagen = $imagen;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getEspecie() {
        return $this->especie;
    }

    public function getImagen() {
        return $this->imagen;
    }

  

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setEspecie($especie) {
        $this->especie = $especie;
    }

    public function setImagen($habitat) {
        $this->imagen = $imagen;
    }

  

    // Método para obtener todos los animales
    public static function getAnimales() {
        $db = ControllerDatabase::connect();
        
        if ($db === null) {
            return [];
        }

        // Consulta para obtener las noticias
        $stmt = $db->query("SELECT * FROM animales");
        $animalesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Convertir los datos en objetos Noticias
        $animales = [];
        foreach ($animalesData as $animalData) {
            $animal = new Animales(
                $animalData['id'],
                $animalData['especie'],
                $animalData['imagen'],
            );
            $animales[] = $animal;
        }

    return $animales;
}
}

?>
