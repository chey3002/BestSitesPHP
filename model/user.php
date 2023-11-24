<?php

require_once 'model/db.php';

class User {
    private $table = 'users';
    private $connection;

    public function __construct() {
        $dbObj = new Db();
        $this->connection = $dbObj->connection;
    }

    public function getconnection(){
        // Lógica para obtener la conexión a la base de datos
        return $this->connection;
    }

    public function registerUser($username, $password) {
        $this->getconnection();
        
        // Verificar si el usuario ya existe
        $sql_check_user = "SELECT id FROM $this->table WHERE username = ?";
        $stmt_check_user = $this->connection->prepare($sql_check_user);
        $stmt_check_user->execute([$username]);

        if ($stmt_check_user->fetchColumn()) {
            return false; // El usuario ya existe
        }

        // Hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Registrar el nuevo usuario
        $sql_register_user = "INSERT INTO $this->table (username, password) VALUES (?, ?)";
        $stmt_register_user = $this->connection->prepare($sql_register_user);

        return $stmt_register_user->execute([$username, $hashed_password]);
    }

    public function authenticateUser($username, $password) {
        $this->getconnection();

        // Obtener información del usuario por nombre de usuario
        $sql_get_user = "SELECT * FROM $this->table WHERE username = ?";
        $stmt_get_user = $this->connection->prepare($sql_get_user);
        $stmt_get_user->execute([$username]);
        $user = $stmt_get_user->fetch();

        // Verificar la contraseña
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Devolver información del usuario
        } else {
            return false; // Credenciales incorrectas
        }
    }
}
