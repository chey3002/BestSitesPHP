<?php

require_once 'model/user.php';
require_once 'controller/sites.php';

class userController {
    public $page_title;
    public $view;
    public $userObj;

    public function __construct() {
        $this->view = 'login_register';
        $this->page_title = 'Iniciar Sesión';
        $this->userObj = new User();
    }

    public function register() {
        $this->page_title = 'Registro de Usuario';
        $this->view = 'login_register';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validar y procesar el formulario de registro
            // (Implementa la lógica de validación y creación de usuarios en el modelo)
            // Ejemplo básico:
            $result = $this->userObj->registerUser($username, $password);

            if ($result) {
                $this->page_title = 'Iniciar Sesión';
                $this->view = 'login_register';
                $_GET["response"] = true;
                $_GET["alert"] = "success";
                $_GET["text"] = "Registro Exitoso";
            } else {
                $_GET["response"] = true;
                $_GET["alert"] = "danger";
                $_GET["text"] = "Error en el Registro";
            }
        }

        return null; // Puedes redirigir o cargar una vista diferente después del registro
    }

    public function login() {
        $this->page_title = 'Iniciar Sesión';
        $this->view = 'login_register';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Validar y procesar el formulario de inicio de sesión
            $user = $this->userObj->authenticateUser($username, $password);
            
            if ($user) {
                // Iniciar sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirigir a la página de usuario autenticado
                header("Location: index.php?controller=user&action=dashboard");
                exit();
            } else {
                $_GET["response"] = true;
                $_GET["alert"] = "danger";
                $_GET["text"] = "Credenciales Incorrectas";
            }
        }

        return null;
    }

    public function logout() {
        // Finalizar la sesión y redirigir al inicio de sesión
        session_destroy();
        header("Location: index.php?controller=user&action=login");
        exit();
    }

    public function dashboard() {
        // Página principal del usuario autenticado
        $this->page_title = 'Todos los sitios';
        $this->view = 'dashboard';
        $sites=new sitesController();
        return $sites->listAll();
    }
}
