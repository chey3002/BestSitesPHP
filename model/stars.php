<?php
class Ratings {
    private $table = 'ratings';
    private $connection;

    public function __construct() {
        $dbObj = new Db();
        $this->connection = $dbObj->connection;
    }

    public function getconnection(){
        return $this->connection;
    }

    public function getRatingsByUser($user_id) {
        $conn = $this->getconnection();
        $sql = "SELECT * FROM $this->table WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll();
    }

    public function actualizarCalificacion($user_id, $site_id, $nuevaCalificacion) {
        $conn = $this->getconnection();

        // Obtener la calificación actual del usuario para el sitio
        $sql = "SELECT * FROM $this->table WHERE user_id = ? AND site_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id, $site_id]);
        $result = $stmt->fetch();

        // Si el usuario no tiene una entrada en la tabla para el sitio, se crea una nueva
        if (!$result) {
            $sql = "INSERT INTO $this->table (user_id, site_id, rating) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$user_id, $site_id, $nuevaCalificacion]);
        } else {
            // Si el usuario ya tiene una entrada, se actualiza la calificación existente
            $rating_id = $result['id'];
            $sql = "UPDATE $this->table SET rating = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nuevaCalificacion, $rating_id]);
        }
    }

    public function obtenerCalificacionPromedio($site_id) {
        $conn = $this->getconnection();
        $sql = "SELECT AVG(rating) AS average_rating FROM $this->table WHERE site_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$site_id]);

        $result = $stmt->fetch();

        return $result ? $result['average_rating'] : 0;
    }
}
?>
