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

    public function getSitesByCategoryAndRating($categoryId, $minRating) {
        $this->getconnection();
        if($categoryId>0){
            $sql = "SELECT 
            s.id, 
            s.title, 
            s.description, 
            s.url, 
            s.image_url, 
            c.name AS category, 
            IFNULL(AVG(r.rating), 0) AS average_rating
        FROM 
            sites s
        INNER JOIN 
            categories c ON s.category_id = c.id
        LEFT JOIN 
            ratings r ON s.id = r.site_id
        WHERE 
            c.id = :category_id
        GROUP BY 
            s.id
        HAVING 
            average_rating >= :min_rating";

$stmt = $this->connection->prepare($sql);
$stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
$stmt->bindParam(':min_rating', $minRating, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $sql = "SELECT 
            s.id, 
            s.title, 
            s.description, 
            s.url, 
            s.image_url, 
            c.name AS category, 
            IFNULL(AVG(r.rating), 0) AS average_rating
        FROM 
            sites s
        INNER JOIN 
            categories c ON s.category_id = c.id
        LEFT JOIN 
            ratings r ON s.id = r.site_id
        GROUP BY 
            s.id
        HAVING 
            average_rating >= :min_rating";

$stmt = $this->connection->prepare($sql);
$stmt->bindParam(':min_rating', $minRating, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
       
    }

    public function sitesDetails($id) {
        $this->getconnection();
       $sql = "SELECT sites.*, users.username AS user_name, AVG(ratings.rating) AS average_rating, categories.name AS category_name, ratings.site_id AS rating_site_id
        FROM $this->table
        INNER JOIN users ON sites.user_id = users.id
        LEFT JOIN ratings ON sites.id = ratings.site_id
        LEFT JOIN categories ON sites.category_id = categories.id
        WHERE sites.id = ?
        GROUP BY sites.id, users.id, categories.id, ratings.site_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function getRating($id,$user_id) {
        $this->getconnection();
        $sql = "SELECT * FROM ratings WHERE site_id = ? AND user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id,$user_id]);
        return $stmt->fetch();
    
}
    
    
}