<?php
require_once 'model/stars.php'; //Nuevo
require_once 'model/sites.php'; // Asegúrate de incluir el modelo de sitios

class starsController {
    public $page_tittle;
    public $view;
    public $noteObj;

    public function __construct() {
        $this->noteObj = new Ratings();
    }

    public function detalles() {
        // Lógica para mostrar detalles del sitio, incluyendo la calificación promedio
        // ...

        // Obtener la ID del sitio desde la solicitud (por ejemplo, desde $_GET['id'])
        $site_id = $_GET['id'];

        // Crear instancias de los modelos necesarios
        $siteModel = new Site();
        $ratingsModel = new Ratings();

        // Obtener detalles del sitio
        $siteDetails = $siteModel->getSiteDetails($site_id);

        // Obtener la calificación promedio del sitio
        $promedioCalificacion = $ratingsModel->obtenerCalificacionPromedio($site_id);

        // Establecer el título de la página
        $this->page_tittle = "Detalles del Sitio: " . $siteDetails['title'];

        // Establecer la vista
        $this->view = 'site_details';

        // Incluir la vista
        include 'view/template/header.php';
        include 'view/' . $this->view . '.php';
        include 'view/template/footer.php';
    }

    public function calificar() {
        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['user_id'])) {
            // Manejar la situación cuando el usuario no ha iniciado sesión
            // Puedes redirigirlo a una página de inicio de sesión u otra acción
            // según la lógica de tu aplicación.
            header('Location: index.php?controller=user&action=login');
            exit();
        }

        // Obtener datos del formulario de calificación
        $user_id = $_SESSION['user_id'];
        $site_id = $_POST['site_id'];  // Asegúrate de que este valor se envíe desde el formulario
        $nuevaCalificacion = $_POST['rating'];  // Asegúrate de que este valor se envíe desde el formulario

        // Validar la calificación si es necesario
        // ...

        // Crear una instancia del modelo de calificaciones
        $ratingsModel = new Ratings();

        // Actualizar la calificación en la base de datos
        $ratingsModel->actualizarCalificacion($user_id, $site_id, $nuevaCalificacion);

        // Redirigir a la página del sitio o realizar otra acción según tu lógica
        header('Location: index.php?controller=user&action=dashboard');
        exit();
    }
}
?>
