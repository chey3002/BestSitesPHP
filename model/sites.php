<?php


class Sites {
    private $table = 'sites';
    private $connection;

    public function __construct() {
        $dbObj = new Db();
        $this->connection = $dbObj->connection;
    }

    public function getconnection(){
        // Lógica para obtener la conexión a la base de datos
        return $this->connection;
    }
    
    public function getNotesByUser1($user_id) {
        $this->getconnection();
        $sql = "SELECT * FROM $this->table WHERE user_id = ? ";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll();
    }
    
    public function insertSite($title, $url, $description, $category_id, $image_url, $user_id) {
        $this->getconnection();
        $sql = "INSERT INTO $this->table (title, url, description, category_id, image_url, user_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$title, $url, $description, $category_id, $image_url, $user_id]);
        
        if($result) {
            return $this->connection->lastInsertId();
        } else {
            return false;
        }
    }
    public function updateSite($id, $title, $url, $description, $category_id, $image_url, $user_id) {
        $this->getconnection();
        $sql = "UPDATE $this->table SET title = ?, url = ?, description = ?, category_id = ?, image_url = ?, user_id = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$title, $url, $description, $category_id, $image_url, $user_id, $id]);
        
        return $result;
    }

    public function deleteSite($site_id) {
        $this->getconnection();
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$site_id]);
    }
    
    public function getSiteById($id) {
        $this->getconnection();
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function getAllNotes() {
        $this->getconnection();
        $sql = "SELECT sites.id, sites.title, sites.url,sites.image_url,sites.description, categories.name AS category, AVG(ratings.rating) AS average_rating FROM sites JOIN categories ON sites.category_id = categories.id LEFT JOIN ratings ON sites.id = ratings.site_id GROUP BY sites.id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function topFive() {
        $this->getconnection();
        $sql = "SELECT 
                    sites.id, 
                    sites.title, 
                    sites.url,
                    sites.image_url,
                    sites.description, 
                    categories.name AS category, 
                    AVG(ratings.rating) AS average_rating 
                FROM 
                    sites 
                JOIN 
                    categories ON sites.category_id = categories.id 
                LEFT JOIN 
                    ratings ON sites.id = ratings.site_id 
                GROUP BY 
                    sites.id 
                ORDER BY 
                    average_rating DESC 
                LIMIT 5;";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}