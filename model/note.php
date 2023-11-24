<?php


class Note {
    private $table = 'notes';
    private $connection;

    public function __construct() {
        $dbObj = new Db();
        $this->connection = $dbObj->connection;
    }

    public function getconnection(){
        // Lógica para obtener la conexión a la base de datos
        return $this->connection;
    }
    public function getNotesByState($user_id, $state_id) {
        $this->getconnection();
        $sql = "SELECT * FROM $this->table WHERE user_id = ? AND state_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$user_id, $state_id]);

        return $stmt->fetchAll();
    }

    public function getNotesByUser($user_id) {
        $this->getconnection();
        $sql = "SELECT * FROM $this->table WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll();
    }

    public function getNoteById($id) {
        if (is_null($id)) return false;

        $this->getconnection();
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function createUpdate($payload) {
        $this->getconnection();
        
        $title = $content = "";
        $existe = false;

        if (isset($payload["id"]) && $payload["id"] !== '') {
            $currentNote = $this->getNoteById($payload["id"]);

            if (isset($currentNote["id"])) {
                $existe = true;
                $id = $payload["id"];
                $title = $currentNote["title"];
                $content = $currentNote["content"];
                $state_id = $currentNote["state_id"];
            }
        }

        if (isset($payload["title"])) {
            $title = $payload["title"];
        }

        if (isset($payload["content"])) {
            $content = $payload["content"];
        }

        $user_id = $payload["user_id"];

        if (isset($payload["state_id"])) {
        $state_id = $payload["state_id"];
        }
        
        
        

        if (!$existe) {
            $sql = "INSERT INTO $this->table (title, content, user_id, state_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);

            if (!$stmt->execute([$title, $content, $user_id, $state_id])) {
                $error = $stmt->errorInfo();
                die($error[2]);
            }

            $id = $this->connection->lastInsertId();
        } else {
            $sql = "UPDATE $this->table SET title=?, content=?, state_id=? WHERE id=?";
            $stmt = $this->connection->prepare($sql);

            if (!$stmt->execute([$title, $content, $state_id, $id])) {
                $error = $stmt->errorInfo();
                die($error[2]);
            }
        }

        return $id;
    }

    public function deleteNoteById($id) {
        $this->getconnection();
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$id]);
    }
}
